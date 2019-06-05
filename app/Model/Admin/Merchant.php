<?php

namespace App\Model\Admin;

//use Illuminate\Database\Eloquent\Model;

use App\Model\User\InvestmentProduct;

class Merchant extends Model
{
    //
    public $appends = ['url', 'batch_url'];

    public function investmentProducts(){

        return $this->hasMany(InvestmentProduct::class);

    }

    public function getUrlAttribute(){

        return route('merchants.show', $this->name);

    }

    public function getBatchUrlAttribute(){

        return route('merchants.batches', $this->name);

    }

    public function batches(){

        return $this->hasMany(InvestmentBatch::class);

    }
}
