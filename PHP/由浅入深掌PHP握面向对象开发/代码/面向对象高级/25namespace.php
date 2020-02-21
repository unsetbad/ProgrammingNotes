<?php

# 命名空间基础学习
# header('Content-type:text/html;charset=utf-8');

# 定义空间
namespace space1;		# 后续所有结构性内容理论上都都属于space1

function display(){
    echo __NAMESPACE__,'<br/>';
}
const PI = 3;

class Human{}


# 新建第二个空间：第一个空间到此结束，后序内容属于第二个空间space2
namespace space2;

function display(){
    echo __NAMESPACE__,'<br/>';
}
const PI = 3;

class Human{}

# 定义除以上三种空间元素以外的代码执行：系统不干涉，正常执行
$a = 100;
echo $a;

