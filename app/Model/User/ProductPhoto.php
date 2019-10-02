<?php

namespace App\Model\User;

//use Illuminate\Database\Eloquent\Model;

class ProductPhoto extends Model
{
    //

    public function products(){

        return $this->belongsToMany(Product::class, 'product_pictures')->withTimestamps()->orderBy('created_at', 'DESC');

    }



}
