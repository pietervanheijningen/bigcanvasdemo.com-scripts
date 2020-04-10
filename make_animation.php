<?php
require "functions.php";
$im = imagecreatefromjpeg("animation-frames/frame0.jpeg");

$i = 0;
while (true) {
    $imgData = [];

    for ($squareImgX = 0; $squareImgX <= 24; $squareImgX++) {
        for ($squareImgY = 0; $squareImgY <= 24; $squareImgY++) {
            $imgData[] = getHexFromImgPixel($squareImgY, $squareImgX);
        }
    }

    drawSquare($argv[1], $argv[2], $imgData);

    $newFrameId = $i % 19;
    $im = imagecreatefromjpeg("animation-frames/frame$newFrameId.jpeg");
    $i++;

    sleep(6);
}
