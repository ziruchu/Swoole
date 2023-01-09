<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num' => 2,
	'task_worker_num' => 2,
]);


$server->on('Receive', function ($server, $fd, $reactorId, $data) {
	$server->task($data);
	$server->send($fd, '收到客户端信息，异步任务已投递');
	echo '我是 worker 进程，继续往下走' . PHP_EOL;
});

/**
 * $server Swoole/Server 实例对象
 * $taskId 投递的任务 ID
 * $fromId 来自哪个 worker 进程的 ID
 * $data   要投递的任务数据
 **/
$server->on('Task', function ($server, $taskId, $fromId, $data) {
	echo '来自 ' . $fromId . ' 的异步任务 ' . $taskId . ' 开始执行' . PHP_EOL;
	for ($i = 0; $i < 10; $i++) {
		sleep(1);
		echo '运行异步任务 ' . $i . PHP_EOL;
	}
	return 'task end' . PHP_EOL;
});

/**
 * 该回调只在 task 进程中调用了 finish() 方法或 return 时才会触发
 * 
 * $server Swoole/Server 实例对象
 * $taskId 投递的任务 ID
 * $data   要投递的任务数据
 **/
$server->on('Finish', function ($server, $taskId, $data) {
	echo 'Finish 异步任务执行完成，taskId=' . $taskId . '数据是：' . $data . PHP_EOL;
});

$server->start();

