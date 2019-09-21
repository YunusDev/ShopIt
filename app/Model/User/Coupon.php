<?php

namespace App\Model\User;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Coupon extends Model
{
    //

    protected $dates = ['expires_in'];

    protected $appends = ['expires_format'];

    public function users(){

        return $this->belongsToMany(User::class, 'coupon_user')->withTimestamps()->orderBy('created_at', 'DESC');

    }

    public function getExpiresFormatAttribute(){

        return $this->expires_in->diffForHumans();

    }

    public function isValid($productId = null, $userId){

        if ($this->status === 0){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'Coupon is not more Usable']);


        }elseif ($this->remaining === 0){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'Coupon can no longer be used..']);


        }
        elseif($this->users->contains($userId)){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'You already used this coupon before...']);


        }elseif ($this->product_id !== null && $this->product_id !== $productId){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'The coupon can only be used for product with id ' . $productId]);


        }elseif ($this->will_expire === 1 && $this->expires_in->isPast()){

            return \GuzzleHttp\json_encode(['valid' => 'No', 'message' => 'Coupon has expired...']);


        }else{

            return \GuzzleHttp\json_encode(['valid' => 'Yes', 'message' => $this]);

        }

    }

    public static function timestamp($timestamp)
    {
        return Carbon::createFromTimestampUTC($timestamp)->timezone('UTC');
    }

    public static function isPast($timestamp)
    {
        $timestamp = static::timestamp($timestamp);

        return $timestamp->isPast();
    }

}

