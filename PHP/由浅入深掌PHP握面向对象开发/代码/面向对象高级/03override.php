<?php

# 重写override

# 父类
class Human{
    public $name = 'Human';
    protected $age = 19;
    private $money = 20;
    public function show(){
        echo __CLASS__,'<br/>';
    }

    private function getMoney(){}
}

# 子类继承
class Man extends Human{
    # 定义同名属性
    public $name = 'Man';
    protected $age = 1;
    private $money = 2;
    # 定义父类同名方法
    public function show(){
        echo __CLASS__,' hello world<br/>';
    }

    # 私有方法不存在重写概念
    private function getMoney($m){
    	$this->money = $m;

    	echo $m;
    }
}

# 实例化对象
$m = new Man();
# var_dump($m);			# 子类同名属性覆盖父类同名属性
# 
$m->show();				# 子类会调用自己的方法