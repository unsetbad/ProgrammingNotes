<?php

# PDO封装


# 封装初始化
function pdo_init(){
	# 实例化PDO对象
	$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2;charset=utf8','root','root');

	# 连接未必成功：需要判定
	if(!$pdo){
		exit('数据库连接失败！');
	}

	# 成功
	return $pdo;
}

# 封装执行：函数封装需要传入PDO对象（也可以在函数内部实例化对象）
function pdo_exec($pdo,$sql){
    # 调用PDO对象的方法执行写SQL
    $res = $pdo->exec($sql);
    # 错误判定
	if(false === $res){
        # 取出错误细信息：实际开发是将错误信息记录到系统日志中，返回false
        echo 'SQL错误：<br/>';
        echo '错误代码为：' . $pdo->errorCode() . '<br/>';
        echo '错误原因为：' . $pdo->errorInfo()[2];			
        exit;
	}
    
    # 返回执行结果：受影响的行数（直接是受影响的行数）
    return $res;
}

# 封装执行：读操作（SQL执行和语法错误检查）
function pdo_query($pdo,$sql){
    # 调用PDO对象的方法执行读SQL
    $stmt = $pdo->query($sql);
    # 错误判定
	if(false === $stmt){
        # 取出错误细信息
        echo 'SQL错误：<br/>';
        echo '错误代码为：' . $pdo->errorCode() . '<br/>';
        echo '错误原因为：' . $pdo->errorInfo()[2];			
        exit;
	}
    
    # 返回执行结果：PDOStatement类对象
    return $stmt;
}

# 数据解析
function pdo_get($stmt,$only = true,$fetch_style = PDO::FETCH_ASSOC){
    # $stmt是PDO查询得到的对象，$only代表默认只获取一条记录
    
    # 安全判定
    if(!$stmt instanceof PDOStatement) return false;
    
    # PDOStatement类中提供了两种方法分别去获取一条和多条记录
    # 判定条件
    if($only){
        # 获取一条记录PDOStatement::fetch()：返回一维数组
        return $stmt->fetch($fetch_style);
    }else{
        # 获取多条记录PDOStatement::fetchAll()：返回二维数组，一个维度代表一条记录
        return $stmt->fetchAll($fetch_style);
    }
}
