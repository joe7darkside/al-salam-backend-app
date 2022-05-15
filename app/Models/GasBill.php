<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GasBill extends Model
{
    use HasFactory;

    protected $fillable = ['bill_id', 'cost'];
}
