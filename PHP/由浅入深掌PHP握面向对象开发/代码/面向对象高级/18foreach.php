<?php

# 对象遍历

# 定义类
class Man{
    public $name = 'LiLei';
    public $height = 178;
    public $weight = 140;
    protected $age = 30;
    private $money = 1000;

    public function getForeach(){
    	foreach($this as $k => $v){
    		echo $k . ' : ' . $v . '<br/>';
    	}
    }
}

# 实例化
$m = new Man();

# 遍历
foreach($m as $k => $v){
    # echo $k . ' : ' . $v . '<br/>';		# $k为属性名，$v为属性值
}

$m->getForeach();