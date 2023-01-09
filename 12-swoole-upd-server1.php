<?php


$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

$server->set([
	'worker_num'      => 10,
	'task_worker_num' => 9,
]);

$server->on('Packet', function ($server, $data, $clientInfo) {
	$server->sendto($clientInfo['address'], $clientInfo['port'], 'server:' . $data);

	// 异步处理任务
	$server->task($data);
});

$server->on('Task', function ($server, $taskId, $fromId, $data) {
	// echo 'this task ' . $taskId . ' from worker ' . $fromId . PHP_EOL;
	// echo 'data: ' . PHP_EOL;
	// 处理慢任务处理
	for ($i = 0; $i < 3; $i++) { 
		sleep(1);
		echo '任务 '. $taskId . '处理中 ' . $i . '请等待...' . PHP_EOL;
	}

	return $taskId;
});

$server->on('Finish', function ($server, $taskId, $data) {
	echo '任务: ' . $taskId . ' 完成, 数据是 ' . $data . PHP_EOL;
});

$server->start();
