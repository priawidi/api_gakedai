<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'photo',
        'price',
        'type',
        'detail',
        'status',
    ];

    public function Carts()
    {
        return $this->belongsTo('App\Models\Cart');
    }

    public function scopeFilter($query, $filters)
  {
    if( isset($filters['type']) ){
      $query->where('type', '=', $filters['type']);
    }
  }
    // public function image(){
    //     return $this->morphOne(Image::class , 'imageable');
    // }
}
