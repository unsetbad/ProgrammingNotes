<?php

# 生成器Generator


# 普通方式进行数组遍历
function getArr(){
    for($i = 0;$i < 10000;$i++){
        $arr[] = $i;
    }
    
    return $arr;
}

/*echo memory_get_usage(),'<br>';		# 取出当前PHP所占用的内存

$arr = getArr();
foreach($arr as $v){
    # echo $v . ' ';
} 
echo memory_get_usage(),'<br>';*/

function getGer(){
    for($i = 0;$i < 10000;$i++){
        yield $i;
    }
}

echo memory_get_usage(),'<br>';		# 取出当前PHP所占用的内存

$g = getGer();
# var_dump($g);
foreach($g as $v){
    echo $v . ' ';
} 
echo memory_get_usage(),'<br>';