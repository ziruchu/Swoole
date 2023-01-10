<?php
// 24-swoole-process-pipe-1.php

$process = new Swoole\Process('process_callback', true);


function process_callback($worker) {
	// 将数据写入管道
	$worker->write('pipe message');
}

$process->start();
// 读取管道中的数据
echo '管道信息：' . $process->read();

