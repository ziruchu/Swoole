<?php

$client = new Swoole\Client(SWOOLE_SOCK_TCP);

if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('连接服务器失败' . $client->errCode . PHP_EOL);
}

for ($i = 0; $i < 5; $i++) {
	$data = 'i am client. ';
	$data = pack('n', strlen($data)) . $data;
	$client->send($data);
}
 
$client->close();

