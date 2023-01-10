<?php
// 24-swoole-process-2.php

// 创建进程（父进程）
$process = new Swoole\Process('process_callback');

// 子进程
function process_callback () {
	echo 'Swoole Process' . PHP_EOL;
}

// 启动子进程
$process->start();

// 子进程结束后父进程再退出
// 操作成功会返回一个数组包含子进程的 PID、退出状态码、被哪种信号 KILL
Swoole\Process::wait();



