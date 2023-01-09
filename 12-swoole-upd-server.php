<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_UDP);

// 监听数据接收事件
$server->on('Packet', function ($server, $data, $clientInfo) {
	// print_r($clientInfo);
    $server->sendto($clientInfo['address'], $clientInfo['port'], 'Server:' . $data);
});

$server->start();