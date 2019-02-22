<?php

namespace App\Http\Controllers\Congressman;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\Invoicing;
use App\Http\Controllers\Controller;

class InvoicingController extends Controller
{
    
    public function edit()
    {
        $user = User::select('id')->with('invoicing_data')->where('id', Auth()->user()->id)->first();
        return $user;
    }

    public function update(Invoicing $request)
    {
        $user = User::select('id')->with('invoicing_data')->where('id', Auth()->user()->id)->first();

        if ( $user->invoicing_data ){

            $user->invoicing_data->type         = $request->type;
            $user->invoicing_data->display_name = $request->display_name;
            $user->invoicing_data->rfc          = $request->strtoupper(rfc);
            $user->invoicing_data->country      = $request->country;
            $user->invoicing_data->zip_code     = $request->zip_code;
            $user->invoicing_data->state        = $request->state;
            $user->invoicing_data->city         = $request->city;
            $user->invoicing_data->address      = $request->address;
            $user->invoicing_data->save();

        } else {

            $user->invoicing_data()->create($request->all());

        }

        return response()->json(['message' => 'Datos de facturación actualizados']);
    }

}
