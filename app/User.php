<?php

namespace App;

use App\Model\User\Coupon;
use App\Model\User\Profile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function coupons(){

        return $this->belongsToMany(Coupon::class, 'coupon_user')->withTimestamps()->orderBy('created_at', 'DESC');

    }

    public function profile(){

        return $this->hasOne(Profile::class);

    }


}
