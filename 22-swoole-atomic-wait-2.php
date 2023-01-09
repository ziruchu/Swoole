<?php
// 22-swoole-atomic-wait-2.php

$atomic = new Swoole\Atomic();

if (pcntl_fork() > 0) {
	echo '父进程启动' . PHP_EOL;
	// 设置 wait 状态
	$atomic->wait(5);
	echo '父亲进程执行结束' . PHP_EOL;
} else {
	echo '子进程启动' . PHP_EOL;
	// 唤醒处于 wait 状态的进程
	$atomic->wakeup();
	echo '子进程执行结束' . PHP_EOL;
}
