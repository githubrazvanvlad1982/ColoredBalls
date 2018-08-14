<?php

namespace Tests;


use phpDocumentor\Reflection\Types\Array_;

class Group
{
    /** @var Array_ */
    private $coloredBallsCollection;

    public function addColoredBalls(ColoredBalls $coloredBalls): Group
    {
        $this->coloredBallsCollection[] = $coloredBalls;

        return $this;
    }

}