<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
    'worker_num'  => 3,
    'reactor_num' => 3,
]);

// 绑定一个新的端口 9502
$server->listen('0.0.0.0', 9502, SWOOLE_SOCK_TCP);

$server->on('Connect', function ($server, $fd, $reactorId) {
    // 输出来自于哪个端口
    echo $server->getClientInfo($fd)['server_port'] . PHP_EOL;
});

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
    $port = $server->getClientInfo($fd)['server_port'];
    if ($port == 9501) {
        $server->send($fd, $port . ' 你的 websockert 任务正在处理');
    } else {
        $server->send($fd, $port . ' 你的 AI 任务正在处理');
    }

});

$server->start();

