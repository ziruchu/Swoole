<?php

// 39-swoole-coroutine-server.php

Swoole\Coroutine\run(function () {
    $http = new Swoole\Coroutine\Http\Server('0.0.0.0', 9502, false);


    $http->handle('/', function ($request, $response) {
        $response->cookie('webName', '自如初');
        $response->end("<h1>Index</h1>");
    });
    $http->handle('/test', function ($request, $response) {
        print_r($request->post);
        $response->end("<h1>Test</h1>");
    });
    $http->handle('/stop', function ($request, $response) use ($http) {
        $response->end("<h1>Stop</h1>");
        $http->shutdown();
    });
    $http->start();
});




