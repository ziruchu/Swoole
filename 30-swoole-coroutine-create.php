<?php

// 30-swoole-coroutine-create.php


// 方式一：创建协程
// echo 'start' . PHP_EOL;
// Swoole\Coroutine::create(function () {
    
//     Swoole\Coroutine::sleep(1);
//     echo 'hello coroutine end' . PHP_EOL;

// });
// echo 'end' . PHP_EOL;

// 方式二：go 函数创建
// echo 'start' . PHP_EOL;
// go(function () {
//     Swoole\Coroutine::sleep(1);
//     echo 'hello coroutine end' . PHP_EOL;
// });
// echo 'end' . PHP_EOL;
// use Swoole\Coroutine;

// 方式三：协程容器创建协程
// echo 'start' . PHP_EOL;
// $scheduler = new Swoole\Coroutine\Scheduler;
// $scheduler->add(function () {
//     Co::sleep(1);
//     echo 'hello coroutine' . PHP_EOL;
// });
// echo 'end' . PHP_EOL;
// $scheduler->start();

// 方式四：协程容器
// echo 'start' . PHP_EOL;
// Co\run(function () {
//     Co::sleep(1);
//     echo 'hello coroutine' . PHP_EOL;
// });
// echo 'end' . PHP_EOL;

