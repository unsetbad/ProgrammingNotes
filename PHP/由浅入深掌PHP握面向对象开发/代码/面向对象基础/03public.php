<?php


# 访问修饰限定符

class Saler{
    # 属性
    public $count = 100;
    # 方法
    public function getCount(){
        echo __METHOD__;		# 魔术常量，显示当前方法名（包含类名）
    }
    
    function setCount(){
        echo __METHOD__;
    }
}

# 实例化对象
$s = new Saler();

# 访问（类外）
/*echo $s->count;
$s->getCount();
$s->setCount();*/


class Buyer{
    # 属性
    protected $money = 10;
    private $account = '6226000000000001';
    
    # 方法
    protected function getMoney(){
        echo __METHOD__;
    }
    
    private function getAccount(){
        echo __METHOD__;
    }
}

$b = new Buyer();

# echo $b->money;
# echo $b->account;


# $b->getMoney();