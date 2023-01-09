<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'      => 3,
	'task_worker_num' => 3,
]);


$server->on('Receive', function ($server, $fd, $reactorId, $data) {
	$tasks[] = mt_rand(1000, 9999); //任务1
	$tasks[] = mt_rand(1000, 9999); //任务2
	$tasks[] = mt_rand(1000, 9999); //任务3

	//等待所有Task结果返回，超时为10s
	$results = $server->taskWaitMulti($tasks, 10.0);
	if (isset($results[0])) {
	    echo "任务2的执行结果为{$results[0]}\n";
	}
	if (isset($results[1])) {
	    echo "任务2的执行结果为{$results[1]}\n";
	}
	if (isset($results[2])) {
	    echo "任务3的执行结果为{$results[2]}\n";
	}
});

$server->on('Task', function ($server, $taskId, $srcWorkerId, $data) {
	sleep(2);

	return 'success ' . $data;
});

$server->on('Finish', function ($server, $taskId, $data) {

});

$server->start();
