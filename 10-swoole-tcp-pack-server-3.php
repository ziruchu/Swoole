<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'            => 3,
	// 开启协议解析
	'open_length_check'     => true,
	// 协议最大长度
	'package_max_length'    => 81920,
	// 长度字段类型
	'package_length_type'   => 'n', 
	// 第几个字节是包的长度值
	'package_length_offset' => 0,
	// 第几个字节开始计算长度
	'package_body_offset'   => 2,
]);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	$info = unpack('n', $data);
	$len  = $info[1];
	$body = substr($data, - $len);
	echo 'server: ' . $body .PHP_EOL;
});


$server->start();


