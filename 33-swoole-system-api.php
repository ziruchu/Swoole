<?php

/**
 * statvfs
 */
// Swoole\Coroutine\run(function () {
//     print_r(Swoole\Coroutine\System::statvfs('/usr/local/src'));
// });

/**
 * fwrite
 */
// $fp = fopen('test.txt', 'a+');
// Swoole\Coroutine\run(function () use ($fp) {
//     $result = Swoole\Coroutine\System::fwrite($fp, '我叫王美丽');
//     var_dump($result);
// });
// fclose($fp);

/**
 * fread
 */
// $fp = fopen('test.txt', 'r');
// Swoole\Coroutine\run(function () use ($fp) {
//     $result = Swoole\Coroutine\System::fread($fp);
//     // 读取的长度为字节
//     // $result = Swoole\Coroutine\System::fread($fp, 3);
//     var_dump($result);
// });
// fclose($fp);

/**
 * fgets
 */
// $fp = fopen('test.txt', 'r');
// Swoole\Coroutine\run(function () use ($fp) {
//     while (!feof($fp)) {
//         echo Swoole\Coroutine\System::fgets($fp) . PHP_EOL;
//     } 
// });
// fclose($fp);


/**
 * readFile
 */
// $file = 'test.txt';
// Swoole\Coroutine\run(function () use ($file) {
//     $result = Swoole\Coroutine\System::readFile($file);
//     print_r($result);
//     $content = Swoole\Coroutine\System::readFile('test.txt');
//     print_r($content);
// });

/**
 * writeFile
 */
// Swoole\Coroutine\run(function () {
//     $content = Swoole\Coroutine\System::writeFile('baidu.txt', file_get_contents('https://www.baidu.com'));
//     var_dump($content);
// });

/**
 * exec
 */
// Swoole\Coroutine\run(function() {
//     $ret = Swoole\Coroutine\System::exec('ls');
//     print_r($ret);
// });


/**
 * gethostbyname
 */
// Swoole\Coroutine\run(function() {
//     $ret = Swoole\Coroutine\System::gethostbyname('www.baidu.com');
//     var_dump($ret);
// });


/**
 * getaddrinfo
 */
// Swoole\Coroutine\run(function() {
    // $ret = Swoole\Coroutine\System::getaddrinfo('www.baidu.com');
    // var_dump($ret);
// });


/**
 * waitPid
 */
// $process = new Swoole\Process(function () {
//     echo 'Hello Swoole' . PHP_EOL;
// });
// $process->start();

// Swoole\Coroutine\run(function () use ($process) {
//     $status = Swoole\Coroutine\System::waitPid($process->pid);
//     print_r($status);
// });

