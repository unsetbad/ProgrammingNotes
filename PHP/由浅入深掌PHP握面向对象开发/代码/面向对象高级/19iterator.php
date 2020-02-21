<?php

# Iterator迭代器接口（索引数组处理）


class Person implements Iterator{
    # 属性列表（索引数组
    private $properties = ['name','age','gender','height','weight'];
    # 下标属性
    private $key = 0;
    
    # 实现5个方法
    public function current(){
    	echo __METHOD__,'<br>';
        # 取出当前数组元素值
        return $this->properties[$this->key];
    }
    
    public function key(){
    	echo __METHOD__,'<br>';
        # 返回当前下标
        return $this->key;
    }
    
    public function next(){
    	echo __METHOD__,'<br>';
        # 不需要返回值：当前下标 + 1
        $this->key++;
    }
    
    public function rewind(){
    	echo __METHOD__,'<br>';
        # 不需要返回值：重置数组下标
        $this->key = 0;
    }
    
    public function valid(){
    	echo __METHOD__,'<br>';
        # 需要返回布尔值：判定下标对应的元素是否存在即可
        return isset($this->properties[$this->key]);
    }
}

# 实例化
$p = new Person();

foreach($p as $k => $v){
	echo $k . ' : ' . $v . '<br>';
}