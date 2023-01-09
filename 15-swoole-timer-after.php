<?php

Swoole\Timer::after(1000, function () {
	echo '1 秒后执行' . PHP_EOL;
});

