<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //

    public function orderItems(){

        return $this->hasMany(OrderItem::class);

    }

    public function coupon(){

        return $this->belongsTo(Coupon::class);
    }
}
