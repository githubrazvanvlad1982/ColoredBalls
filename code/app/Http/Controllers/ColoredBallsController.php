<?php

namespace App\Http\Controllers;

use App\Model\ColoredBallsModel;
use ColoredBalls\GroupColoredBalls;
use ColoredBalls\Model\ColoredBalls;
use ColoredBalls\Model\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ColoredBallsController extends Controller
{
    public function groupForm()
    {

        return view('colored_balls');
    }

    public function group(Request $request)
    {

        $coloredBallsDistribution = $this->getDistributionFromRequest($request);

        $groupedBalls = new GroupColoredBalls();
        $groupedBalls = $groupedBalls->group($coloredBallsDistribution);
        $this->saveGroupedBalls($groupedBalls);

        echo "<pre>";
        print_r($groupedBalls);
    }

    private function getDistributionFromRequest(Request $request): array
    {
        $colors = $request->input('colors');
        $numbers = $request->input('numbers');

        $coloredBallsDistribution = [];
        foreach ($colors as $index => $color) {
            $coloredBallsDistribution[] = new ColoredBalls($color, $numbers[$index]);
        }
        return $coloredBallsDistribution;
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