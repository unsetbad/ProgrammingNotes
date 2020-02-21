<?php

# PDO的基本操作


# 1、实例化
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2;charset=utf8','root','root');
var_dump($pdo);


# 写操作执行
$sql = 'delete from t_28limit 1';
$res = $pdo->exec($sql);
# var_dump($res);

# 读操作执行
$sql = "select * fromt_40";
$stmt = $pdo->query($sql);
var_dump($stmt);

# var_dump($pdo->errorInfo());

# 错误判定：exec方法执行结果成功也存在返回0的情况，错误会返回false，所以要判定是否是SQL错误，需要判定结果为false
if(false === $stmt){
    # 取出错误细信息
    echo 'SQL错误：<br/>';
    echo '错误代码为：' . $pdo->errorCode() . '<br/>';
    echo '错误原因为：' . $pdo->errorInfo()[2];			
    # errorInfo返回数组，2下标代表错误具体信息
    exit;		
    # 错误不需要继续执行代码
}