<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'payment_from',
        'payment_to',
        'Payment_date',
        'payment_status',
        'payment_due',
        'bill_cost',
        'month_name',
    ];

    public function waterBill()
    {
        return  $this->hasOne(WaterBill::class, 'bill_id');
    }

    public function gasBill()
    {
        return  $this->hasOne(GasBill::class, 'bill_id');
    }

    public function electricityBill()
    {
        return  $this->hasOne(electricityBill::class, 'bill_id');
    }

    public function user()
    {
        return  $this->belongsTo(User::class, 'user_id');
    }
}
