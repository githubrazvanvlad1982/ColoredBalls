<?php

namespace test;

use PHPUnit\Framework\TestCase;

class GroupColoredBallsTest extends TestCase
{

    public function test_zero_colored_balls_grouping()
    {
        $this->assertEquals([], (new GroupColoredBalls())->group([]));
    }

    public function test_one_colored_balls()
    {
        $distribution = [
            new ColoredBalls(1, 1)
        ];

        $expected = [
            [
                new ColoredBalls(1, 1)
            ]
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1,1)),
        ];


        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

    public function test_two_colored_balls()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 3),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls( new ColoredBalls(1, 1))
                ->addColoredBalls( new ColoredBalls(2, 1)),
            (new Group())
                ->addColoredBalls( new ColoredBalls(2, 2))

        ];

        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

    public function test_three_balls()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 1),
            new ColoredBalls(3, 7),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1,1))
                ->addColoredBalls( new ColoredBalls(3, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 1))
                ->addColoredBalls(new ColoredBalls(3, 2)),
            (new Group())
                ->addColoredBalls( new ColoredBalls(3, 3))
        ];

        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

    public function test_three_balls_second_distribution()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 4),
            new ColoredBalls(3, 4),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 1))
                ->addColoredBalls(new ColoredBalls(2, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 2))
                ->addColoredBalls(new ColoredBalls(3, 1)),
            (new Group())
                ->addColoredBalls( new ColoredBalls(3, 3))
        ];

        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

    public function test_three_balls_third_distribution()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 3),
            new ColoredBalls(3, 5),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 1))
                ->addColoredBalls(new ColoredBalls(2, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 1))
                ->addColoredBalls(new ColoredBalls(3, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(3, 3))
        ];

        $groups = (new GroupColoredBalls())->group($distribution);
        $this->assertEquals($expected, $groups);
    }

    public function test_three_balls_forth_distribution()
    {
        $distribution = [
            new ColoredBalls(1, 2),
            new ColoredBalls(2, 2),
            new ColoredBalls(3, 5),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 2))
                ->addColoredBalls(new ColoredBalls(2, 1)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 1))
                ->addColoredBalls( new ColoredBalls(3, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(3, 3))
        ];

        $groups =   (new GroupColoredBalls())->group($distribution);
        $this->assertEquals($expected, $groups);
    }

    public function test_four_balls_first_distribution()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 1),
            new ColoredBalls(3, 1),
            new ColoredBalls(4, 13),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 1))
                ->addColoredBalls(new ColoredBalls(4, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 1))
                ->addColoredBalls(new ColoredBalls(4, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(3, 1))
                ->addColoredBalls(new ColoredBalls(4, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(4, 4))
        ];

        $this->assertEquals($expected,  (new GroupColoredBalls())->group($distribution));
    }

    public function test_four_balls_second_distribution()
    {
        $distribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(2, 2),
            new ColoredBalls(3, 4),
            new ColoredBalls(4, 9),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 1))
                ->addColoredBalls(new ColoredBalls(3, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 2))
                ->addColoredBalls(new ColoredBalls(4, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(3, 1))
                ->addColoredBalls(new ColoredBalls(4, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(4, 4))
        ];

        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

    public function test_four_balls_unordered()
    {
        $distribution = [
            new ColoredBalls(1, 5),
            new ColoredBalls(2, 3),
            new ColoredBalls(3, 6),
            new ColoredBalls(4, 2),
        ];

        $expected = [
            (new Group())
                ->addColoredBalls(new ColoredBalls(4, 2))
                ->addColoredBalls(new ColoredBalls(2, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(2, 1))
                ->addColoredBalls(new ColoredBalls(1, 3)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(1, 2))
                ->addColoredBalls(new ColoredBalls(3, 2)),
            (new Group())
                ->addColoredBalls(new ColoredBalls(3, 4))
        ];

        $this->assertEquals($expected, (new GroupColoredBalls())->group($distribution));
    }

}