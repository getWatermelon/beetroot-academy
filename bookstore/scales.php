<?php

function scales($b1, $b2, $b3, $b4, $b5, $b6, $b7, $b8, $b9)
{
    $balls = [[$b1, $b2, $b3], [$b4, $b5, $b6], [$b7, $b8, $b9]];

    $sum = array_sum($balls[2]) <=> array_sum($balls[0]);

    $ans = $balls[1 + $sum][2] <=>  $balls[1 + $sum][0];

    echo "Шарик с большей массой находиться под номером: " . (3 * $sum + $ans + 5);
    echo '<br />';
    echo "Его масса равна = " . $balls[1 + $sum][1 + $ans];

}

scales(1,1,1,1,2,1,1,1,1);
