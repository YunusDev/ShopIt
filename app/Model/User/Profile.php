<?php

namespace App\Model\User;

use Illuminate\Database\Eloquent\Model;
use Nexmo\User\User;

class Profile extends Model
{
    //

    public function user(){

        return $this->belongsTo(User::class);

    }
}
