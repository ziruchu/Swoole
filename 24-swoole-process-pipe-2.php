<?php
// 24-swoole-process-pipe-2.php

// 子进程执行任务
$workers = [];

// 要获取的数据 URL
$urls = [
	'https://baidu.com',
	'https://qq.com',
	'https://sina.com.cn',
	'https://baidu.com?search=php',
	'https://baidu.com?search=linux',
	'https://baidu.com?search=laravel',
];

// 创建多个进程用于处理任务
for ($i = 0; $i < 6; $i++) {
	$process = new Swoole\Process(function ($worker) use ($i, $urls) {
		echo '子进程 ' . $worker->pid . ' 执行 ' . $urls[$i] . PHP_EOL;

		// 获取远程内容
		$content = curl_data($urls[$i]);
		// 将内容写入管道
		$worker->write($content);
	});

	// 子进程 PID
	$pid = $process->start();
	// 子进程对象写入数组
	$workers[$pid] = $process;
}

// 子进程执行结束后，读取管道中的数据内容
foreach ($workers as $process) {
	// 若子进程没有往管道中写入数据，主进程读取时会出现阻塞
	echo $process->pid . ' ' .  $process->read();
}


/**
 * 模拟 CURL 获取内容
 * 
 * @param  string $url 
 * @return string
 */
function curl_data($url) {
	// return file_get_contents($url);

	// 延迟 1 秒，模拟远程获取内容所消耗的时间
	sleep(1);
	return $url . ' success ' . PHP_EOL;
}



