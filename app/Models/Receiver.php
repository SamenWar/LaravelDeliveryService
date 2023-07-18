<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    protected $fillable = [
        'full_name',
        'phone_number',
        'email',
        'address',
    ];

    /**
     * Get the packages for the receiver.
     */
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
}
