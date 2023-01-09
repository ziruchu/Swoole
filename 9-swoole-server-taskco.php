<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'      => 3,
	'task_worker_num' => 2
]);


$server->on('Receive', function ($server, $fd, $reactorId, $data) {

	$tasks = [1,2,3];

	//等待所有Task结果返回，超时为10s
	$results = $server->taskCo($tasks, 5);

	print_r($results);
});

$server->on('Task', function ($server, $taskId, $srcWorkerId, $data) {
	sleep(3);
	echo 'task ' . $data . PHP_EOL;
	return 'success ' . $data;
});

$server->on('Finish', function ($server, $taskId, $data) {

});

$server->start();

