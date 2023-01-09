<?php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('连接服务器失败' . $client->errCode . PHP_EOL);
}

$client->send('i am 9501 port');

echo $client->recv() . PHP_EOL;

$client->close();