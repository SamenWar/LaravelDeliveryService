<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReceiverResource;
use App\Models\Receiver;
use Illuminate\Http\Request;

class ReceiverController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {

        $receivers = Receiver::all();


        return ReceiverResource::collection($receivers);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required',
        ]);

        $receiver = Receiver::create($request->all());

        $receiver->save();

        return response()->json([
            'data' => $receiver,
            'message' => 'Receiver created successfully'
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Receiver $receiver)
    {
        return response()->json($receiver, 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Receiver  $receiver
     * @return Receiver
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'full_name' => 'required',
            'phone_number' => 'required',
            'email' => 'required|email',
            'address' => 'required'
        ]);

        $receiver = Receiver::findOrFail($id);
        $receiver->update($validated);

        return new ReceiverResource($receiver);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Receiver  $receiver
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Receiver $receiver)
    {
        $receiver->delete();

        return response()->json([
            'message' => 'Receiver deleted successfully'
        ], 204);
    }

}
