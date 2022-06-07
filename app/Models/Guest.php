<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'full_name', 'phone', 'email', 'visits', 'last_visit'];


    public function invitation()
    {
        return $this->hasMany(Invitation::class, 'guest_id');
    }
}
