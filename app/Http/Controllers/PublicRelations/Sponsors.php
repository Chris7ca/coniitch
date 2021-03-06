<?php

namespace App\Http\Controllers\PublicRelations;

use App\Models\Sponsor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSponsor;
use App\Http\Requests\UpdateSponsor;

class Sponsors extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:public-relations');
    }
    
    public function view()
    {
        return view('app.publicrelations.sponsors');
    }

    public function index()
    {
        $sponsors = Sponsor::all();
        return $sponsors;
    }

    public function store(CreateSponsor $request)
    {
        $image = $request->image->store('public/sponsors');
        $sponsor = Sponsor::create([
            'display_name' => $request->display_name,
            'url' => ($request->url) ? $request->url : null,
            'description' => ($request->description) ? $request->description : null,
            'image' => [
                "file" => $image,
                "width" => $request->width
            ]
        ]);

        return $sponsor;
    }

    public function edit($id)
    {
        $sponsor = Sponsor::find($id);
        return $sponsor;
    }

    public function update(UpdateSponsor $request, $id)
    {
        $sponsor = Sponsor::find($id);

        $image = $sponsor->image['file'];

        if ( $request->filled('image') ) {
            $image = $request->image->store('public/sponsors');
        }

        $sponsor->display_name = $request->display_name;
        $sponsor->url = ($request->url) ? $request->url : null;
        $sponsor->description = ($request->description) ? $request->description : null;

        $sponsor->image = [
            "file" => $image,
            "width" => $request->width
        ];

        $sponsor->save();

        return $sponsor;
    }

    public function delete($id)
    {
        Sponsor::destroy($id);

        return response()->json(['message' => 'Patrocionador eliminado']);
    }

}
