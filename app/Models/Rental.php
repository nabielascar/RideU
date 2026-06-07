<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'motor_id',
        'customer_name',
        'phone_number',
        'address',
        'city',
        'pickup_location',
        'pickup_date',
        'pickup_time',
        'duration',
        'total_price',
        'receipt_image',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}
