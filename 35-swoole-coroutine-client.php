<?php
// 35-swoole-coroutine-client.php

Swoole\Coroutine\run(function () {
    $client = new Swoole\Coroutine\Client(SWOOLE_SOCK_TCP);
    if (!$client->connect('127.0.0.1', 9501, 0.5)) {
        echo "connect failed. Error: {$client->errCode}\n";
    }
    $client->send("我是协程客户端\n");
    echo $client->recv();
    $client->close();
});