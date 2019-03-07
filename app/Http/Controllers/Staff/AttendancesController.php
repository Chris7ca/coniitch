<?php

namespace App\Http\Controllers\Staff;

use App\Models\User;
use App\Models\Event;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AttendancesController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:staff');
    }
    
    public function view()
    {
        return view('app.staff.attendances');
    }

    public function index()
    {
        return Event::with([
            'attendances' => function($query) {
                $query->whereDate('date', now())
                    ->with(['user:id,first_name,last_name']);
            }])->get();
    }

    public function assign($id, $uuid)
    {

        $user = User::select(['id','first_name','last_name'])->where('uuid', $uuid)->first();

        if ( !$user ) {
            abort(404, 'Usuario no encontrado');
        }

        $attendance = Attendance::whereDate('date', now())
            ->where([
                ['user_id', '=', $user->id],
                ['event_id', '=', $id]
            ])->first();

        if ( $attendance ) {
            abort(404, 'Esta persona ya tiene una asistencia este día, para este evento');
        }

        $attendance = Attendance::create([
            'user_id'   => $user->id,
            'event_id'  => $id,
            'date'      => now()
        ]);

        $attendance['user'] = $user;

        return $attendance;
    }

}
