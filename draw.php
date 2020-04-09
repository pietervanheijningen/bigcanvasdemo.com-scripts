<?php

$formData = "x=${argv[1]}&y=${argv[2]}";

if (isset($argv[3])) {

    $data = json_decode($argv[3])->data;

    for ($squareImgX = 0; $squareImgX <= 24; $squareImgX++) {
        for ($squareImgY = 0; $squareImgY <= 24; $squareImgY++) {

            if (!isset($data[(25 * $squareImgY) + $squareImgX])) {
                continue;
            }

            $formData .= "&data[$squareImgX,$squareImgY]=" . $data[(25 * $squareImgY) + $squareImgX];
        }
    }
}

$formData = str_replace('[', '%5B', $formData);
$formData = str_replace(',', '%2C', $formData);
$formData = str_replace(']', '%5D', $formData);
$formData = str_replace('#', '%23', $formData);

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, 'http://bigcanvasdemo.com/draw.php?submit=1');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $formData);
curl_setopt($ch, CURLOPT_ENCODING, 'gzip, deflate');

$headers = array();
$headers[] = 'Connection: keep-alive';
$headers[] = 'Accept: */*';
$headers[] = 'X-Requested-With: XMLHttpRequest';
$headers[] = 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/80.0.3987.163 Safari/537.36';
$headers[] = 'Content-Type: application/x-www-form-urlencoded; charset=UTF-8';
$headers[] = 'Origin: http://bigcanvasdemo.com';
$headers[] = 'Referer: http://bigcanvasdemo.com/draw.php?x=8&y=2';
$headers[] = 'Accept-Language: en-GB,en-US;q=0.9,en;q=0.8';
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

$result = curl_exec($ch);
if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
}
curl_close($ch);

echo $result;