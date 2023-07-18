<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Package;

class NovaPoshtaDeliveryService implements DeliveryServiceInterface
{


    public function send(array $data)
    {
        $response = Http::post('novaposhta.test/api/delivery', $data);

        if ($response->successful()) {
            $responseData = $response->json();

            if ($responseData['status'] == 'success') {
                return $responseData['message'];
            } else if ($responseData['status'] == 'error') {
                throw new Exception('Error from Nova Poshta API: ' . $responseData['message']);
            } else {
                throw new Exception('Unknown response status from Nova Poshta API: ' . $responseData['status']);
            }
        } else {
            throw new Exception('HTTP request to Nova Poshta API failed with status ' . $response->status());
        }
    }
    public function getStatus(string $deliveryId)
    {
        // Реализуйте логику здесь...
    }

    public function updateDeliveryParameters(string $deliveryId, array $parameters)
    {
        // Реализуйте логику здесь...
    }

    public function handlePackageError(Exception $e)
    {
        $response = Http::post('novaposhta.test/api/delivery', $e);
    }
}
