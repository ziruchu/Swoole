<?php

// 21-swoole-table.php

// 1、实例化 table 并设置最大行数
$table = new Swoole\Table(1024);

// 2、指定表格字段并设置表格类型与长度
$table->column('id', $table::TYPE_INT);
$table->column('name', Swoole\Table::TYPE_STRING, 64);
$table->column('salary', $table::TYPE_FLOAT);

// 3、创建表格
$table->create();


