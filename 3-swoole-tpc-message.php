<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);


$server->on('Receive', function ($server, $fd, $reactorId, $data) {
	// 向客服端发送数据
	//$server->send($fd, 'Server：Hello ' . $fd . ' ,你发送的消息是: ' . $data) . PHP_EOL;

	$server->sendFile($fd, './message.txt');
});

$server->start();


