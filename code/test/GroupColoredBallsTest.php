<?php

namespace test;

use PHPUnit\Framework\TestCase;

class GroupColoredBallsTest extends TestCase
{

    public function testNothing()
    {
        $this->assertEmpty('');
    }

    public function test_0_colors_returns_0_groups()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $this->assertEquals(0, count($groupColoredBalls->group([])));
    }

    public function test_1_color_returns_1_group()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $coloredBallsDistribution = new ColoredBalls(1, 1);

        $this->assertEquals(1, count($groupColoredBalls->group([$coloredBallsDistribution])));
    }

    public function test_1_color_returns_1_group_with_1_colored_ball()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $coloredBallsDistribution = new ColoredBalls(1, 1);

        $groups = $groupColoredBalls->group([$coloredBallsDistribution]);
        $groupColoredBalls = current($groups);

        $this->assertEquals(1, count($groupColoredBalls));
    }

    public function test_1_colored_ball_with_1_ball_of_collor_1_returns_a_group_with_just_this_colored_ball()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $coloredBallsDistribution = new ColoredBalls(1, 1);

        $groups = $groupColoredBalls->group([$coloredBallsDistribution]);
        $groupColoredBalls = current($groups);

        /** @var ColoredBalls $coloredBalls */
        $coloredBalls = current($groupColoredBalls);

        $this->assertEquals(1, count($groupColoredBalls));
        $this->assertEquals(1, $coloredBalls->getColor());
        $this->assertEquals(1, $coloredBalls->getNumber());
    }

    public function test_2_color_returns_2_groups()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $coloredBallsDistribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(1, 3),
        ];

        $groups =  $groupColoredBalls->group($coloredBallsDistribution);
        $this->assertEquals(2, count($groups));
    }

    public function test_2_colors_returns_2_groups_with_max_2_bals_per_group()
    {
        $groupColoredBalls = new GroupColoredBalls();

        $coloredBallsDistribution = [
            new ColoredBalls(1, 1),
            new ColoredBalls(1, 3),
        ];

        $groups =  $groupColoredBalls->group($coloredBallsDistribution);
        foreach ($groups as $group) {
            $ballsNumber = 0;
            /** @var ColoredBalls $coloredBalls */
            foreach ($group as $coloredBalls) {
                $ballsNumber += $coloredBalls->getNumber();
            }

            $this->assertEquals(2, $ballsNumber);
        }


        $this->assertEquals(2, count($groups));
    }
}