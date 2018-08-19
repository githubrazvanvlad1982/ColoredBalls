<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{

    public $timestamps = false;

    public function coloredBalls()
    {
        return $this->hasMany(ColoredBalls::class);
    }
}
