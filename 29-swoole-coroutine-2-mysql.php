<?php
use Swoole\Coroutine\MySQL;
$server=new swoole\http\server("0.0.0.0",9503);

//swoole会开辟一个协程栈,对协程栈进行初始化
$server->on('request',function($request, $response){
    $response->header('Content-Type', 'text/html; charset=utf-8');
    $mysql = new MySQL();
    $res = $mysql->connect([
        'host' => '127.0.0.1',
        'port' => 3306,
        'user' => 'root',
        'password' => '123456',
        'database' => 'test1',
    ]);

    if ($res == false) {
        $response->end('connect is fail');
        return;
    }

    $ret = $mysql->query('show tables');

    $response->end('swoole is ok, result = ' . var_export($ret, true));
});

$server->start();