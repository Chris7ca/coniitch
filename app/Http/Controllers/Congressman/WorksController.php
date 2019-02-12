<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use App\Models\Work;
use App\Models\Coauthor;
use Illuminate\Http\Request;
use App\Http\Requests\SaveWork;
use App\Http\Requests\ConfirmWork;
use App\Notifications\AssignedWork;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Notifications\NewWorkRegister;
use Illuminate\Support\Facades\Notification;
use App\Mail\NewWorkRegister as NewWorkRegisterMail;

class WorksController extends Controller
{
    
    public function view()
    {
        $work = Work::where('user_id', Auth()->user()->id)
            ->with([
                'coauthors',
                'reviews:id,work_id,score,feedback'
            ])->first();

        return view('app.congressman.announcement', compact('work'));
    }

    public function save(SaveWork $request)
    {
        $work = Work::updateOrCreate([
            'id'            => ($request->filled('id')) ? decode_id($request->id) : ''
        ],
        [
            'user_id'           => Auth()->user()->id,
            'title'             => $request->title,
            'theme'             => $request->theme,
            'type'              => $request->type,
            'axis'              => $request->axis,
            'adscription'       => $request->adscription,
            'content'           => $request->content,
        ]);

        if ( !empty($request->has_coauthors_to_delete) ) {

            $coauthors_to_delete = [];

            foreach ( $request->has_coauthors_to_delete as $coauthor_to_delete ) {
                array_push($coauthors_to_delete, decode_id($coauthor_to_delete));
            }

            Coauthor::destroy($coauthors_to_delete);
        }

        if ( !empty($request->coauthors) ) {

            $updated_coauthors = [];
            
            foreach ( $request->coauthors as $coauthor ) {


                $updated_coauthor = Coauthor::updateOrCreate(
                    [
                        'id'               => $coauthor['public_id'] ? decode_id($coauthor['public_id']) : ''
                    ],[
                        'work_id'          => $work->id,
                        'full_name'        => $coauthor['full_name'],
                        'email'            => $coauthor['email'],
                        'adscription'      => $coauthor['adscription'],
                        'is_first_author'  => $coauthor['is_first_author'],
                    ]
                ); 

                array_push($updated_coauthors, $updated_coauthor);

            }

            $work->coauthors = $updated_coauthors;

        }

        return $work;
    }

    public function show($id)
    {
        $work = Work::with([
            'registered_user:id,avatar,first_name,last_name,email',
            'registered_user.personal_profile:id,user_id,second_name,second_last_name',
            'coauthors'
        ])->findOrFail($id);

        return view('app.congressman.works', compact('work'));
    }

    public function confirm($id)
    {
        $work = Work::findOrFail($id);

        if ( $work->title && $work->theme && $work->axis && $work->type && $work->adscription && $work->content ) {

            $work->version      += 1; 
            $work->ready        = true;
            $work->evaluation   = null; 
            $work->save();

            $work->reviews()->where([
                ['work_id', $work->id],
                ['score', '>', 1]
            ])->update(['score' => null]);

            if ( $work->version == 1 ) {
                
                $users_notifiables = getUsersByRole('admin');
                
                Mail::to('trabajos@coniitch.mx')->queue(new NewWorkRegisterMail($work));
                Notification::send($users_notifiables, new NewWorkRegister(Auth()->user(), $work));
            }

            return response()->json(['message' => 'Se han confirmado todos los cambios y se notificará para su revisión.']);

        } else {

            return abort(500, 'Debe completar toda la información solicitada.');
        }

        
    }

}