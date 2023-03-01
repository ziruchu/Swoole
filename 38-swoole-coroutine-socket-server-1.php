<?php
// 38-swoole-coroutine-socket-server-1.php

// 实现 socket 协程服务端
Swoole\Coroutine\run(function () {
    $socket = new Swoole\Coroutine\Socket(AF_INET, SOCK_STREAM, 0);
    $socket->bind('127.0.0.1', 9501);
    $socket->listen(128);
    while(true) {
        $client = $socket->accept();
        if ($client === false) {
            var_dump($socket->errCode);
        } else {
            echo $client->recv() . PHP_EOL;
        }
    }
});