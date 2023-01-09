<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num' 	=> 2,
	'reactor_num' 	=> 3,
	'task_worker_num' => 2,
]);

$server->on('Connect', function ($server, $fd, $reactorId) {
        echo $fd . ' 连接了' . PHP_EOL;
});

$server->on('Start', function($server) {
});

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	echo '主进程 ' . $server->master_pid . PHP_EOL;
	echo '管理进程 ' . $server->manager_pid . PHP_EOL;
	// 当前客户端连接的 Worker PID
	echo 'workerPid 进程 ' . $server->worker_pid . PHP_EOL;
	echo 'worker 进程 ' . $server->worker_id . PHP_EOL;
	
	foreach ($server->connections as $fd) {
		echo $fd . PHP_EOL;
	}
});

$server->on('Workerstart', function ($server) {
	if ($server->taskworker) {
		echo 'task pid ' . $server->worker_pid . PHP_EOL;
	} else {
		echo 'worker pid' . $server->worker_pid . PHP_EOL;
	}
});

// 监听异步任务
$server->on('Task', function($server, $taskId, $srcWorkerId, $data) {
});

// 监听异步任务完成
$server->on('Finish', function($server, $taskId, $data) {

});

$server->on('Close', function ($server,$fd) {
});

$server->start();