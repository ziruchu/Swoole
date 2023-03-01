<?php

// Swoole\Coroutine\run(function () {
//     // 实例化通道
//     $channel = new Swoole\Coroutine\Channel(1);

//     // 这个协程负责向通道中写入数据
//     Swoole\Coroutine::create(function() use ($channel) {
//         for ($i = 0; $i < 10; $i++) {
//             Swoole\Coroutine::sleep(1);
//             // 通道中写入数据
//             $channel->push([
//                 'rand' => rand(1000, 9999),
//                 'index' => $i,
//             ]);
//             echo $i . PHP_EOL;
//         }
//     });

    
    
//     // 这个协程负责从通道中读取数据
//     Swoole\Coroutine::create(function () use ($channel) {
//         while (true) {
//             $data = $channel->pop(2);
//             if ($data) {
          
//                 print_r($data);
//             } else {
//                 assert($channel->errCode === SWOOLE_CHANNEL_TIMEOUT);
//                 break;
//             }
//         }
//     });
// });

