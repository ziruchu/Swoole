<?php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('连接服务器失败' . $client->errCode . PHP_EOL);
}

$client->send(str_repeat('www.ziruchu.com', 1024 * 1024 *1));
 
if (!$data = $client->recv()) {
	die('数据接收失败');
}

$client->close();

