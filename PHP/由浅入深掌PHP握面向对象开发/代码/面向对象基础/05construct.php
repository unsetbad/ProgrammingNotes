<?php

# 构造方法（魔术方法）


class Saler{
	# 属性
  	public $count;				
  	private $money;

    # 构造方法
    public function __construct($count,$money){
        echo __CLASS__;

        # 初始化
        $this->count = $count;
        $this->money = $money;
    }
}

# 实例化
$s1 = new Saler(100,100);
$s2 = new Saler(1,1);

// var_dump($s1,$s2);


$s2->__construct(0,0);

var_dump($s1,$s2);