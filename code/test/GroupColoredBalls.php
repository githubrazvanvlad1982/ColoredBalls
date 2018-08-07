<?php

declare(strict_types=1);

namespace test;


class GroupColoredBalls
{
    /**
     * @param array $coloredBallsDistribution
     *
     * @return array
     */
    public function group(array $coloredBallsDistribution): array
    {
        if (empty($coloredBallsDistribution)) {
            return [];
        }

        $groups = [];
        /**
         * @var int $currentColoredBallsIndex
         * @var  ColoredBalls $coloredBalls
         */
        foreach ($coloredBallsDistribution as $currentColoredBallsIndex => $coloredBalls) {
            $group[] = $coloredBalls;

            $groupBallsNumber = $coloredBalls->getNumber();

            if ($groupBallsNumber < count($coloredBallsDistribution)) {
                $remainingBalsNumber = count($coloredBallsDistribution) - $groupBallsNumber;
                $nextColoredBalls = $coloredBallsDistribution[$currentColoredBallsIndex + 1];
                $group[] =  new ColoredBalls($nextColoredBalls->getColor(), $remainingBalsNumber);
                $nextColoredBalls->decreaseNumber($remainingBalsNumber);
            }

            $groups[] =  $group;
            unset($group);
        }

        return $groups;
    }
}