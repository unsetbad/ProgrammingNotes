<?php

# PDO错误处理模式


# 静默模式：默认模式
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2','root','root');
# $pdo->exec('insert into t_40 values()');		# 错误：但是不会报错


# 警告模式：需要主动告知PDO才行
# 设定处理模式为警告模式
/*$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$pdo->exec('insert into t_40 values()');	# 直接报错*/


# 异常模式
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

try{
	# PDO中的所有的错误发生，都会产生一个PDOException类对象
    $pdo->exec('insert into t_40 values()');	# 错误：被捕捉到
}catch(PDOException $e){
    # 进入到异常处理
    echo '来了';
}