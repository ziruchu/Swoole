<?php
// 22-swoole-atomic-test.php
// 
$atomic = new Swoole\Atomic();

$pool = new Swoole\Process\Pool(3, SWOOLE_IPC_NONE, 0, true);

$pool->on('Workerstart', function ($pool, $workerId) use ($atomic) {
	Swoole\Timer::tick(1000, function () use ($atomic, $workerId) {
		echo '工作进程 ' . $workerId . ' : ' . '原子计数 ' . $atomic->get() . PHP_EOL;
		$atomic->add(1); 
	});
});

$pool->on('WorkerStop', function ($pool, $workerId) {
	echo $workerId . ' Stop' . PHP_EOL;
});

$pool->start();
