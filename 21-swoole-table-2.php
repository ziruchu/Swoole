<?php

// 21-swoole-table-2.php

$table = new Swoole\Table(1024);

$table->column('id', $table::TYPE_INT);
$table->column('name', Swoole\Table::TYPE_STRING, 64);
$table->column('salary', $table::TYPE_FLOAT);
$table->column('age', Swoole\Table::TYPE_INT, 1);

$table->create();

/**
 * set() 方法： 添加数据
 *
 * @param string $key 数据的 key
 * @param array  $value 数据
 *
 * @return bool
 */
$table->set('user_1', ['id'=>1, 'name'=>'Lucy','age'=>18,'salary'=>1829.12]);
$table->set('user_2', ['id'=>2, 'name'=>'Jack','age'=>19,'salary'=>2302.39]);


/**
 * get() 方法：获取一行数据
 *
 * @param string $key 数据的 key【必须为字符串类型】
 * @param string $field 当指定了 $field 时仅返回该字段的值，而不是整个记录
 */
$lucy     = $table->get('user_1');
$lucyName = $table->get('user_1', 'name');
print_r($lucy);
echo $lucyName . PHP_EOL;

/**
 * exists() 方法：检查 table 中是否存在某一个 key
 *
 * @return bool
 */
$exists = $table->exists('user_1');
var_dump($exists);

/**
 * count() 方法：返回 table 中存在的条目数
 *
 * @return int 
 */
$count = $table->count();
echo $count . PHP_EOL;


/**
 * stats() 获取 Swoole\Table 状态。
 *
 * @return array
 */
$stats = $table->stats();

/**
 * incr() 方法：原子自增操作
 *
 * @param string $key 数据的 key【如果 $key 对应的行不存在，默认列的值为 0
 * @param string $column 指定列名【仅支持浮点型和整型字段】
 * @param string $incrby 增量 【如果列为 int，$incrby 必须为 int 型，如果列为 float 型，$incrby 必须为 float 类型】
 */
$table->incr('user_1', 'age');
print_r($table->get('user_1'));

$table->decr('user_1', 'age');

