<?php

namespace App\Http\Controllers\Root;

use App\Models\Event;
use App\Models\Attendance;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Event as EventRequest;

class EventsController extends Controller
{
    
    public function view()
    {
        return view('app.root.events');
    }

    public function index()
    {
        return Event::all();
    }

    public function attendances(Request $request, $id)
    {
        return Attendance::whereDate('date', $request->date)
            ->where('event_id', $id)
            ->with(['user:id,first_name,last_name,avatar'])
            ->get();
    }

    public function save(EventRequest $request)
    {
        $event = Event::updateOrCreate([
            'id' => ($request->filled('id')) ? decode_id($request->public_id) : ''
        ],[
            'name' => $request->name,
            'description' => $request->description
        ]);

        return $event;
    }

    public function delete($id)
    {
        Event::destroy($id);

        return response()->json(['message' => 'Actividad eliminado satisfactoriamente']);
    }

}
