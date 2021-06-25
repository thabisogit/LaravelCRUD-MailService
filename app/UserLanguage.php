<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    //
    public $timestamps = false;

    protected $table = 'user_languages';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
