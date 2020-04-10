<?php
require "functions.php";
$im = imagecreatefrompng("image.png");

for ($overviewX = 0; $overviewX <= 19; $overviewX++) {
    for ($overviewY = 0; $overviewY <= 14; $overviewY++) {
        $imgData = [];

        for ($squareImgX = 0; $squareImgX <= 24; $squareImgX++) {
            for ($squareImgY = 0; $squareImgY <= 24; $squareImgY++) {
                $imgData[] = getHexFromImgPixel(($overviewX * 25) + $squareImgY, ($overviewY * 25) + $squareImgX);
            }
        }

        drawSquare($overviewX, $overviewY, $imgData);
    }
}
