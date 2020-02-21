<?php

# 生成器的实际应用

$conn = @mysqli_connect('localhost','root','root','db_2','3306') or die('数据库连接失败！');
mysqli_set_charset($conn,'utf8') or die('字符集设置失败！');

function query($conn,$sql){
    $res = mysqli_query($conn,$sql);
    
    # $list = [];
    while($row = mysqli_fetch_assoc($res)){
        yield  $row;		# 这样就不需要数组保存大数据了，如果数据量够大会产生很大的消耗
    }

    # return $list;
}
echo memory_get_usage(),'<br>';	
# 遍历输出
$list = query($conn,'select * from t_40');
echo '<table border=1>';
foreach($list as $v){
    echo <<<EOD
    	<tr>
    		<td>{$v['id']}</td><td>{$v['name']}</td><td>{$v['age']}</td><td>{$v['gender']}</td><td>{$v['class_name']}</td>
    	</tr>
EOD;
}
echo '</table>';
echo memory_get_usage(),'<br>';	