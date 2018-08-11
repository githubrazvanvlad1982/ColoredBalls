<?php


require_once("vendor/autoload.php");

$distribution = [
    new \test\ColoredBalls(4, 13),
    new \test\ColoredBalls(1, 1),
    new \test\ColoredBalls(2, 1),
    new \test\ColoredBalls(3, 1),

];
$groupColoredBalls = new \test\GroupColoredBalls();
$groups =  $groupColoredBalls->group($distribution);
echo "<pre>";
print_r($groups);



