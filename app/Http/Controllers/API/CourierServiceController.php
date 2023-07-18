<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CourierServiceResource;
use App\Models\CourierService;
use Illuminate\Http\Request;

class CourierServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection

     */
    public function index()
    {
        $courierServices = CourierService::all();
        return CourierServiceResource::collection($courierServices);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'api_url' => 'required|url',
        ]);

        $courierService = CourierService::create($validated);

        return response()->json([
            'data' => $courierService,
            'message' => 'Receiver created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(CourierService $courierService)
    {
        return response()->json($courierService, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'api_url' => 'required|url',
        ]);

        $package = CourierService::findOrFail($id);
        $package->update($validated);

        return new CourierServiceResource($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(CourierService $courierService)
    {
        $courierService->delete();

        return response()->json([
            'message' => 'Receiver deleted successfully'
        ], 204);
    }
}
