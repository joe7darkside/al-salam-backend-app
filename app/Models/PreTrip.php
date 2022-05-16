<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreTrip extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'cost',
        'payment_method',

    ];

    public function pickUp()
    {
        return $this->hasOne(PickUp::class, 'trip_id');
    }
    public function dropOf()
    {
        return $this->hasOne(DropOf::class, 'trip_id');
    }
}
