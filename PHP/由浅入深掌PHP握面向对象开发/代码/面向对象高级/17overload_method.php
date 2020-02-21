<?php

# PHP重载：方法重载

class Man{
	private function show(){
        echo __METHOD__,'<br/>';
    }
    # 普通方法重载
    public function __call($name,$args){
        echo $name,__METHOD__,'<br/>';
        #var_dump($args);

        # 允许访问列表
        $allow = array('show');
        
        # 判定是否在列表中
        if(in_array($name,$allow)) return $this->$name(implode($args,','));
        # 其他情况
        return false;
    }

    private static function staticShow(){
        echo __METHOD__,'<br/>';
    }
    # 静态方法重载
    public static function __callStatic($name,$args){
        # echo $name,__METHOD__,'<br/>';
        return false;
    }
}

Man::staticShow();

$m = new Man();
$m->show();
$m->show(1,2,3,4);