<?php

$server = new Swoole\Server('0.0.0.0', 9501, SWOOLE_PROCESS);

$server->set([
	'worker_num'     => 3,
	// 配置结束符号
	'package_eof'    => "\r\n",
	// 开启 eof 检测
	'open_eof_check' => true,
	// 开启自动拆分
	// 'open_eof_split' => true,
]);

$server->on('Receive', function ($server, $fd, $fromId, $data) {
	$datas = explode("\r\n", $data);
	foreach ($datas as $data) {
		if (!$data) {
			continue;
		}
		echo 'Server：' . $data . PHP_EOL;
	}
});


$server->start();


