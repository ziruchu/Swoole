<?php

// 35-swoole-client.php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);
if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('connect failed. Error:' . $client->errCode . PHP_EOL);
}
$client->send('I am Swoole Client');
echo $client->recv() . PHP_EOL;
$client->close();

