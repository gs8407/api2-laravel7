<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toy extends Model
{
    // public function toy()
    // {
    //     return $this->belongsTo(User::class);
    // }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
