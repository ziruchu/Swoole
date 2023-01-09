<?php

$i = 0;

Swoole\TImer::tick(500, function ($timerId) use (&$i) {
    $i++;
    echo $i . ' Swoole ' . PHP_EOL;
    if ($i > 20) {
        Swoole\Timer::clear($timerId);
    }
});





