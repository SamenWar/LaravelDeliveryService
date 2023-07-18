<?php

namespace App\Services;

class DeliveryServiceFactory
{
    public function make($serviceName, $link, $requestBody)
    {
        switch($serviceName) {
            case 'NovaPoshta':
                return new NovaPoshtaDeliveryService($link, $requestBody);
            case 'UkrPoshta':
                return new UkrPoshtaDeliveryService($link, $requestBody);
            // Возможно, вы добавите больше курьерских служб в будущем...
            default:
                throw new Exception("Invalid delivery service");
        }
    }
}
