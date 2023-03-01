<?php

// 29-swoole-server-1.php

$server = new Swoole\Server('0.0.0.0', 9501);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
    echo '来自客户端： ' . $fd . ' 的消息： ' . $data;
    $server->send($fd, 'Swoole: ' . $data);
    $server->close($fd);
});

$server->start();


