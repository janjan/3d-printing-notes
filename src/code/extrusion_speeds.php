<?php

$DIAMETER = 1.75;

$RADIUS = $DIAMETER / 2.0;

$V = [1,2,3,4,5,6,7,8,9,10];

foreach ($V as $v) {
	$vol = 3.1415 * $RADIUS * $RADIUS * $v;

	echo "$v mm/s are $vol mm^3/s" . PHP_EOL;
}
