<?php

# PDO 实现预处理

# 实例化
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2;charset=utf8','root','root') or die('数据库连接失败！');


# 准备预处理指令：发送给服务器
$pre_sql = "select * from t_40";				# 无数据预处理指令
$pre_sql = "select * from t_40 where id = ?";	# 有参数预处理指令
$pre_sql = "select * from t_40 whereid =:id";	# PDO特定预处理参数指令（: + 字符串），更明确

# 发送预处理指令
$stmt = $pdo->prepare($pre_sql);
if(!$stmt) die('预处理指令执行失败！');

# 绑定预处理参数：bindValue
$stmt->bindValue(':id',1);			# 直接绑定数值
$id = 2;
$stmt->bindValue(':id',$id);		# 绑定变量数据

# 绑定预处理参数：bindParam
# $stmt->bindParam(':id',1);		# 错误：bindParam第二个参数要求必须为变量（引用传递）
$id = 4;
$stmt->bindParam(':id',$id);		# 必须是传递变量

# 执行预处理
$res = $stmt->execute();
# 如果结果为true：说明预处理执行了：但是结果无法取出
# 如果是查询预处理：需要继续进行PDOStatement::fetch()才能查出结果
$row = $stmt->fetch(PDO::FETCH_ASSOC);


# 如果错误：取出信息
if($row === false){
	# 取出错误细信息：实际开发是将错误信息记录到系统日志中，返回false
    echo 'SQL错误：<br/>';
    echo '错误代码为：' . $stmt->errorCode() . '<br/>';
    echo '错误原因为：' . $stmt->errorInfo()[2];			
    exit;
}