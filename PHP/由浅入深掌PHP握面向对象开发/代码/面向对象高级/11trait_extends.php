<?php

# trait在继承中的优先权

trait Eat{
    public function eat(){		# 优先级高于父类优先级
    	# 访问父类被重写方法
    	parent::eat();
        echo 'Eat::eat';
    }
}

class Human{
    public function eat(){
        echo 'Human::eat';
    }
}

# 子类继承父类同时使用trait
class Man extends Human{
    use Eat;

    # 子类同名方法（重写）
    public function eat(){		# 类本身的优先级最高
    	parent::eat();
    	echo 'Man::eat';
    }
}

$m = new Man();
$m->eat();							