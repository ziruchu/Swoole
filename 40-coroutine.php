<?php
// 40-coroutine.php

// 开启协程调度
Swoole\Runtime::enableCoroutine();


for ($c = 1000; $c--;) {
    go(function () {//创建100个协程
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);//此处产生协程调度，cpu切到下一个协程，不会阻塞进程
        $redis->set('name', '王美丽');
        echo $redis->get('name');//此处产生协程调度，cpu切到下一个协程，不会阻塞进程
    
    });
}

go(function () {
    $dsn = "mysql:host=127.0.0.1;dbname=test1";
    $pdo = new PDO($dsn, 'root', '123456');
    $statement = $pdo->query("select * from test7");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    print_r($row);
});

go(function () {
    echo '我会先输出' . PHP_EOL;
});


