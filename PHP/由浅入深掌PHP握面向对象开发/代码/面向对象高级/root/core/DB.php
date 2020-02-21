<?php

# 核心文件

# root/core目录下：DB.php
namespace core;

class DB{
    private $link;
    public function __construct(){
        # 数据库初始化
    }
    
    # 简单效果：查询全部数据
    public function getAll($sql){
        
        return '数据查询结果<br>';
    }
}