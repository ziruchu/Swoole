<?php

/**
 * 全协程 HTTP 服务
 */
// Swoole\Coroutine\run(function () {
//     $server = new Swoole\Coroutine\Http\Server('0.0.0.0', 9501, false);
//     $server->handle('/', function ($reqeust, $response) {
//         $response->header('Content-Type', 'text/html; charset=utf-8');
//         $response->end('<h1>hi，我是王美丽</h1>');
//     });
//     $server->handle('/test', function ($reqeust, $response) {
//         $response->header('Content-Type', 'text/html; charset=utf-8');
//         $response->end('<h1>hi，我是郝帅</h1>');
//     });
//     $server->handle('/stop', function ($request, $response) use ($server) {
//         $response->end("<h1>Stop</h1>");
//         $server->shutdown();
//     });
    
//     $server->start();
// });

// // 不执行 stop，该行不会被输出
// echo '我来自外星，我会被输出吗？';


/**
 * 协程并发
 */
// Swoole\Coroutine\run(function () {
//     Swoole\Coroutine::create(function () {
//         echo strlen(file_get_contents('https://www.baidu.com')) . PHP_EOL;
//     });
//     Swoole\Coroutine::create(function () {
//         Swoole\Coroutine::sleep(1);
//         echo '嗨，我要去火星了' . PHP_EOL;
//     });
// });
// echo '我会被执行' . PHP_EOL;


/**
 * scheduler 基础案例
 */
// // 实例化协程容器
// $scheduler = new Swoole\Coroutine\Scheduler;
// // 设置协程参数
// $scheduler->set([
//     'max_coroutine' => 100,
// ]);
// // 添加任务
// $scheduler->add(function (string $name, int $age) {
//     Swoole\Coroutine::sleep(1);
//     echo '我是 ' . $name . ' ,我 ' . $age . PHP_EOL;
// }, '王美丽', 18);
// // 获取设置的参数
// print_r($scheduler->getOptions());
// // 启动程序
// $scheduler->start();


/**
 * parallel 并行任务案例
 */
// $scheduler = new Swoole\Coroutine\Scheduler();
// $scheduler->parallel(10, function () {
//     echo '当前协程 ID ' . Swoole\Coroutine::getCid() . PHP_EOL;
// });
// $scheduler->start();

