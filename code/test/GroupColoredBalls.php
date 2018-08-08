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
        $ballsPerGroup = $this->getBallsPerGroup($coloredBallsDistribution);

         /** @var  $coloredBalls */
        foreach ($coloredBallsDistribution as $coloredBallsDistributionIndex => $coloredBalls) {
            $group[] = $coloredBalls;
            $groupBallsNumber = $coloredBalls->getNumber();

            if ($groupBallsNumber < $ballsPerGroup) {
                $groupRemainingBalls = $ballsPerGroup - $groupBallsNumber;

                $coloredBalls = $this->findOtherColoredBallsToFillGroup($coloredBallsDistribution, $coloredBallsDistributionIndex);

                $group[] =  new ColoredBalls($coloredBalls->getColor(), $groupRemainingBalls);

                $coloredBalls->decreaseNumber($groupRemainingBalls);
            }

            $groups[] =  $group;
            unset($group);
        }

        return $groups;
    }

    /**
     * @param array $coloredBallsDistribution
     *
     * @return int
     */
    protected function getBallsPerGroup(array $coloredBallsDistribution): int
    {
        return count($coloredBallsDistribution);
    }

    /**
     * @param array $coloredBallsDistribution
     * @param int $currentColoredBallsIndex
     *
     * @return mixed
     */
    protected function findOtherColoredBallsToFillGroup(array $coloredBallsDistribution, int $currentColoredBallsIndex)
    {
        $coloredBalls = $coloredBallsDistribution[$currentColoredBallsIndex + 1];

        return $coloredBalls;
    }
}