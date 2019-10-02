<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use Searchable;

     protected $appends = [];

    protected $guarded = [];

    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function productPhotos(){

        return $this->belongsToMany(ProductPhoto::class, 'product_pictures')->withTimestamps()->orderBy('created_at', 'DESC');

    }

//    public function getSlugAttribute(){
//
//        return route('product.show', $this->slug);
//
//    }


//    public function getRouteKeyName(){
//
//        return 'slug';
//
//    }
}
