<?php
while (true) {
    for ($x = 0; $x <= 19; $x++) {
        for ($y = 0; $y <= 14; $y++) {
            exec("php draw.php $x $y >> /dev/null &");
        }
    }

    sleep(2);
}
