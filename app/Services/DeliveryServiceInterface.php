<?php
namespace App\Services;

use Exception;

interface DeliveryServiceInterface
{
    public function send(array $data);
    public function getStatus(string $deliveryId);
    public function updateDeliveryParameters(string $deliveryId, array $parameters);
    public function handlePackageError(Exception $e);  // Новый метод
}
