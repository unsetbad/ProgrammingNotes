<?php

# root/controller目录下：User.php
namespace controller;

class User{
    public function display(){
        # 调用模型目录下的user类实现数据库操作：使用完全限定名称访问
        include_once 'D:/server/web/root/model/User.php';

        $u = new \Model\User();
        $users = $u->getAllUsers();
        var_dump($users);
    }
}