<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class GroupModel extends Model
{

    public $timestamps = false;

    public function coloredBalls()
    {
        return $this->hasMany(ColoredBallsModel::class);
    }
}
