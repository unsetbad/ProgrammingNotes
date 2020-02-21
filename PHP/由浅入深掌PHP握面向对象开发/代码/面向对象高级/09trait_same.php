<?php

# trait同名成员问题

trait t1{
    public $name = true;
    public $old = 0;

    public function eat(){
        echo 't1,eat';
    }
}

trait t2{
    public $name = true;
    public $age = 1;

    public function eat(){
        echo 't2,eat';
    }
}								
# 此时上述没问题，没被引入类，所以不冲突

class Human{
    # use t1,t2;					# 致命错误：age冲突（name同名但同值没问题）
    # 
    # trait同名元素：替换使用其中一个
    /*use t2,t1{
    	t2::eat insteadof t1;
    }*/

    # trait同名元素：别名保留两个方法
    use t1,t2{
    	t1::eat insteadof t2;		# 具体使用t1::eat方法
    	t2::eat as show;			# t2::eat临时改名为show
    }
}

/*$h = new Human();
$h->eat();
$h->show();*/


class Animal{
	use t1{
		t1::eat as show;			# trait别名不会改变原来方法的存在，而相当于复制了一个别名方法
	}

}

$a = new Animal();
$a->eat();
$a->show();