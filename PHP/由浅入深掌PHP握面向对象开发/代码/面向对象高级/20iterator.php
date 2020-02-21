<?php

# Iterator迭代器


class Person implements Iterator{
    private $info = [
        'name' 	=> '',
        'age'  	=> 0,
        'gender'=> '',
        'height'=> 0,
        'weight'=> 0
    ];
    
    # 实现5个方法
    public function current(){
        # 返回当前元素当前的值：当前元素是一个数组，那就可以使用数组函数current来处理
        return current($this->info);
    }
    
    public function key(){
        return key($this->info);
    }
    
    public function next(){
        # 当前方法不需要返回值：说明外部调用的时候不会用到返回值
        next($this->info);
    }
    
    public function rewind(){
        # 也不需要返回值
        reset($this->info);
    }
    
    public function valid(){
        # 需要返回布尔值：而且没有直接的函数能够判定：可以通过key取出当前指针元素的下标，然后再通过这个下标去判定元素是否存在（因为false不能成为数组元素下标，系统会自动转换成0）
        return isset($this->info[key($this->info)]);
    }
}

# 实例化
$p = new Person();

foreach($p as $k => $v){
	echo $k . ' : ' . $v . '<br>';
}