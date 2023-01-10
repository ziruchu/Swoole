<?php
// 24-swoole-process-queue.php
// 学习的 5.1 版本中，没有提供此方法，虽然可以使用

$data = [
	'PHP',
	'Laravel',
	'TP'
];

$workers = [];

foreach ($data as $v) {
	$process = new Swoole\Process('process_queue');
	$process->useQueue(1, 2, Swoole\Process::IPC_NOWAIT);
	$pid = $process->start();
	$process->push('hello 子进程');
	echo '主进程打印的内容：' . $process->pop() . PHP_EOL;
}

function process_queue($worker) {
	echo '来自主进程的消息：' . $worker->pop() . ',来自管道 ' . $worker->pipe . ' 当前的进程 ID 为 ' . $worker->pid . PHP_EOL;
	$worker->push('hello 主进程');
	$worker->exit();
}

// 避免产生僵尸进程
Swoole\Process::signal(SIGCHLD, function () {
	while ($res = Swoole\Process::wait(falses)) {
		print_r($res);
	}
});
