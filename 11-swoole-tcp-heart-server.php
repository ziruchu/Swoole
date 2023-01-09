<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'               => 3,
	'heartbeat_check_interval' => 5,
	'heartbeat_idle_time'      => 15,
]);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	echo $data . PHP_EOL;
});

$server->start();


