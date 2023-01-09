<?php

$client = new Swoole\Client(SWOOLE_SOCK_UDP);

if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('连接服务器失败' . $client->errCode . PHP_EOL);
}

$i = 0;
while ($i < 10) {
	$client->send($i . PHP_EOL);
	$message = $client->recv();
	echo 'get message from server:' . $message . PHP_EOL;
	$i++;
}


