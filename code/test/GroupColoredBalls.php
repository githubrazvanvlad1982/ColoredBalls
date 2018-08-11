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

        usort($coloredBallsDistribution, function(ColoredBalls $a, ColoredBalls $b) {
            return $a->getNumber() > $b->getNumber();
        });


         /** @var  $coloredBalls */
        foreach ($coloredBallsDistribution as $coloredBallsDistributionIndex => $coloredBalls) {
            $group = new Group();
            $group->addColoredBalls($coloredBalls);

            $groupBallsNumber = $coloredBalls->getNumber();

            if ($groupBallsNumber < $ballsPerGroup) {
                $groupRemainingBalls = $ballsPerGroup - $groupBallsNumber;

                $coloredBalls = $this->findOtherColoredBallsToFillGroup($coloredBallsDistribution, $coloredBallsDistributionIndex, $groupRemainingBalls);

                $group->addColoredBalls(new ColoredBalls($coloredBalls->getColor(), $groupRemainingBalls));

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
     * @param int $groupRemainingBalls
     *
     * @return ColoredBalls
     */
    protected function findOtherColoredBallsToFillGroup(array $coloredBallsDistribution, int $currentColoredBallsIndex, int $groupRemainingBalls)
    {

        for ($index = $currentColoredBallsIndex + 1; $index < count($coloredBallsDistribution); $index++ ) {
            /** @var ColoredBalls $coloredBalls */
            $candidateColoredBalls = isset($coloredBallsDistribution[$index]) ? $coloredBallsDistribution[$index]: null;
            if ($candidateColoredBalls && $candidateColoredBalls->getNumber() >= $groupRemainingBalls) {
                return $coloredBallsDistribution[$index];
            }
        }
    }
}