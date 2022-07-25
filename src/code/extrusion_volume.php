<?php

/**
 * calculates area of circle from radius
 */
function getCircleArea_mm2(float $radius_mm): float
{
    return pi() * $radius_mm * $radius_mm;
}


/**
 * calculates the area of an extruded line for a given width/height
 *
 * it is the same maths as in https://manual.slic3r.org/advanced/flow-math
 */
function getExtrusionArea_mm2(float $width_mm, float $height_mm): float
{
    $circleArea_mm2 = getCircleArea_mm2($height_mm / 2.0);

    $slabArea_mm2 = ($width_mm - $height_mm) *

    $height_mm;

    return $circleArea_mm2 + $slabArea_mm2;
}

/**
 * this is just a sanity check / unit test to see if the area functions are working correctly
 */
function test()
{
    $radius_mm = 3;

    $expectedCircleArea = pi() * $radius_mm * $radius_mm;

    if (abs(getCircleArea_mm2($radius_mm) - $expectedCircleArea) > 0.001) {
        throw new Exception("circle area function is broken");
    }

    $extrusionWidth = 5.5;
    $extrusionHeight = 3;

    $extrusionCircleRadius = $extrusionHeight / 2;
    $extrusionCenterSectionWidth = $extrusionWidth - $extrusionHeight;

    $expectedAreaForExtrusion = pi() * $extrusionCircleRadius * $extrusionCircleRadius + $extrusionCenterSectionWidth * $extrusionHeight;

    if (abs(getExtrusionArea_mm2($extrusionWidth, $extrusionHeight) - $expectedAreaForExtrusion) > 0.001) {
        throw new Exception("extrusion area function is broken");
    }
}

test();

// mirage c hotend olympics https://www.youtube.com/watch?v=dAJlLWX0Few


$widths_mm = [0.3, 0.35, 0.4, 0.45, 0.5, 0.55, 0.6, 0.65, 0.7, 0.75, 0.8, 0.85, 0.9];
$widths_mm = [0.3,       0.4,       0.5,       0.6,       0.7,       0.8,       0.9];

$heights_mm = [0.1, 0.15, 0.2, 0.25, 0.3, 0.35, 0.4, 0.45, 0.5, 0.55, 0.6];
$heights_mm = [0.1,       0.2,       0.3,       0.4,       0.5,       0.6];

$speeds_mm_p_s = [40, 60, 80, 100, 120, 140, 160, 180, 200];

if (true) {
    echo PHP_EOL . PHP_EOL;

    foreach ($heights_mm as $height_mm) {
        $formattedHeight = sprintf('%5.2f', $height_mm);


        echo "### Layer height: $formattedHeight mm" . PHP_EOL;


        echo "|  | ";

        foreach ($widths_mm as $width_mm) {
            $formattedWidth = sprintf('%5.2f', $width_mm);

            echo "w = $formattedWidth mm | ";
        }

        echo PHP_EOL;

        echo '| --- | ';

        foreach ($widths_mm as $width_mm) {
            echo "--- | ";
        }

        echo PHP_EOL;


        foreach ($speeds_mm_p_s as $speed_mm_p_s) {
            $formattedSpeed = sprintf('%.0f', $speed_mm_p_s);


            echo "| v = $formattedSpeed mm/s | ";

            foreach ($widths_mm as $width_mm) {
                $area_mm2 = getExtrusionArea_mm2($width_mm, $height_mm);

                $volume_mm3_p_s = $area_mm2    * $speed_mm_p_s;


                if ($volume_mm3_p_s <= 7) {
                    $emoji = "🟩";
                } else if ($volume_mm3_p_s <= 14) {
                    $emoji = '🟨';
                } else if ($volume_mm3_p_s <= 25) {
                    $emoji = '🟧';
                } else if ($volume_mm3_p_s <= 50) {
                    $emoji = '🟥';
                } else {
                    $emoji = '🟪';
                }

                $formattedVolume = sprintf('%.1f', $volume_mm3_p_s);

                echo "$emoji $formattedVolume  | ";
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;
    }
}

if (false) {
    echo PHP_EOL . PHP_EOL;

    foreach ($speeds_mm_p_s as $speed_mm_p_s) {
        $formattedSpeed = sprintf('%.1f', $speed_mm_p_s);

        echo "## Speed: $formattedSpeed mm/s" . PHP_EOL;


        echo "|  | ";

        foreach ($widths_mm as $width_mm) {
            $formattedWidth = sprintf('%5.2f', $width_mm);

            echo "w = $formattedWidth mm | ";
        }

        echo PHP_EOL;

        echo '| --- | ';

        foreach ($widths_mm as $width_mm) {
            echo "--- | ";
        }

        echo PHP_EOL;

        foreach ($heights_mm as $height_mm) {
            $formattedHeight = sprintf('%5.2f', $height_mm);

            echo "| h = $formattedHeight mm | ";

            foreach ($widths_mm as $width_mm) {
                $area_mm2 = getExtrusionArea_mm2($width_mm, $height_mm);

                $volume_mm3_p_s = $area_mm2    * $speed_mm_p_s;


                if ($volume_mm3_p_s <= 10) {
                    $emoji = "🟩";
                } else if ($volume_mm3_p_s <= 15) {
                    $emoji = '🟨';
                } else if ($volume_mm3_p_s <= 30) {
                    $emoji = '🟧';
                } else if ($volume_mm3_p_s <= 50) {
                    $emoji = '🟥';
                } else {
                    $emoji = '🟪';
                }

                $formattedVolume = sprintf('%.1f', $volume_mm3_p_s);

                echo "$emoji $formattedVolume  | ";
            }

            echo PHP_EOL;
        }

        echo PHP_EOL;
    }
}
