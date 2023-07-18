<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\DeliveryResource;
use App\Models\CourierService;
use App\Models\Delivery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DeliveryController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection

     */
    public function index()
    {
        $deliveries = Delivery::all();
        return DeliveryResource::collection($deliveries);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'courier_service_id' => 'required|exists:courier_services,id',
            'status' => 'required|string',
            'sender_ address' => 'required'
        ]);

        $delivery = Delivery::create($validated);

        return new DeliveryResource($delivery);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function show(Delivery $delivery)
    {
        return response()->json($delivery, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'package_id' => 'required|exists:packages,id',
            'courier_service_id' => 'required|exists:courier_services,id',
            'status' => 'required|string',
        ]);

        $delivery = Delivery::findOrFail($id);
        $delivery->update($validated);

        return new DeliveryResource($delivery);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Delivery  $delivery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Delivery $delivery)
    {
        $delivery->delete();

        return response()->json([
            'message' => 'Receiver deleted successfully'
        ], 204);
    }



}
