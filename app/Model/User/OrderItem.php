<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    //

    public function order(){

        return $this->belongsTo(Order::class);

    }
}
