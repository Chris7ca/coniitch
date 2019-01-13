<?php

namespace App\Http\Controllers\Root;

use App\Models\Role;
use Illuminate\Http\Request;
use App\Http\Requests\CreateRole;
use App\Http\Requests\UpdateRole;
use App\Http\Controllers\Controller;

class RolesController extends Controller
{
    
    public function view()
    {
        return view('app.root.roles');
    }

    public function forSimpleSearch()
    {
        $roles = Role::select(['id','key','display_name'])->get();
        return $roles;
    }

    public function index()
    {
        $roles = Role::all();
        return $roles;
    }
    
    public function store(CreateRole $request)
    {
        $role = Role::create($request->all());
        return $role;
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);
        return $role;
    }

    public function update(UpdateRole $request, $id)
    {
        $role = Role::findOrFail($id);
        $role->key = $request->key;
        $role->display_name = $request->display_name;
        $role->description = $request->description;
        $role->save();

        return $role;
    }

    public function delete($id)
    {
        Role::destroy($id);
        return response()->json(['message' => 'Rol eliminado']);
    }

}
