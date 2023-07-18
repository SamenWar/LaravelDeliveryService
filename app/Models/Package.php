<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Package extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'width',
        'height',
        'length',
        'weight',
        'receiver_id',
    ];

    /**
     * Get the receiver that owns the package.
     */
    public function receiver()
    {
        return $this->belongsTo(Receiver::class);
    }
}
