<?php

// 31-swoole-coroutine-api.php

/**
 * 创建协程
 */
// $id1 = Swoole\Coroutine::create(function () {
//     Swoole\Coroutine::sleep(1);
//     echo 'hi，我是王美丽，我来自协程'. PHP_EOL;
// });
// echo '协程 ID ' . $id1 . PHP_EOL;

// // 短名称创建协程
// $id2 = go(function () {
//     echo 'hi， 我是郝帅，我也来自协程，我是来寻找王美丽' . PHP_EOL;
// });
// echo '协程 ID ' . $id2 . PHP_EOL;


/**
 * set() 设置参数
 */
// Swoole\Coroutine::set([
//     // 全局最大线程数
//     'max_coroutine' =>  10,
//     // 最大并发请求数
//     'max_concurrency' => 20,
// ]);
// Swoole\Coroutine::create(function () {
//     // 设置参数
//     print_r(Swoole\Coroutine::getOptions());
// });


/**
 * exists()
 */
// $coroutineId = Swoole\Coroutine::create(function () {
//     echo 'hi，来自外星的王美丽，欢迎你，这是地球' . PHP_EOL;
//     if (Swoole\Coroutine::exists(Co::getCid())) {
//         echo 'hi,王美丽，我是郝帅' . PHP_EOL;
//     }
// });



/**
 * getPcid() & getCid()
 */
// echo Swoole\Coroutine::getPcid() . PHP_EOL;
// // 协程容器
// \Co\run(function () {
//     // 不在协程环境中
//     echo Swoole\Coroutine::getPcid() . PHP_EOL;
//     go(function () {
//         // 返回值 1，在协程环境中
//         echo Swoole\Coroutine::getPcid() . PHP_EOL;
//         // 返回值 2，当前协程 ID
//         $cid =  Swoole\Coroutine::getCid();
//         echo '当前协程 ID' . $cid . PHP_EOL;
//         echo '当前协程父ID' . Swoole\Coroutine::getPcid($cid) . PHP_EOL;
//     });
// });


/**
 * yield()
 */
// $cid = Swoole\Coroutine::create(function () {
//     echo 'co 1 start' . PHP_EOL;
//     // 让出当前协程执行权
//     Swoole\Coroutine::yield();
//     echo 'co 1 end' . PHP_EOL;
// });

// Swoole\Coroutine::create(function () use ($cid) {
//     echo 'co 2 start' . PHP_EOL;
//     Swoole\Coroutine::sleep(1);
//     // 恢复让出执行权的协程执行
//     Swoole\Coroutine::resume($cid);
//     echo 'co 2 end' . PHP_EOL;
// });


/**
 * resume()
 */
// $id = Swoole\Coroutine::create(function () {
//     // 不知道是什么 ID，文档说明
//     $id = Co::getuid();
//     echo 'start co ' . $id . PHP_EOL;
//     Swoole\Coroutine::yield();
//     echo 'resume co ' . $id . ' @1' . PHP_EOL;
//     Swoole\Coroutine::yield();
//     echo 'resume co ' . $id . ' @2' . PHP_EOL;
// });

// echo 'start to resume ' . $id . '@1' . PHP_EOL;
// Co::resume($id);
// echo 'start to resume ' . $id . '@2' . PHP_EOL;
// Co::resume($id);
// echo 'end' . PHP_EOL;

/**
 * list()
 */

// Swoole\Coroutine::create(function () {
//     Swoole\Coroutine::create(function () {
//         $coros = Swoole\Coroutine::list();
//         foreach ($coros as $cid) {
//             print_r(Swoole\Coroutine::getBackTrace($cid));
//         }
//     });
// });


/**
 * getBackTrace() & getElapsed() & getStackUsage()
 */
// function test1() {
//     test2();
// }

// function test2() {
//     while (true) {
//         Swoole\Coroutine::sleep(5);
//         echo __FUNCTION__ . PHP_EOL;
//     }
// }

// \Co\run(function () {
//     $cid = Swoole\Coroutine::create(function () {
//         test1();
//     });
    
//     Swoole\Coroutine::create(function () use ($cid) {
//         echo 'backTrace ' . $cid . PHP_EOL;
//         print_r(Swoole\Coroutine::getBackTrace($cid));
//         Swoole\Coroutine::sleep(3);
//         echo '当前协程运行时间：' . Swoole\Coroutine::getElapsed($cid). PHP_EOL;
//         echo '当前协程占用内存：' . Swoole\Coroutine::getStackUsage($cid). PHP_EOL;
//     });
// });


/**
 * join()
 */
// Swoole\Coroutine\run(function () {
//     $status = Swoole\Coroutine::join([
//         Swoole\Coroutine\go(function () use (&$result) {
//             $result['baidu'] = strlen(file_get_contents('https://www.baidu.com/'));
//         }),
//         Swoole\Coroutine\go(function () use (&$result) {
//             $result['taobao'] = strlen(file_get_contents('https://www.taobao.com/'));
//         }),
//     ], 1);
//     var_dump($result, $status,swoole_strerror(swoole_last_error(), 9));
// });


/**
 * stats()
 */
// Swoole\Coroutine::create(function () {
//     Swoole\COroutine::create(function () {
//         print_r(Swoole\Coroutine::stats());
//     });
// });


/**
 * batch()
 */
// $startTIme = microtime(true);
// Swoole\Coroutine::set([
//     'hook_flags' => SWOOLE_HOOK_ALL
// ]);

// Swoole\Coroutine\run(function () {
//     $use = microtime(true);
//     $results = Swoole\Coroutine\batch([
//         'file_put_contents' => function () {
//             $content = file_get_contents('https://www.baidu.com');
//             return file_put_contents(__DIR__ . '/greeter.txt', $content);
//         },
//         'gethostbyname' => function () {
//             return gethostbyname('localhost');
//         },
//         'sleep' => function () {
//             // 返回NULL 因为超过了设置的超时时间0.1秒，
//             // 超时后会立即返回。但正在运行的协程会继续执行完毕，而不会中止。
//             sleep(1);
//             return true; 
//         },
//         'usleep' => function () {
//             usleep(1000);
//             return true;
//         },
//     ], 0.1);
//     $use = microtime(true) - $use;
//     echo '并发执行完成时间：' . $use . '秒' . PHP_EOL;
//     print_r($results);
// });
// $endTime =  microtime(true) - $startTIme;
// echo '花费时间：' . $endTime . '秒' . PHP_EOL;

/**
 * paraller
 */
// $startTIme = microtime(true);
// Swoole\Coroutine\run(function () {
//     $use = microtime(true);
//     $results = [];
//     Swoole\Coroutine\parallel(2, function () use (&$results) {
//         Swoole\Coroutine\System::sleep(0.2);
//         $results[] = Swoole\Coroutine\System::gethostbyname('localhost');
//     });
//     $use = microtime(true) - $use;
//     echo '并发执行花费时间：' . $use . '秒' . PHP_EOL;
//     print_r($results);
// });

// $endTime = microtime(true) - $startTIme;
// echo '花费时间 ' . $endTime . '秒' . PHP_EOL;


/**
 * map()
 */
function num(int $n): int {
    return array_product(range($n, 1));
}

Swoole\Coroutine\run(function () {
    $results = Swoole\Coroutine\map([4,5,6,7], 'num');
    print_r($results);
});




