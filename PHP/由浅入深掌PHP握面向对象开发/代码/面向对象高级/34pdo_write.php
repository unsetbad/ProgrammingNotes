<?php

# PDO封装成函数的写操作

# 引入文件：封装的PDO文件
include '33pdo_func.php';			# 假设所有封装都放到了pdo.php中

# 初始化
$pdo = pdo_init();

# 组织要执行的SQL
# $sql = 'delete from t_29 where id = 1';
$sql = "insert into t_29 values(null,'username','password')";

$res = pdo_exec($pdo,$sql);

# 结果使用
echo '本次操作共实现数据库操作：' . $res . '条记录！';

# 新增获取自增长ID
echo '当前新增操作的自增长id为：' . $pdo->lastInsertId();