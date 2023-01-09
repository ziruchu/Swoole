<?php

$server = new Swoole\WebSocket\Server('0.0.0.0', 9501);

// 监听客户端连接
$server->on('Open', function ($server, $request) {
	print_r($request);
	$server->push($request->fd, 'hello WebSocket');
});

// 监听客户端发送的数据
$server->on('Message', function ($server, $frame) {
	echo $frame->data . PHP_EOL;
});


// 监听连接关闭
$server->on('Close', function ($server, $fd) {
	echo '关闭客户端：' . $fd . PHP_EOL;
});


// 启动服务
$server->start();
