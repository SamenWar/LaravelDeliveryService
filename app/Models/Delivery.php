<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Delivery extends Model
{
    protected $fillable = [
        'package_id',
        'courier_service_id',
        'status',
    ];

    /**
     * Get the package associated with the delivery.
     */
    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the courier service that provides the delivery.
     */
    public function courierService()
    {
        return $this->belongsTo(CourierService::class);
    }
}

