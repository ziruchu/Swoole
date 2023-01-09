<?php

// 实例化 http server 对象
$http = new Swoole\Http\Server('0.0.0.0', 9501);

$http->set([
    'worker_num'=>2,
]);


$i = 1;
// 监听网络请求
$http->on('Request', function ($request, $response) {
    global $i;
    $response->end($i++);

    
});

// 启动 http server
$http->start();