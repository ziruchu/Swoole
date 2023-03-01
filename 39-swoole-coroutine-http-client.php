<?php

// 39-swoole-coroutine-http-server.php


// Swoole\Coroutine\run(function () {
//     $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9502);
//     $client->setHeaders([
//         'Host' => 'localhost',
//         'User-Agent' => 'Chrome/49.0.2587.3',
//         'Accept' => 'text/html,application/xhtml+xml,application/xml',
//         'Accept-Encoding' => 'gzip',
//     ]);
//     $client->set(['timeout' => 1]);
//     // 发送 GET 请求
//     $client->get('/');
//     echo $client->body;
//     $client->close();
// });


// Swoole\Coroutine\run(function () {
//     $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9502);
//     $client->post('/test', ['web_name'=>'自如初']);
//     echo $client->body;
//     $client->close();
// });


// Swoole\Coroutine\run(function () {
//     $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9502);
//     $client->setCookies(['age'=>19]);
//     var_dump($client->getCookies());
//     $client->close();
// });


// Swoole\Coroutine\run(function () {
//     $client = new Swoole\Coroutine\Http\Client('127.0.0.1', 9502);
//     var_dump($client->getBody());
//     $client->close();
// });
    

Swoole\Coroutine\run(function () {
    $data1 = Swoole\Coroutine\Http\request('http://localhost:9502/test', 'get');
    $data2 = Swoole\Coroutine\Http\get('http://localhost:9502/test');
    $data3 = Swoole\Coroutine\Http\post('http://localhost:9502/test',[]);
});
    

