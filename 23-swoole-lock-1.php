<?php
// 23-swoole-lock.php

$lock = new Swoole\Lock();



$pool = new Swoole\Process\Pool(3, SWOOLE_IPC_NONE, 0, true);

$pool->on('Workerstart', function ($pool, $workerId) use ($lock) {
	echo '进程 ' . $workerId . '执行' . PHP_EOL;
	$lock->lock();
	echo '进程 ' . $workerId . ' 获得锁 ' . microtime(true) . PHP_EOL;
	sleep(3);
	$lock->unlock();
	echo '进程 ' . $workerId . ' 退出 ' . PHP_EOL;

});

$pool->start();

// echo "[Master]create lock\n";
// $lock->lock();
// if (pcntl_fork() > 0)
// {
//   sleep(1);
//   $lock->unlock();
// } 
// else
// {
//   echo "[Child] Wait Lock\n";
//   $lock->lock();
//   echo "[Child] Get Lock\n";
//   $lock->unlock();
//   exit("[Child] exit\n");
// }
// echo "[Master]release lock\n";
// unset($lock);
// sleep(1);
// echo "[Master]exit\n";