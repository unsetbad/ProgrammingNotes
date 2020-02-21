<?php

# 接口架构使用


# 顶级接口（初级规范）
interface DB{
    public function insert(string $sql);
    public function update(string $sql);
    public function delete(string $sql);
    public function select(string $sql);
}


# 子接口
interface AutoDB extends DB{
    public function autoInsert(array $data,int $id);
    public function autoUpdate(array $data,int $id);
    public function autoSelect(array $condition);
}

# 简单实现接口：实现初级接口
class SQL implements DB{
    public function __construct(){
        # 初始化数据库连接认证、字符集、数据库选择
    }
    
    public function insert(string $sql){
        # 实现新增
    }
    public function update(string $sql){
        # 实现更新
    }
    public function delete(string $sql){
        # 实现删除
    }
    public function select(string $sql){
        # 实现查询
    }
}

# 类的继承外加额外接口的实现：丰富操作内容
class Model extends SQL implements AutoDB{
    # 初始化操作已经由SQL完成，只需要实现AutoDB的自动操作
    
    public function autoInsert(array $data,int $id){
        # 实现自动构造新增SQL指令，调用父类的insert方法实现
    }
    public function autoUpdate(array $data,int $id){
        # 实现自动构造更新SQL指令，调用父类的update方法实现
    }
    public function autoSelect(array $condition){
        # 实现自动构造查询SQL指令，调用父类的select方法实现
    }
}