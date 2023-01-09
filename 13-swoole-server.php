<?php
// 13-swoole-server.php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'       => 1,
	'task_worker_num'  => 1,
	'max_request'      => 2,
	'task_max_request' => 2
]);


$server->on('Receive', function ($server, $fd, $fromId, $data) {
	$server->send($fd, 'server: ' . $data);
	$server->task($data);
});

$server->on('Task', function ($server, $taskId, $fromId, $data) {
});

$server->on('Finish', function ($server, $taskId, $data) {
});

$server->start();
