<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'  => 3,
	'reactor_num' => 3,
]);

// 监听不同的端口
$portServer1 = $server->listen('0.0.0.0', 9502, SWOOLE_SOCK_TCP);
$portServer2 = $server->listen('0.0.0.0', 9503, SWOOLE_SOCK_UDP);

// 为不同的端口配置参数
$portServer1->set([
	// 开启固定包头协议
	'open_length_check'     => true,
	'package_length_type'   => 'N',
	'package_length_offset' => 0,
	'package_max_length'    => 80000,
]);

$portServer2->set([
	'open_eof_split' => true,
	// 设置消息结束符
	'package_eof'    =>	'eof',  
]);

$server->on('Receive', function ($server, $fd, $reactorId) {
});

// UDP 协议接收数据
$server->on('Packet', function ($portServer2, $data, $clientInfo) {
});

$server->start();

