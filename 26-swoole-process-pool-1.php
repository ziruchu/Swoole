<?php
// 25-swoole-process-pool-1.php

// 实例进程池对象
$pool = new Swoole\Process\Pool(3);

// 监听子进程启动
$pool->on('WorkerStart', function ($pool, $workerId) {
	while (true) {
	}
});

// 监听子进程终止
$pool->on('WorkerStop', function (\Swoole\Process\Pool $pool, $workerId) {
    echo("[Worker #{$workerId}] WorkerStop\n");
});

// 启动工作进程
$pool->start();


