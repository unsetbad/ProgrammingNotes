<?php

# PDO封装函数实现读操作

# 引入函数文件
include '33pdo_func.php';

# 连接认证
$pdo = pdo_init();

# 准备SQL
$sql = "select * from t_40";

# 执行SQL
$stmt = pdo_query($pdo,$sql);

# 解析结果
$row = pdo_get($stmt,false);

var_dump($row);