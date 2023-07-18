<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PackageResource;
use App\Models\Package;
use Exception;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index()
    {
        $packages = Package::all();
        return PackageResource::collection($packages);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'weight' => 'required|numeric',
            'receiver_id' => 'required|integer'
        ]);

        $package = Package::create($validated);

        return new PackageResource($package);
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package)
    {
        return response()->json($package, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'width' => 'required|numeric',
            'height' => 'required|numeric',
            'length' => 'required|numeric',
            'weight' => 'required|numeric',
            'receiver_id' => 'required|integer'
        ]);

        $package = Package::findOrFail($id);
        $package->update($validated);

        return new PackageResource($package);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Package $package
     * @return \Illuminate\Http\Response
     */
    public function destroy(Package $package)
    {
        $package->delete();

        return response()->json([
            'message' => 'Receiver deleted successfully'
        ], 204);
    }

    /**
     * This function handles the sending of package data to the delivery service.
     * It takes one parameter - package information.
     *
     * @param  Package $package
     * @return Response
     */
    public function sendPackage(Package $package)
    {
        // Получаем имя службы доставки
        $courierServiceName = $package->delivery->courierService->name;

        // Преобразуем имя службы доставки в имя класса
        $courierServiceName = str_replace(' ', '', $courierServiceName); // Удаляем пробелы
        $serviceName = "App\\Services\\" . ucwords($courierServiceName); // Преобразуем первые буквы в верхний регистр и добавляем путь до директории Services
        $serviceName .= 'DeliveryService'; // Добавляем суффикс

        // Проверяем существует ли класс
        if (!class_exists($serviceName)) {
            throw new Exception("Delivery service class {$serviceName} does not exist");
        }

        // Получаем экземпляр службы доставки
        $deliveryService = app($serviceName);

        // Получаем данные получателя
        $receiver = $package->receiver;

        // Формируем данные для отправки
        $data = [
            'customer_name' => $receiver->full_name,
            'phone_number' => $receiver->phone_number,
            'email' => $receiver->email,
            'sender_address' => config('app.sender_address'),
            'delivery_address' => $receiver->address,
        ];

        // Отправляем данные службе доставки
        $response = $deliveryService->send($data);

        return $response;
    }
    /**
     * This function takes HTTP request from the client and package information
     * which needs to be processed. It handles request to send notification
     * about package problem to the delivery service.
     *
     * @param  Request $request
     * @param  Package $package
     * @return Response
     */
    public function handleDelivery(Request $request, Package $package)
    {
        // Получаем данные из запроса
        $data = $request->all();

        // Получаем имя службы доставки
        $courierServiceName = $package->delivery->courierService->name;

        // Преобразуем имя службы доставки в имя класса
        $courierServiceName = str_replace(' ', '', $courierServiceName); // Удаляем пробелы
        $serviceName = "App\\Services\\" . ucwords($courierServiceName); // Преобразуем первые буквы в верхний регистр и добавляем путь до директории Services
        $serviceName .= 'DeliveryService';

        // Создаем экземпляр службы доставки
        $deliveryService = app()->make($serviceName);

        // Вызываем метод handlePackageError службы доставки
        $deliveryService->handlePackageError($data, $package);


    }
}
