<?php

# root/model目录下：User.php：操作用户数据表
namespace model;
# 加载DB类
include_once 'D:/server/web/root/core/DB.php';

class User{
    public function getAllUsers(){
        # 假设数据库连接、数据库、表都已经存在
        $sql = "select * from user";
        # 调用更高级的操作类实现SQL执行并返回结果：DB属于Core空间，使用完全限定名称访问
        $db = new \Core\DB();
        return $db->getAll($sql);
    }
}