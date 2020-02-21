<?php

# 异常机制


# 计算的数据来源于用户
# $res = 4 / 0;


# 外部传入数据：不确定
$n1 = 10;
$n2 = 0;

/*# 要求$n1 / $n2
if($n2 == 0){
    # 被除数为0，不能操作：抛出异常
    throw new Exception('被除数不能为0！');
}

# 没有问题继续执行
$res = $n1 / $n2;
var_dump($res);*/

# 先需要告知系统使用异常处理：需要开发者明确如何产生异常
set_error_handler(function (){
    throw new Exception('错误！');
});

# 可能出现异常代码：使用try{}进行包裹捕捉
try{
    # 代码的执行具有未知性：但是代码没有语法错误
    if($n2 == 0) throw new Exception('被除数不能为0！');
    
    $res = $n1 / $n2;					# 产生错误就会产生一个Exception类对象，捕获错误

    #一旦异常出现：并且被捕获，那么try里面的代码就不在执行
   	echo $res;
}catch(Exception $e){
    # 捕获后的处理代码：如果try中没有问题，不会进入到catch内部
    # $e中保存了$res = $n1 / $n2;会出现的错误
    echo '代码运行错误！<br/>';
    echo '错误文件为：' . $e->getFile() . '<br/>';
    echo '错误行号为：' . $e->getLine() . '<br/>';
    echo '错误描述为：' . $e->getMessage();
    die();
}


# 异常只控制try里面的代码，不能控制try catch之外的代码
echo 'hello world';