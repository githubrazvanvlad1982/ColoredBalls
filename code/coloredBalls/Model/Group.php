<?php

namespace ColoredBalls\Model;

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

    /**
     * @return ColoredBalls[]
     */
    public function getColoredBalls(): array
    {
        return $this->coloredBallsCollection;
    }
}