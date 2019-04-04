<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\AcademicProfile;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UploadedAcademicDocument;
use App\Mail\UploadedAcademicDocument as UploadedAcademicDocumentMail;

class AcademicProfileController extends Controller
{
    
    public function edit()
    {
        $user = User::select('id')->with('academic_profile')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(AcademicProfile $request)
    {
        $user = User::select(['id','first_name','last_name','has_academic_profile'])
            ->with('academic_profile')->where('id', Auth()->user()->id)->first();
        
        
        if ($user->academic_profile != null)
        {
            $user->academic_profile->career = $request->career;
            $user->academic_profile->institute = $request->institute;
            $user->academic_profile->faculty = $request->faculty;
            $user->academic_profile->country = $request->country;
            $user->academic_profile->state = $request->state;
            $user->academic_profile->document = ($request->hasFile('document')) ? $request->document->store('public/files/academicdocuments') : null;
            $user->academic_profile->is_student = ($request->hasFile('document')) ? null : $user->academic_profile->is_student;
            $user->academic_profile->save();
        } 
        else 
        {
            $document = ($request->hasFile('document')) ? $request->document->store('public/files/students') : null;
            $user->has_academic_profile = 1;
            $user->save();
            $user->academic_profile()->create([
                'career' => $request->career,
                'institute' => $request->institute,
                'faculty' => $request->faculty,
                'country' => $request->country,
                'state' => $request->state,
                'document' => $document,
            ]);
        }
        
        if ( $request->hasFile('document') ) {

            $notifiables_user = getUsersByRole('finances');

            Notification::send($notifiables_user, new UploadedAcademicDocument($user));
            Mail::to('finanzas.coniitch@uaem.mx')->queue(new UploadedAcademicDocumentMail($user));

        }
        
        return response()->json(['message' => 'Información académica actualizada']);
    }

}
