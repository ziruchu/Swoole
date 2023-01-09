<?php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

if (! $client->connect('127.0.0.1', 9501, -1)) {

	exit('connect failed. Error:' . $client->errCode . PHP_EOL);
}

$client->send('hi, server,, 请开始执行异步任务');

echo $client->recv();

$client->close();
