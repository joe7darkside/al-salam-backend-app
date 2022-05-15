<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisaCard extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'card_number', 'expire', 'ccv_cvc', 'card_owner'];
}
