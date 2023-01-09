<?php
// 进程之间发送消息

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
    'worker_num' => 5,
    'reactor_num' => 3,
]);

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
	// 向其他进程发送消息
	$server->sendMessage('hello', 1 - $server->worker_id);
});

// 监听管道，接收其他 进程发送的消息
$server->on('pipeMessage', function ($server, $srcWorkerId, $data) {
	echo 'pipeMessage #' . $server->worker_id . ' message from #' . $srcWorkerId . $data . PHP_EOL;
});

$server->start();

