<?php

namespace App\Http\Controllers;

use App\Model\Group;
use ColoredBalls\GroupColoredBalls;
use ColoredBalls\Model\ColoredBalls;


class ColoredBallsController extends Controller
{
    public function group()
    {


        $coloredBalls = new \App\Model\ColoredBalls();
        $coloredBalls->group_id = 1;
        $coloredBalls->color = 2;
        $coloredBalls->number = 4;


        $group = new Group();
        $group->coloredBalls()->

        $groupedBalls = new GroupColoredBalls();
        $groupedBalls = $groupedBalls->group([
            new ColoredBalls(1, 2),
            new ColoredBalls(2, 3),
            new ColoredBalls(3, 5),
        ]);


        /**
         * @var \ColoredBalls\Model\Group $coloredBallsGroup
         */
        foreach ($groupedBalls as $groupIndex => $coloredBallsGroup ) {
            $group = new Group();
            $group->setColoredBals($coloredBallsGroup->getColoredBals());
        }
        echo "<pre>";
        print_r($groupedBalls);

        return view('colored_balls');
    }
}