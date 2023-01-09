<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	echo 'Server：' . $data . PHP_EOL;
});

$server->start();



