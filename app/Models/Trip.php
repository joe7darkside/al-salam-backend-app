<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'user_id',
        'captain_id',
        'cost',
        'payment_method',
        'payed'
    ];

    public function pickUp()
    {
        return $this->hasOne(PickUp::class, 'trip_id');
    }
    public function dropOf()
    {
        return $this->hasOne(DropOf::class, 'trip_id');
    }


    public function captain()
    {
        return $this->belongsTo(Captain::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
