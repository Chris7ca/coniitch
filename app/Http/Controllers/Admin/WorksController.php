<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\AssignRevisors;
use App\Notifications\FinalEvaluation;
use App\Notifications\AssignWorkToEvaluate;
use Illuminate\Support\Facades\Notification;

class WorksController extends Controller
{
    
    public function view()
    {
        return view('app.admin.works');
    }

    public function revisors()
    {
        $revisors = User::select(['id','first_name','last_name'])->whereHas('roles', function($query){
            $query->where('key', 'revisor');
        })->get();

        return $revisors;
    }

    public function index()
    {
        $works = Work::select(['id','title','evaluation','version'])
            ->where('ready', 1)
            ->with([
                'revisors:id,first_name,last_name',
                'reviews.author:id,first_name,last_name',
                'reviews.evaluations.criteria:id,title,description',
            ])
            ->get();
        
        foreach ($works as $work) {
            foreach ($work->revisors as $revisor) {
                $revisor->confirmation->makeHidden(['user_id','work_id']);
            }
        }

        return $works;
    }

    public function assign(AssignRevisors $request, $id)
    {
        $ids = [];

        foreach ($request->revisors as $revisor) {
            array_push($ids, decode_id($revisor));
        }

        $work = Work::select(['id','title'])->findOrFail($id);
        $work->revisors()->toggle($ids);

        $users = User::select('id')->whereIn('id', $ids)->get();
        Notification::send($users, new AssignWorkToEvaluate($work));
        
        return response()->json(['message' => 'Revisores asignados, espera la confirmación de los revisores']);
    }

    public function confirm(Request $request, $id)
    {
        $work = Work::select(['id','user_id','title','type','evaluation'])
            ->with([
                'registered_user:id,first_name,last_name',
                'reviews:id,work_id,feedback'
            ])->findOrFail($id);

        $work->evaluation = $request->final_score;
        $work->save();

        Notification::send($work->registered_user, new FinalEvaluation($work));

        return response()->json(['message' => 'Se ha notificado la evaluación al congresista']);
    }

}
