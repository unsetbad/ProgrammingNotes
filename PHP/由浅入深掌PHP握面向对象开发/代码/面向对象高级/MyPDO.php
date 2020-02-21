<?php 

# 基于PDO的二次封装


# 命名空间
namespace core;

# 引入系统类：基于PDO实现，需要引入三个类
use \PDO,\PDOStatement,\PDOException;

class MyPDO{
	# 属性
	private $pdo;			# 报错PDO类对象
	private $fetch_model;	# 查询数据的模式：默认为关联数组
	public $error;			# 记录的错误信息

	# 构造方法
	# 默认采用PDO异常和获取关联数组设定
	public function __construct($database_info = array(),$drivers = array()){
	    # 如果要考虑细致，可以看看是否存在
	    $type = $database_info['type'] ?? 'mysql';		# 默认mysql数据库
	    $host = $database_info['host'] ?? 'localhost';
	    $port = $database_info['port'] ?? '3306';
	    $user = $database_info['user'] ?? 'root';
	    $pass = $database_info['pass'] ?? 'root';
	    $dbname = $database_info['dbname'] ?? 'db_2';
	    $charset = $database_info['charset'] ?? 'utf8';
	    
	    # fetchmode不能在初始化的时候实现，需要在得到PDOStatement类对象好设置
	    $this->fetch_mode = $dirvers[PDO::ATTR_DEFAULT_FETCH_MODE] ?? PDO::FETCH_ASSOC;
	    
	    # 控制属性（增加异常处理模式）
	    if(!isset($dirvers[PDO::ATTR_ERRMODE]))
	        $dirvers[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
	    
	    # 连接认证
	    try{
	        # 增加错误抑制符防止意外
	        $this->pdo = @new PDO($type . ':host=' . $host . ';port=' . $port . ';dbname=' . $dbname . ';charset=' . $charset,$user,$pass,$drivers);
	    }catch(PDOException $e){
	        # 属性记录错误
	        /*$this->error['file'] = $e->getFile();
	        $this->error['line'] = $e->getLine();
	        $this->error['error']= $e->getMessage();
	    
	        # 返回false，让外部处理
	        return false;*/

	        # 调用异常处理方法实现异常处理
	        $this->my_exception($e);
	    }   
	}

	# 异常处理方法
	private function my_exception(PDOException $e){
	    $this->error['file'] = $e->getFile();
	    $this->error['line'] = $e->getLine();
	    $this->error['error']= $e->getMessage();
	    return false;
	}

	# 写操作
	public function my_exec($sql){
	    try{
	        # 调用执行：成功返回，错误捕捉
	        return $this->pdo->exec($sql);
	    }catch(PDOException $e){
	        return $this->my_exception($e);
	    }
	}

	# 获取自增长ID
	public function my_last_insert_id(){
		# 捕捉异常
		try{
			$id = $this->pdo->lastInsertId();

			# 主动抛出异常
			if(!$id) throw new PDOException('自增长Id不存在！');

			# 成功
			return $id;
		}catch(PDOException $e){

			return $this->my_exception($e);
		}
	    
	}

	# 读方法：按条件进行单行或者多行数据返回
	public function my_query($sql,$only = true){
	    try{
	        $stmt = $this->pdo->query($sql);
	        # 设置查询模式
	        $stmt->setFetchMode($this->fetch_mode);
	           
	    }catch(PDOException $e){
	        return $this->my_exception($e);
	    }
	    
	    # 数据解析
	    if($only)
	        return $stmt->fetch();
	    else
	        return $stmt->fetchAll();
	}
}
