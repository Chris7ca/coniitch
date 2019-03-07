<?php

namespace App\Http\Controllers\Root;

use App\Models\User;
use App\Models\Document;
use Illuminate\Http\Request;
use App\Http\Requests\AddDocument;
use App\Notifications\NewDocument;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateDocument;
use Illuminate\Support\Facades\Notification;

class DocumentsController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:root');
    }
    
    public function view()
    {
        return view('app.root.documents');
    }

    public function user($id)
    {
        return Document::where('user_id', $id)->get();
    }

    public function add(AddDocument $request, $id)
    {
        $user = User::select(['id','email','first_name','last_name'])->findOrFail($id);

        $file = $request->file->store('public/files/documents');

        $document = Document::create([
            'user_id'     => $id,
            'title'       => $request->title,
            'description' => $request->description,
            'file'        => $file
        ]);

        Notification::send($user, new NewDocument($user, $document));

        return $document;
    }

    public function update(UpdateDocument $request, $id, $ID)
    {
        $document = Document::where([
            ['user_id', $id],
            ['id', $ID]
        ])->first();

        $document->title = $request->title;
        $document->description = $request->description;
        
        if ( filled($request->file) ) {
            $document->file = $request->file->store('public/files/documents');
        }

        $document->save();

        return $document;
    }

    public function delete($id, $ID)
    {
        Document::where([
            ['user_id', '=',  $id],
            ['id', '=', $ID]
        ])->delete();

        return response()->json(['message' => 'Documento eliminado correctamente']);
    }

}
