<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Criteria;
use App\Http\Controllers\Controller;
use App\Http\Requests\EvaluationCriteria;

class EvaluationCriteriaController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:admin');
    }
    
    public function view()
    {
        return view('app.admin.criterias');
    }

    public function index()
    {
        $criterias = Criteria::all();

        return $criterias;
    }

    public function store(EvaluationCriteria $request)
    {
        $criteria = Criteria::create($request->all());

        return $criteria;
    }

    public function edit($id)
    {
        $criteria = Criteria::findOrFail($id);

        return $criteria;
    }

    public function update(Criteria $request, $id)
    {
        $criteria = Criteria::findOrFail($id);
        $criteria->title = $request->title;
        $criteria->axis = $request->axis;
        $criteria->description = $request->description;
        $criteria->save();

        return $criteria;
    }

    public function delete($id)
    {
        Criteria::destroy($id);

        return response()->json(['message' => 'Criterio eliminado']);
    }

}
