<?php

# PHP属性重载


class Man{
	public $name = 'Name';
	# 属性：私有
	private $age = 10;

	# 读取重载
    public function __get($key){
        echo $key,__METHOD__,'<br/>';

        # 定义一个允许访问列表：假设有很多私有属性
        $allow = array('age');
        # 判定是否在列表内：在就允许访问，不在就返回NULL或者false
        if(in_array($key,$allow)){
            return $this->$key;				# 可变属性：$key是外部访问的目标，最终为$this->age
        }
        
        # 不允许访问
        return false;
    }

    # 写重载
    public function __set($key,$value){
        echo $key . ' : ' . $value . '<br/>';
    }

    # 查是否存在重载
    public function __isset($key){
        echo $key,__METHOD__,'<br/>';

        # 给出内部判定结果
        return isset($this->$key);
    }

    # 删除属性重载
    public function __unset($key){
        echo $key,__METHOD__,'<br/>';
    }

    # 对象重载
    public function __toString(){
        # 返回一个指定字符串（一般是当类有属性保存某些信息时，输出某个属性）
        return __METHOD__;	
    }
}


$m = new Man();
# var_dump($m->age);
# var_dump($m->gender);
# $m->name;

# 写入数据
# $m->age++;			# 系统不理解为设置，而是读取：因此会走__get()
/*$m->age = 12;
$m->gender = 'Male';
var_dump($m);*/

# 判定属性
# var_dump(isset($m->age));


# 删除属性
# unset($m->age);

# 直接输出对象
echo $m;