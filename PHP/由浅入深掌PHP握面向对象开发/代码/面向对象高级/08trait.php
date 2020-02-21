<?php

# trait基本使用

# 定义trait
/*trait Eat{
    public $time;
    protected $how;					
    private $info;
    
    public function showTime(){
        echo $this->time;
    }
    protected function showHow(){	
        echo $this->how;
    }
    
    abstract public function abstractMethod();
    
    # const PI = 3.14;				# 错误：trait中不能有常量
}*/

# new Eat();						# 错误：不允许实例化trait


trait Eat{
    public function show(){
        echo 'eat';
    }
}

trait S{
	public function sleep(){
		echo 'sleep';
	}
}


# 类中使用
class Human{
	# 引入trait
	use Eat;
}

class Animal{
	# 引入trait
	use Eat,S;

}

# 实例化类
/*$h = new Human();
$h->show();*/

$a = new Animal();
$a->show();
$a->sleep();