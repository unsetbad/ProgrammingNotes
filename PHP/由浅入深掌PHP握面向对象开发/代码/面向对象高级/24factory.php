<?php

# 工厂模式

# 产生一批类（具有相似性）
class Man{
    public function display(){
        echo '这是男人<br/>';
    }    
}

class Woman{
    public function display(){
        echo '这是女人<br/>';
    }
}

class Ladyboy{
    public function display(){
        echo '这是人妖<br/>';
    }
}

# 产生工厂类
class HumanFactory{
	# 提供产生对象的方法（普通方法）
	/*public function getInstance($classname){
		# 负责产生对象
		return new $classname();
	}*/

	# 静态工厂
	/*public static function getInstance($classname){
		# 安全控制
		if(!class_exists($classname)) return false;
		# 负责产生对象
		return new $classname();
	}*/

	# 静态工厂，简化用户操作
	public static function getInstance($flag = 'm'){
		# 根据不同的flag返回不同类对象
		switch($flag){
			case 'm':
				return new Man();
			case 'w':
				return new Woman();
			case 'l':
				return new Ladyboy();
			default:
				return null;
		}
	}
}

# 使用
/*$h = new HumanFactory();
$m = $h->getInstance('Ladyboy');*/

/*$m = HumanFactory::getInstance('Man');
$m->display();

var_dump(HumanFactory::getInstance('Human'));*/

# 高级工厂
$m = HumanFactory::getInstance('l');
var_dump($m);