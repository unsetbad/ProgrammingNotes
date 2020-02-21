<?php

# 内部对象$this


class Saler{
  	# 属性
  	public $count = 100;
  	protected $discount = 0.8;
  	private $money = 100;
    
    public function getAll(){
        # echo $count,$discount,$money;	# 全部错误：提示未定义的“变量”
         
        # 引入对象
        # global $s;
        # echo $s->count,$s->discount,$s->money;		#正确输出
        # 
        
        # 内置变量（$this）
        # var_dump($this);
        echo $this->count,$this->discount,$this->money;		#正确输出
    }					
}

$s = new Saler();
$s->getAll();