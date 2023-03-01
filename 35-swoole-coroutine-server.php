<?php
// 35-swoole-coroutine-server.php

$scheduler = new Swoole\Coroutine\Scheduler();
$scheduler->add(function () {
    // 协程 TCP 服务端
    $server = new Swoole\Coroutine\Server('0.0.0.0', 9501);
    // 设置连接处理函数
    $server->handle(function (Swoole\Coroutine\Server\Connection $conn) {
        echo '神界：哟，来新人了：' . $conn->recv() . PHP_EOL;
        $conn->send('我是神界接引人');
    });
    $server->start();
});
$scheduler->start();


/*
// 方式二
Swoole\Coroutine\run(function () {
    $server = new Swoole\Coroutine\Server('0.0.0.0', 9501);
    $server->handle(function ($conn) {
        echo $conn->recv() . PHP_EOL;
    });
    $server->start();
});
*/


