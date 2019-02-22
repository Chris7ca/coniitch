<?php

namespace App\Http\Controllers\Finances;

use App\Models\Service;
use App\Models\Discount;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service as ServiceRequest;
use App\Http\Requests\Discount as DiscountRequest;

class ServicesController extends Controller
{
    
    public function view()
    {
        return view('app.finances.services');
    }

    public function index()
    {
        return $services = Service::with(['discount','for_users'])->get();
    }

    public function save(ServiceRequest $request)
    {

        $roles = [];

        $service = Service::updateOrCreate([
            'id'      => ($request->public_id) ? decode_id($request->public_id) : ''
        ],
        [
            'concept' => $request->concept,
            'price'   => $request->price,
            'details' => $request->details
        ]);

        foreach ( $request->for_users as $user ) {
            array_push($roles, decode_id($user['public_id']));
        }

        $service->for_users()->sync($roles);

        return $service;
    }

    public function discount(DiscountRequest $request, $id)
    {
        $discount = Discount::updateOrCreate([
            'id'         => ($request->public_id) ? decode_id($request->public_id) : ''
        ],[
            'service_id' => $id,
            'name'       => $request->name,
            'details'    => $request->details,
            'discount'   => $request->discount,
            'end_date'   => $request->end_date
        ]);

        return $discount;
    }

    public function deleteService($id)
    {
        Service::destroy($id);

        return response()->json(['message' => 'Servicio eliminado satisfactoriamente']);
    }

    public function deleteDiscount($ID)
    {
        discount::destroy($ID);

        return response()->json(['message' => 'Promoción eliminada satisfactoriamente']);
    }

}