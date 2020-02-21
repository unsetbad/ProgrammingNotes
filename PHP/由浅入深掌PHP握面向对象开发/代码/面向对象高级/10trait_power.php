<?php

# trait控制权

trait t1{
    public function sleep(){
        echo 't1:sleep';
    }

    private function pee(){
    	echo 't1::pee';
    }
}

/*class Human{
    use t1{
        sleep as private;
        pee as public;
    }
    
    public function show(){
        $this->sleep();
        $this->pee();
    }
}

$h = new Human();

$h->show();

# 调用原始方法
# $h->sleep();			# 已经完成私有化，不能外部调用
$h->pee();*/

class Animal{
	use t1{
		sleep as private s;
		pee as public p;
	}
}

$a = new Animal();
# 	$a->s();			# 别名方法完成私有化，不能调用
$a->sleep();			# 别名修改不会将原有方法撤换：原有访问修饰限定符都不会受任何牵连
$a->p();