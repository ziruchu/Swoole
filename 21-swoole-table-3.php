<?php

// 21-swoole-table-3.php

$table = new Swoole\Table(1024);
$table->column('fd', Swoole\Table::TYPE_INT);
$table->column('reactor_id', Swoole\Table::TYPE_INT);
$table->column('data', Swoole\Table::TYPE_STRING, 64);
$table->create();

$serv = new Swoole\Server('127.0.0.1', 9501);
$serv->set(['dispatch_mode' => 1]);
// 设置 table 实例为 server 的属性
$serv->table = $table;

$serv->on('receive', function ($serv, $fd, $reactor_id, $data) {

    $cmd = explode(" ", trim($data));

    if ($cmd[0] == 'get')
    {
        // 获取 table 数据
        if (count($cmd) < 2) {
            $cmd[1] = $fd;
        }
        $getFd = intval($cmd[1]);
        $info  = $serv->table->get($getFd);
        // 将数据返回给客户端
        $serv->send($fd, var_export($info, true)."\n");
    } elseif ($cmd[0] == 'set') {
        // 设置 Table 数据
        $ret = $serv->table->set($fd, ['reactor_id' => $data, 'fd' => $fd, 'data' => $cmd[1]]);
        if ($ret === false) {
            $serv->send($fd, "ERROR\n");
        } else {
            $serv->send($fd, "OK\n");
        }
    } else {
        $serv->send($fd, "command error.\n");
    }
});

$serv->start();