<?php

// 29-swoole-coroutine-1.php

use Swoole\Coroutine\Client;
use function Swoole\Coroutine\run;

// 协程客户端
run(function () {
    $client = new Client(SWOOLE_SOCK_TCP);
    if (! $client->connect('127.0.0.1', 9501, 0.5)) {
        echo '连接失败，错误码：' . $client->errCode . PHP_EOL;
    }

    $client->send("hello world\n");
    echo $client->recv();
    $client->close();
});


