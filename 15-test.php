<?php

Swoole\Timer::tick(100, function () {
	echo 'hello swoole' . PHP_EOL;
});

