<?php

# PDO 预处理传参区别

# 实例化
$pdo = new PDO('mysql:host=localhost;port=3306;dbname=db_2;charset=utf8','root','root') or die('数据库连接失败！');

$pre_sql = "select * from t_40 where id = ?";	# PDO特定预处理参数指令（: + 字符串），更明确

# 发送预处理指令
/*$stmt = $pdo->prepare($pre_sql);
if(!$stmt) die('预处理指令执行失败！');*/

# 执行预处理：绑定参数，可以使用execute方法直接传（数组传）
# 索引方式：不需要给下标，直接数字索引即可
# 关联方式：需要给定下标
/*$res = $stmt->execute(array(12));
var_dump($stmt->fetch(PDO::FETCH_ASSOC));*/


# 测试bindValue
$stmt = $pdo->prepare('select * from t_40 where id = :id');

$id = 1;

$stmt->bindValue(':id',$id);

for(;$id < 10;$id++){
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
    echo '<br>';
}

echo '<hr>';
# 测试bindParam
$id = 1;

$stmt->bindParam(':id',$id);

for(;$id < 10;$id++){
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    var_dump($row);
    echo '<br>';
}