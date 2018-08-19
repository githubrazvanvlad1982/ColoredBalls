<?php

namespace App\Http\Controllers;

use App\Model\ColoredBallsModel;
use App\Model\GroupModel;
use ColoredBalls\GroupColoredBalls;
use ColoredBalls\Model\ColoredBalls;
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
        foreach ($groupedBalls as $groupIndex => $coloredBallsGroup) {
            $groupModel = $this->saveGroup($groupIndex);
            $this->saveGroupColoredBalls($coloredBallsGroup, $groupModel);
        }
    }

    private function clearOldData(): void
    {
        DB::statement('TRUNCATE TABLE group_models');
        DB::statement('TRUNCATE TABLE colored_balls_models');
    }

    private function saveGroup(int $groupIndex): GroupModel
    {
        $group = $this->createGroupModelFromGroup($groupIndex);
        $group->save();

        return $group;
    }

    private function createGroupModelFromGroup(int $groupIndex): GroupModel
    {
        $group = new GroupModel();
        $group->name = $groupIndex;

        return $group;
    }

    /**
     * @param \ColoredBalls\Model\Group $coloredBallsGroup
     *
     * @param GroupModel $group
     */
    private function saveGroupColoredBalls(\ColoredBalls\Model\Group $coloredBallsGroup, GroupModel $group): void
    {
        $coloredBallsModelCollection = [];

        /** @var ColoredBalls $coloredBalls */
        foreach ($coloredBallsGroup->getColoredBalls() as $coloredBalls) {
            $coloredBallsModel = $this->createColoredBallsModelFromColoredBalls($coloredBalls);

            $coloredBallsModelCollection[] = $coloredBallsModel;
        }

        $group->coloredBalls()->saveMany($coloredBallsModelCollection);
    }

    private function createColoredBallsModelFromColoredBalls(ColoredBalls $coloredBalls): ColoredBallsModel
    {
        $coloredBallsModel = new ColoredBallsModel();
        $coloredBallsModel->color = $coloredBalls->getColor();
        $coloredBallsModel->number = $coloredBalls->getNumber();

        return $coloredBallsModel;
    }
}