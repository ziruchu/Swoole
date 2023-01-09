<?php

// 实例一个 tcp 客户端
$client = new Swoole\Client(SWOOLE_SOCK_TCP);

// 连接服务端
if (! $client->connect('127.0.0.1', 9501)) {
    exit('连接服务端失败 ' . $client->errCode . PHP_EOL);
}

// 向服务端发送消息
$client->send('Client: hello swoole' . PHP_EOL);

// 输出服务端返回的消息
echo $client->recv();

// 关闭连接
$client->close();

