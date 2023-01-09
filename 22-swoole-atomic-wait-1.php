<?php
// 22-swoole-atomic-wait-1.php

$atomic = new Swoole\Atomic();

if (pcntl_fork() > 0) {
	echo '父进程启动' . PHP_EOL;
	$atomic->wait(5);
	echo '父亲进程执行结束' . PHP_EOL;
} else {
	echo '子进程启动' . PHP_EOL;
	echo '子进程执行结束' . PHP_EOL;
}
