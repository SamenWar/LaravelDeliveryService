<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CourierService extends Model
{
    protected $fillable = [
        'name',
        'api_url',
    ];

    /**
     * Get the packages delivered by the courier service.
     */
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
