<?php
// 40-coroutine-1.php

// 案例一
for ($c = 1000; $c--;) {
    go(function () {//创建100个协程
        $redis = new Redis();
        $redis->connect('127.0.0.1', 6379);//此处产生协程调度，cpu切到下一个协程，不会阻塞进程
        $redis->set('name', '王美丽');
        echo $redis->get('name');//此处产生协程调度，cpu切到下一个协程，不会阻塞进程
    
    });
}

// 案例二
go(function () {
    // 使用原生数据库方式操作
    $dsn = "mysql:host=127.0.0.1;dbname=test1";
    $pdo = new PDO($dsn, 'root', '123456');
    $statement = $pdo->query("select * from test7");
    $row = $statement->fetch(PDO::FETCH_ASSOC);
    print_r($row);
});

// 案例三
go(function () {
    echo '我会先输出吗？' . PHP_EOL;
});


