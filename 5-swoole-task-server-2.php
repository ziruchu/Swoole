<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'      => 2,
	'reactor_num'     => 6,
	'task_worker_num' => 5,
	'max_request'     => 1000,
]);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	// 模拟数据
	$data = [];
	for ($i = 0; $i < 16; $i++) {
		$data[$i] = ['id' => $i, 'name' => '自如初'];
	}

	$server->send($fd, '正在处理数据');

	// worker 进程数
	$taskWorkerNum = 5;
	$count         = count($data);
	// 分块处理数据
	$data          = array_chunk($data, ceil($count / $taskWorkerNum));
	// 分配给不同的进程处理
	foreach ($data as $k => $v) {
		$v['src_worker_id'] = $k;
		$server->task($v, $k);
	}
	echo '继续执行同步任务' . PHP_EOL;
});


$server->on('Task', function ($server, $taskId, $srcWorkerId, $data) {
	echo '消息任务 ' . $taskId . ' 来自于 worker-' . $srcWorkerId . PHP_EOL;
	sleep(3);
	return [
		'succ' => $data['src_worker_id'],
	];
});

$server->on('Finish', function ($server, $taskId, $data) {
	echo 'task：' . $taskId . ' -任务处理完成' . PHP_EOL;
});


$server->start();
