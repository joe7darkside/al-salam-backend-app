<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'guest_name', 'permission', 'visit_date'];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function guest()
    // {
    //     return $this->belongsTo(Guest::class);
    // }
}
