<?php

namespace App\Http\Controllers\Finances;

use App\Models\Service;
use App\Models\Discount;
use App\Models\ServiceImage;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Service as ServiceRequest;
use App\Http\Requests\Discount as DiscountRequest;

class ServicesController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasRoles:finances');
    }
    
    public function view()
    {
        return view('app.finances.services');
    }

    public function index()
    {
        return $services = Service::with(['images','discounts.for:id,display_name','for:id,display_name'])->get();
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

        if ( $request->has('images') ) {

            $images = [];

            foreach ( $request->images as $image ) {
                $path = $image->store('public/images/services');
                array_push($images, [ 'service_id' => $service->id, 'file' => $path ]);
            }
    
            ServiceImage::insert($images);
        }

        if ( $request->has('delete_images') ) {

            $ids = [];

            foreach ( $request->delete_images as $id ) {
                array_push($ids, decode_id($id));
            }

            $service->images()->delete($ids);
        }

        foreach ( $request->for as $role ) {
            $decoded_role = json_decode($role, true);
            array_push($roles, decode_id($decoded_role['public_id']));
        }

        $service->for()->sync($roles);

        $service = $service->fresh(['for','images','discounts']);

        return $service;
    }

    public function discount(DiscountRequest $request, $id)
    {
        $roles = [];

        $discount = Discount::updateOrCreate([
            'id'         => ($request->public_id) ? decode_id($request->public_id) : ''
        ],[
            'service_id' => $id,
            'name'       => $request->name,
            'details'    => $request->details,
            'discount'   => $request->discount,
            'end_date'   => $request->end_date . ' 23:59:59'
        ]);

        foreach ( $request->for as $role ) {
            array_push($roles, decode_id($role['public_id']));
        }

        $discount->for()->sync($roles);

        $discount = $discount->fresh(['for']);

        return $discount;
    }

    public function deleteService($id)
    {
        Service::destroy($id);

        return response()->json(['message' => 'Servicio eliminado satisfactoriamente']);
    }

    public function deleteDiscount($id, $ID)
    {
        Discount::where([
            ['id', '=', $ID,],
            ['service_id', '=', $id]
        ])->delete();

        return response()->json(['message' => 'Promoción eliminada satisfactoriamente']);
    }

}