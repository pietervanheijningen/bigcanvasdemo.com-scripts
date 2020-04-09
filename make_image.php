<?php
$im = imagecreatefrompng("image.png");

for ($overviewX = 0; $overviewX <= 19; $overviewX++) {
    for ($overviewY = 0; $overviewY <= 14; $overviewY++) {
        $imgData = [];

        for ($squareImgX = 0; $squareImgX <= 24; $squareImgX++) {
            for ($squareImgY = 0; $squareImgY <= 24; $squareImgY++) {
                $imgData[] = getHexFromImgPixel(($overviewX * 25) + $squareImgX, ($overviewY * 25) + $squareImgY);
            }
        }

        drawSquare($overviewX, $overviewY, $imgData);
    }
}

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
