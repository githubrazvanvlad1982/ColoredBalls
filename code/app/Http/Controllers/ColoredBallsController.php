<?php

namespace App\Http\Controllers;

use App\Model\ColoredBallsModel;
use ColoredBalls\GroupColoredBalls;
use ColoredBalls\Model\ColoredBalls;
use ColoredBalls\Model\Group;
use Illuminate\Support\Facades\DB;

class ColoredBallsController extends Controller
{
    public function group()
    {
        $groupedBalls = new GroupColoredBalls();
        $groupedBalls = $groupedBalls->group([
            new ColoredBalls(1, 2),
            new ColoredBalls(2, 3),
            new ColoredBalls(3, 5),
        ]);

        $this->saveGroupedBalls($groupedBalls);


        return view('colored_balls');
    }

    /**
     * @param \ColoredBalls\Model\Group[]  $groupedBalls
     */
    private function saveGroupedBalls(array $groupedBalls): void
    {

        $this->clearOldData();

        /**
         * @var \ColoredBalls\Model\Group $coloredBallsGroup
         */
        foreach ($groupedBalls as $group => $coloredBallsGroup) {
            $this->saveGroupColoredBalls($group, $coloredBallsGroup);
        }
    }

    private function clearOldData(): void
    {
        DB::statement('TRUNCATE TABLE colored_balls_models');
    }

    private function saveGroupColoredBalls(int $group, Group $coloredBallsGroup): void
    {
        /** @var ColoredBalls $coloredBalls */
        foreach ($coloredBallsGroup->getColoredBalls() as $coloredBalls) {
            $coloredBallsModel = $this->createColoredBallsModelFromColoredBalls($group, $coloredBalls);
            $coloredBallsModel->save();
        }
    }

    private function createColoredBallsModelFromColoredBalls(int $group, ColoredBalls $coloredBalls): ColoredBallsModel
    {
        $coloredBallsModel = new ColoredBallsModel();
        $coloredBallsModel->group = $group;
        $coloredBallsModel->color = $coloredBalls->getColor();
        $coloredBallsModel->number = $coloredBalls->getNumber();

        return $coloredBallsModel;
    }
}