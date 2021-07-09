<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoogleUser extends Model
{
    use HasFactory;

    protected $fillable =[
        'email',
        'email_verified',
        'name',
        'picture',
        'given_name',
        'family_name',
        'locale'
        
    ];
}
