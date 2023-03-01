<?php

// 28-swoole-process-manager-1.php

$pm = new Swoole\Process\Manager();

for ($i = 0; $i < 5; $i++) {
    $pm->add(function (Swoole\Process\Pool $pool, $workerId) {
        echo $workerId . PHP_EOL;
        while(true) {
        }
    });
}

$pm->start();




