<?php
// 24-swoole-process-base-exce.php

$process = new Swoole\Process(function ($worker) {
	// 执行一个外部程序
	$worker->exec('/usr/local/php-8.2.0/bin/php', [__DIR__ . '/24-exec.php']);
});

// 启动子进程
$process->start();

// 获取子进程必须在 start() 之后
echo '子进程 ID ' . $process->pid . PHP_EOL;

Swoole\Process::wait();


