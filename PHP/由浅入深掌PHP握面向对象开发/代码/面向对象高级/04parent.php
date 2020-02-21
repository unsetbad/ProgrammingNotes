<?php

# parent关键字

class DB{
    protected $link;

    public static $level = 1;
    
    public function __construct(){
        $this->link = mysqli_connect('localhost','root','root','db_2','3306') or die('数据库连接失败！');
        
        echo __METHOD__;
    }
}

class Table extends DB{
	public static $level = 2;
    # 重写父类方法
    public function __construct(){
        # 让父类构造方法先执行
        parent::__construct();
        
        # 执行其他
        echo __METHOD__;

        # 访问父类的静态成员（被重写）
        echo parent::$level;
    }
}

# 实例化
$t = new Table();