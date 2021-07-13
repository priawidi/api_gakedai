<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'meja',
        'user_id',
        'user_name',
        'total_price',
        'total_price',
        'unique_code',
        'order_date',
        'order_time'
    ];
}
