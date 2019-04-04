<?php

namespace App\Http\Controllers\Finances;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Notification;
use App\Notifications\ValidateAcademicDocument;

class RecordsController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('hasRoles:finances');
    }

    public function view()
    {
        return view('app.finances.records');
    }
    
    public function index()
    {
        $records = User::select(['id','first_name','last_name','avatar','email','email_verified_at','created_at'])
        ->whereHas('roles', function ($query) {
            $query->where('key', 'congressman');
        })
        ->with('academic_profile:id,user_id,document,is_student')
        ->orderBy('created_at', 'desc')
        ->paginate(10);

        foreach ( $records as $record ) {
            $record->append(['created_ago']);
        }
        
        return $records;
    }

    public function document(Request $request, $id)
    {
        $congressman = User::select(['id','first_name','last_name','email'])
            ->with('academic_profile:id,user_id,is_student')
            ->findOrFail($id);

        $congressman->academic_profile->is_student = $request->validation;
        $congressman->academic_profile->save();
        
        $roles = Role::select('id')->whereIn('key', ['student','professional'])->get();

        if ( $request->validation ) {
            $congressman->roles()->toggle($roles);
        }

        Notification::send($congressman, new ValidateAcademicDocument($congressman, $request->validation, $request->reason));

        return response()->json(['message' => 'Haz validado el documento y se notificará al congesista sobre dicha validación']);
    }

}
