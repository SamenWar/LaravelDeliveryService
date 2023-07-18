<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class UkrPoshtaDeliveryService
{
    protected $link;
    protected $requestBody;

    public function __construct($link, $requestBody)
    {
        $this->link = $link;
        $this->requestBody = $requestBody;
    }

    public function send(array $data)
    {
        $response = Http::post($this->link, [
            'customer_name' => $data['customer_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'sender_address' => config('mail.address'),
            'delivery_address' => $data['delivery_address'],
        ]);

        return $response->json();
    }
}
