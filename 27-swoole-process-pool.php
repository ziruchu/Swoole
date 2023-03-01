<?php

$pool = new Swoole\Process\Pool(3);

$pool->on('WorkerStart', function ($pool, $workerId) {
    $redis = new Redis();
    $redis->pconnect('127.0.0.1', 6379);
    $key = 'name';
    
    while (true) {
        $msgs = $redis->brpop($key, 2);
        if ($msgs == null) {
            continue;
        }
        echo '处理进程：' . $workerId . PHP_EOL;
        print_r($msgs);
    }
});

$pool->on('WorkerStop', function (\Swoole\Process\Pool $pool, $workerId) {
    echo("[Worker #{$workerId}] WorkerStop\n");
});

$pool->start();






