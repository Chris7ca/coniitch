<?php

namespace App\Http\Controllers\Revisors;

use App\Models\User;
use App\Models\Work;
use App\Models\Review;
use App\Models\Criteria;
use App\Models\Evaluation;
use Illuminate\Http\Request;
use App\Notifications\EvaluateWork;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationWork;
use App\Notifications\ResponseToAssignment;
use Illuminate\Support\Facades\Notification;

class WorksController extends Controller
{
    
    public function view()
    {
        return view('app.revisors.works');
    }

    public function index()
    {
        $user = User::select('id')->where('id', Auth()->user()->id)
        ->with([
            'assigned_works' => function ($query) {
                $query->select(['id','title','theme','axis','type','version'])
                    ->where('revisors.status', null)
                    ->orWhere('revisors.status', 1);
            },
            'assigned_works.reviews' => function ($query) {
                $query->select(['id','work_id','user_id','score','feedback'])
                    ->where('reviews.user_id', Auth()->user()->id)
                    ->with([
                        'evaluations:id,review_id,criteria_id,score',
                        'evaluations.criteria:id,title,description'
                    ]);
            }
        ])->first();

        foreach ( $user->assigned_works as $work ) {
            $work->confirmation->makeHidden(['user_id','work_id']);
        }

        return $user->assigned_works;
    }

    public function confirmation(Request $request, $id)
    {
        $work = Work::select(['id','title'])->findOrFail($id);
        $res = ($request->response) ? 1 : 0;
        $work->revisors()->updateExistingPivot(Auth()->user()->id, ['status' => $res]);

        $users_notifiables = getUsersByRole('admin');

        Notification::send($users_notifiables, new ResponseToAssignment($work, Auth()->user(), $request->response));

        return response()->json(['message' => 'Has '. (($res) ? 'aceptado' : 'rechazado') .' este trabajo, se notificará al administrador']);
    }

    public function criterias(Request $request)
    {
        $criterias = Criteria::select(['id','title','description'])
            ->where('axis', $request->axis)
            ->orWhere('axis', 'BothOfThem')->get();

        return $criterias;
    }

    public function evaluate(EvaluationWork $request, $id)
    {
        $evaluations = [];

        $review = Review::updateOrCreate([
            'id'        => ($request->filled('public_id')) ? decode_id($request->public_id) : ''
        ],
        [
            'user_id'   => Auth()->user()->id,
            'work_id'   => $id,
            'score'     => $request->score,
            'feedback'  => $request->feedback
        ]);

        foreach ( $request->evaluations as $e ) {

            $evaluation = Evaluation::updateOrCreate([
                'id'          => ($e['public_id'] != '') ? decode_id($e['public_id']) : ''
            ],
            [
                'review_id'   => $review->id,
                'criteria_id' => decode_id($e['criteria']['public_id']),
                'score'       => $e['score']
            ]);
            
            $e['public_id'] = $evaluation->public_id;
            array_push($evaluations, $e);
        }

        $review->evaluations = $evaluations;

        $users_notifiables = getUsersByRole('admin');

        Notification::send($users_notifiables, new EvaluateWork(Auth()->user()));

        return $review;        
    }

}
