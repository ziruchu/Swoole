<?php



$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
    'worker_num' => 1,
    'log_file'   => __DIR__ . '/server.log',
]);

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
    $test = new Test;
    $test->run($data);
});

$server->on('Workerstart', function($server, $workerId) {
    require_once '14-test.php';
});

$server->start();


