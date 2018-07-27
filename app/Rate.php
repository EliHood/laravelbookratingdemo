<?php

namespace App;


use App\User;

use Illuminate\Database\Eloquent\Model;
use willvincent\Rateable\Rateable;

class Rate extends Model
{
    protected $fillable = [
        'user_id',
        'rating'
    ];


    public $timestamps = false;

    protected $table = 'ratings';


}
