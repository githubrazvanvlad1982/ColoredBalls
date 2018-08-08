<?php


require_once("vendor/autoload.php");

$coloredBallsDistribution = [
    new \test\ColoredBalls(1, 1)
];
$groupColoredBalls = new \test\GroupColoredBalls();
$groups =  $groupColoredBalls->group($coloredBallsDistribution);
echo "<pre>";
print_r($groups);



