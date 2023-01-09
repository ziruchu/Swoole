<?php

// 实例化客户端
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

// 连接服务端
if (!$client->connect('127.0.0.1', 9501, -1)) {
	exit('connect failed. Error:' . $client->errCode . PHP_EOL);
}

// 发送消息给服务端
$client->send('I am Swoole Client');
// 接收服务端返回的消息
echo $client->recv();

// 关闭客户端
$client->close();