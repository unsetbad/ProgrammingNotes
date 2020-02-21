<?php

# 有限继承
# 父类
class Human{
    const CALL = '人';
    public $name = 'human';
    protected $age = '100';
    private $money = '100';

    public function __construct($money){
        $this->money = $money;
    }
    
    public function showName(){
        echo $this->name;
    }
    
    protected function showAge(){
        echo $this->age;
    }
    
    private function showMoney(){
        echo $this->money;
    }

    protected function getMoney(){
    	echo $this->money;
    }
}

# 子类继承
class Man extends Human{

	public function getProtected(){
		# 访问继承的受保护内容
		echo $this->age;
		$this->showAge();			# 说明受保护的内容，确实可以被继承
	}


	public function getPrivate(){
		# echo $this->money;			# 被继承，但是无法在子类中访问
		# $this->showMoney();			# 不能访问（没有继承）
		
		# 父类私有属性除非父类提供能继承的方法访问
		$this->getMoney();
	}
}

# 实例化（子类）
$m = new Man(5);
# var_dump($m);		# 证明父类属性确实被子类继承


$m->showName();
$m->getProtected();

$m->getPrivate();