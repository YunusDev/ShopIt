<?php

namespace App\Model\Admin;

//use Illuminate\Database\Eloquent\Model;

use App\Model\User\Investment;
use App\Model\User\InvestmentProduct;
use function GuzzleHttp\Psr7\str;

class InvestmentBatch extends Model
{
    //

    public function investments(){

        return $this->hasMany(Investment::class);

    }

    public function merchant(){

        return $this->belongsTo(Merchant::class);

    }

    public function investmentProduct(){

        return $this->belongsTo(InvestmentProduct::class);

    }
}
