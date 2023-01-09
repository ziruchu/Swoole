<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
    'worker_num' => 3,
    'task_worker_num'=>2,
]);

$server->on('Connect', function ($server, $fd) {
    echo $fd . ' 客户端连接' . PHP_EOL;
});

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
    $server->send($fd, '服务器返回：' . $data) . PHP_EOL;
});

$server->on('Task', function (Swoole\Server $server, Swoole\Server\Task $task) {
});

$server->on('Start', function ($server) {
    echo 'master 进程启动' . PHP_EOL;
    swoole_set_process_name('swoole:master');
});

$server->on('ManagerStart', function ($server) {
    swoole_set_process_name('swoole:manager');
});

$server->on('WorkerStart', function ($server, $workerId) {
    if($workerId >= $server->setting['worker_num']) {
        swoole_set_process_name("swoole:task worker");
    } else {
        swoole_set_process_name("swoole:php worker");
    }
});



$server->on('Close', function ($server, $fd) {
    echo '客户端断开连接' . PHP_EOL;
});



$server->start();