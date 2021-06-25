<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserInterestLink extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'user_id', 'user_interest_id',
    ];
}
