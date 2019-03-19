<?php

namespace App\Http\Controllers\Users;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class NotificationsController extends Controller
{
    
    public function view()
    {
        return view('app.notifications');
    }

    public function widget()
    {
        $notifications = DB::table('notifications')->select(['id','data','read_at','created_at'])
            ->where([
                ['notifiable_type', 'App\Models\User'],
                ['notifiable_id', Auth()->user()->id]
            ])->take(3)->orderBy('created_at','desc')->get();
        
        $unread_notifications = DB::table('notifications')->select('id')
            ->where([
                ['notifiable_type', 'App\Models\User'],
                ['notifiable_id', Auth()->user()->id],
                ['read_at', null]
            ])->count();
        
        foreach ($notifications as $notification) {
            $created_at = new Carbon($notification->created_at);
            $notification->created_ago = $created_at->diffForHumans();
        }
        
        return response()->json(['notifications' => $notifications, 'unread_notifications' => $unread_notifications]);
    }

    public function index()
    {
        $notifications = DB::table('notifications')->select(['id','data','read_at','created_at'])
        ->where([
            ['notifiable_type', 'App\Models\User'],
            ['notifiable_id', Auth()->user()->id]
        ])->orderBy('created_at','desc')->get();

        foreach ($notifications as $notification) {
            $created_at = new Carbon($notification->created_at);
            $notification->created_ago = $created_at->diffForHumans();
        }

        return $notifications;
    }

    public function read($uuid)
    {
        DB::table('notifications')->where('id', $uuid)->update(['read_at' => now()]);

        return response('', 200);
    }

}
