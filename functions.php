<?php

function hexcolor($r, $g, $b)
{
    return '#' . str_pad(dechex($r), 2, '0', STR_PAD_LEFT) . str_pad(dechex($g), 2, '0', STR_PAD_LEFT) . str_pad(dechex($b), 2, '0', STR_PAD_LEFT);
}

function getHexFromImgPixel($x, $y)
{
    global $im;

    $rgb = imagecolorat($im, $x, $y);
    $r = ($rgb >> 16) & 0xFF;
    $g = ($rgb >> 8) & 0xFF;
    $b = $rgb & 0xFF;

    return strtoupper(hexcolor($r, $g, $b));
}

function drawSquare($overviewX, $overviewY, $imgData)
{
    $imgDataAsJson = json_encode([
        "data" => $imgData
    ]);
    exec("php draw.php $overviewX $overviewY '$imgDataAsJson' >> /dev/null &");
}
