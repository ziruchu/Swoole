<?php

Swoole\Timer::tick(3000, function ($timer) {
	echo memory_get_usage() . PHP_EOL;

});

