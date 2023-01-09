<?php

// 实例化 http server 对象
$http = new Swoole\Http\Server('0.0.0.0', 9501);

// 监听网络请求
$http->on('Request', function ($request, $response) {

    var_dump($request->server['request_method']);
    var_dump($request->getMethod());
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $response->header('Application-Json');
    $response->end('<h1>Hello Swoole. #' . rand(1000, 9999) . '</h1>');
});

// 启动 http server
$http->start();