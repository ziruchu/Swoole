<?php

require_once '14-test.php';

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->on('Receive', function ($server, $fd, $reactorId, $data) {
    $test = new Test;
    $test->run($data);
});

$server->start();


