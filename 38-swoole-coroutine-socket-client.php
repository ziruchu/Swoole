<?php
// 38-swoole-coroutine-socket-client.php

 
Swoole\Coroutine\run(function () {
    $socket = new Swoole\Coroutine\Socket(AF_INET, SOCK_STREAM, 0);

    $retval = $socket->connect('127.0.0.1', 9501);
    while ($retval) {
        $socket->send('hello');
      
        $data = $socket->recv();

        echo $data . PHP_EOL;


        //发生错误或对端关闭连接，本端也需要关闭
        if ($data === '' || $data === false) {
            echo "errCode: {$socket->errCode}\n";
            $socket->close();
            break;
        }

        Swoole\Coroutine::sleep(1.0);
    }

    var_dump($retval, $socket->errCode, $socket->errMsg);
});