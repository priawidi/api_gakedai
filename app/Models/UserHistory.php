<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserHistory extends Model
{
    use HasFactory;

    protected $fillable =[

        'user_id',
        'user_name',
        'item_qty',
        'item_name',
        'item_price',
        'item_photo'
    ];
}
