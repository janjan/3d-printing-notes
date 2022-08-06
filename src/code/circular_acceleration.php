<?php

$R = [1,2,5,10,20];

$V = [50,75,100,125,150,175,200];
$V = [40,60,80,100,120,140,160,180,200];


echo '| |';

foreach ($R as $r) {
    echo " r = $r mm | ";
}

echo PHP_EOL;

echo '|--- |';

foreach ($R as $r) {
    echo "--- | ";
}

echo PHP_EOL;

foreach ($V as $v) {
    echo "| **$v mm/s** | ";

    foreach ($R as $r) {
        $a = round($v * $v / $r);


        if ($a <= 1000) {
            $emoji = "🟩";
        } else if ($a <= 2000) {
            $emoji = '🟨';
        } else if ($a <= 6000) {
            $emoji = '🟧';
        } else if ($a <= 20000) {
            $emoji = '🟥';
        } else {
            $emoji = '🟪';
        }

        echo "$emoji $a |";
    }

    echo PHP_EOL;
}
