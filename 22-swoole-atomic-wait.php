<?php
// 22-swoole-atomic-wait.php
if (pcntl_fork() > 0) {
	echo '父进程启动' . PHP_EOL;
	sleep(1);
	echo '父亲进程执行结束' . PHP_EOL;
} else {
	echo '子进程启动' . PHP_EOL;
	sleep(1);
	echo '子进程执行结束' . PHP_EOL;
}
