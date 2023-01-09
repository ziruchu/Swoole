<?php
// 13-swoole-client.php

$client = new Swoole\Client(SWOOLE_SOCK_TCP, SWOOLE_SOCK_SYNC);


if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('连接服务器失败' . $client->errCode . PHP_EOL);
}

for ($i = 0; $i < 3; $i++) { 
	$client->send($i);
	echo $client->recv();
}

$client->close();

