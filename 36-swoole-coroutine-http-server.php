<?php
// 36-swoole-coroutine-http-server.php

Swoole\Coroutine\run(function () {
    $http = new Swoole\Coroutine\Http\Server('0.0.0.0', 9501, false);
    $http->handle('/', function ($request, $response) {
        $response->end("<h1>Index</h1>");
    });
    $http->handle('/test', function ($request, $response) {
        $response->end("<h1>Test</h1>");
    });
    $http->handle('/stop', function ($request, $response) use ($http) {
        $response->end("<h1>Stop</h1>");
        $http->shutdown();
    });
    $http->start();
});

