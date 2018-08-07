<?php


namespace test;


class ColoredBalls
{
    /** @var int */
    private $color;

    /** @var int */
    private $number;

    public function __construct(int $color, int $number)
    {
        $this->color = $color;
        $this->number = $number;
    }

    public function getColor(): int
    {
        return $this->color;
    }

    public function getNumber(): int
    {
        return $this->number;
    }

    public function decreaseNumber(int $decreaseWith): void
    {
        $this->number = $this->number - $decreaseWith;
    }

}