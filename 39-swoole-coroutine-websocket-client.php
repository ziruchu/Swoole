<?php
// 39-swoole-coroutine-websocket-client.php


Swoole\Coroutine\run(function () {
    $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9503);
    $ws = $client->upgrade('/');
    if ($ws) {
        while(true) {
            $client->push('hello');
            echo $client->recv() . PHP_EOL;
            Swoole\Coroutine::sleep(0.1);
        }
    }
});

