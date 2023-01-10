<?php
// 24-swoole-process-base-1.php

$process = new Swoole\Process('process_callback');

function process_callback () {
	echo 'Swoole Process';
}

$process->start();


