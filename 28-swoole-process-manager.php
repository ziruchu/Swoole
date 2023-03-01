<?php

// 28-swoole-process-manager.php

// 实例化进程管理器
/**
* $ipcType 同 Process\Pool 的 $ipc_type 一致【默认为 0 表示不使用任何进程间通信特性】
* $msgQueueKey 消息队列的 key，和 Process\Pool 的 $msgqueue_key 一致
*
**/ 
$pm = new Swoole\Process\Manager();

// 添加一个工作进程
$pm->add(function (Swoole\Process\Pool $pool, $workerId) {
    echo $workerId . PHP_EOL;
    while(true) {
    }
});

// 启动工作进程
$pm->start();