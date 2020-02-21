<?php

# 数据库操作类

class Sql{
	# 定义属性：保存数据库初始化的信息
	private $host;
	private $port;
	private $user;
	private $pass;
	private $dbname;
	private $charset;

	# 实现数据的初始化：灵活性（允许外部修改）和通用性（给定默认值）
	public function __construct(array $arr = []){
		# 完成初始化
		$this->host = $arr['host']  ??  'localhost';
		$this->port = $arr['port']  ??  '3306';
		$this->user = $arr['user']  ??  'root';
		$this->pass = $arr['pass']  ??  'root';
		$this->dbname = $arr['dbname']  ??  'db_2';
		$this->charset = $arr['charset']  ??  'utf8';

		# 实现初始化数据库操作
		if(!$this->connect()) return;	# 为了中断执行
		$this->charset();
	}

	# 连接认证
	private $link;
	public $errno;
	public $error;

	private function connect(){
		$this->link = @mysqli_connect($this->host,$this->user,$this->pass,$this->dbname,$this->port);

		# 加工结果
		if(!$this->link){
			# 记录错误信息返回false
			$this->errno = mysqli_connect_errno();
			$this->error = iconv('gbk','utf-8',mysqli_connect_error());
			return false;
		}

		# 正确返回
		return true;
	}


	# 字符集设置
	private function charset(){
		# 利用mysqli实现字符集设置
		$res = @mysqli_set_charset($this->link,$this->charset);

		# 判定结果
		if(!$res){
			$this->errno = mysqli_errno($this->link);
			$this->error = mysqli_error($this->link);
			return false;
		}

		# 正确操作
		return true;
	}

	# SQL执行检查
	private function check($sql){
		# mysqli_query执行
		$res = mysqli_query($this->link,$sql);

		# 判定错误
		if(!$res){
			$this->errno = mysqli_errno($this->link);
			$this->error = mysqli_error($this->link);
			return false;
		}

		# 成功返回结果
		return $res;
	}


	# 写操作
	public function write($sql){
		# 调用SQL检查方法检查和执行
		$res = $this->check($sql);

		# 根据结果判定：如果$res为true，说明执行成功，应该获取受影响的行数，如果为false就返回false
		return $res ? mysqli_affected_rows($this->link) : false;
	}

	# 获取自增长Id方法
	public function insert_id(){
		# 可以增加判定
		return mysqli_insert_id($this->link);
	}

	# 读取数据：一条记录
	public $columns = 0;
	public function read_one($sql){
		# 执行检查
		$res = $this->check($sql);

		# 判定结果
		if($res){
			# 有结果
			$this->columns = @mysqli_field_count($this->link);
			return mysqli_fetch_assoc($res);
		}

		# 没有结果
		return false;
	}

	# 读取多条记录
	public $rows;

	public function read_all($sql){
		# 执行检查
		$res = $this->check($sql);

		# 错误检查
		if(!$res) return false;

		# 结果正确
		$this->rows = @mysqli_num_rows($res);
		$this->columns = @mysqli_field_count($this->link);

		# 循环取出所有记录：形成二维数组
		$list = [];
		while($row = mysqli_fetch_assoc($res)) $list[] = $row;

		# 返回结果
		return $list;
	}
}
