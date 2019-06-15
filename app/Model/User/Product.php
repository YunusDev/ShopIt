<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //

     protected $appends = [];

    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Category::class);

    }

//    public function getRouteKeyName(){
//
//        return 'slug';
//
//    }
}
