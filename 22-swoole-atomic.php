<?php

// 22-swoole-atomic.php

// 创建一个原子计数对象实例
$atomic = new Swoole\Atomic();

// 增加计数
$atomic->add(10);

// 获取当前计数的值
echo $atomic->get() . PHP_EOL;

$atomic->set(9);
echo $atomic->get() . PHP_EOL;

$atomic->cmpset(9, 100);
echo $atomic->get() . PHP_EOL;