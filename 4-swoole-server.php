<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	$server->send($fd, '服务器返回：' . $data) . PHP_EOL;
});

$server->start();