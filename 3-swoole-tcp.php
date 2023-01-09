<?php
// 3-swoole-tcp.php

// 实例 Server 对象，监听 0.0.0.0:9501
$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS, SWOOLE_SOCK_TCP);

// 设置参数
$server->set([
    // 设置 worker 进程数量
    'worker_num' => 2,
    // 设置 reactor 线程数量
    'reactor_num' => 3,
]);

// 监听客户端连接事件。客户端连接进来时触发
$server->on('Connect', function ($server, $fd, $reactorId) {
        echo '有人连接进来了，是一个编号为 ' . $reactorId . ' 守卫把一个身份证号为 ' . $fd . ' 的家伙放进来了' . PHP_EOL;
});

// 监听数据接收事件。服务端收到客户端数据后，在 worker 进程中出发该回调
$server->on('Receive', function ($server, $fd, $fromId, $data) {
    // 服务端收到消息后，通过 send 方法给客户端发送消息
    $server->send($fd, 'Server：' . $fd . ' ，一起去看海啊');
});

// 监听连接关闭事件。客户端关闭，或服务端主动关闭
$server->on('Close', function ($server, $fd) {
    echo '服务端主动关闭：上班了，好好干';
});


// 启动服务器
$server->start();





