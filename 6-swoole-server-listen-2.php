<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
    'worker_num'  => 3,
    'reactor_num' => 3,
]);

// 绑定一个新的端口 9502
$portServer = $server->listen('0.0.0.0', 9502, SWOOLE_SOCK_TCP);

// 单品为绑定的新端口添加回调
$portServer->on('Receive', function ($portServer, $fd, $reactorId, $data) {
    echo $portServer->send($fd, '9502 VIP 服务通道，为 ' . $fd . '开启');
});


$server->on('Connect', function ($server, $fd, $reactorId) {
});

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
    echo $server->send($fd, '普通服务处理, ' . $fd . '-' . $data);
});

$server->start();

