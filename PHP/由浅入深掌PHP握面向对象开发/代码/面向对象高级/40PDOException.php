<?php

# 使用PDO异常模式处理

# 1.初始化PDO时设定错误模式
$drivers = array(
	# 可以设置多种驱动（属性设置）
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
);

# 使用先天异常捕捉实例化的错误
try{
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2','root','root',$drivers);
}catch(PDOException $e){
	echo '实例化PDO错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    # 连接错误：还没有设置好字符集：系统返回的信息字符集为GBK
    echo '错误描述为：' . iconv('gbk','utf-8',$e->getMessage());
    die();
}


# 执行SQL
try{

    $pdo->exec('set names utf8');		# 错误
}catch(PDOException $e){
	# 开发阶段可以用这种方式：生产环境中就应该写入到错误日志文件
    echo 'SQL执行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}

# 主动捕捉异常：判定数据执行时，发现逻辑问题无法继续
try{
    $pdo->exec('select * from t_40');
    $id = $pdo->lastInsertID();
    if(!$id) throw new PDOException('没有拿到自增长ID：插入失败');
}catch(PDOException $e){
    echo 'SQL执行失败！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}