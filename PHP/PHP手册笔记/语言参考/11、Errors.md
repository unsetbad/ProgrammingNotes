## 基础[¶](https://www.php.net/manual/zh/language.errors.basics.php#language.errors.basics)

PHP针对许多内部错误情况报告错误。这些可以用来表示许多不同的情况，并且可以根据需要显示和/或记录。

PHP生成的每个错误都包含一个类型。提供[了这些类型](https://www.php.net/manual/zh/errorfunc.constants.php)的 [列表](https://www.php.net/manual/zh/errorfunc.constants.php)，以及它们的行为以及如何引起它们的简短描述。

### 处理错误用PHP [¶](https://www.php.net/manual/zh/language.errors.basics.php#language.errors.basics.handling)

如果未设置错误处理程序，则PHP将处理根据其配置发生的任何错误。报告哪些错误和忽略哪些错误由[`error_reporting`](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) php.ini指令控制 ，或者在运行时通过调用 [error_reporting（）进行控制](https://www.php.net/manual/zh/function.error-reporting.php)。强烈建议设置配置指令，但是，由于在开始执行脚本之前可能会发生一些错误。

在开发环境中，您应该始终设置 [`error_reporting`](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) 为**`E_ALL`**，因为您需要了解并解决PHP引发的问题。在生产中，您可能希望将其设置为不太冗长的级别，例如 `E_ALL & ~E_NOTICE & ~E_STRICT & ~E_DEPRECATED`，但在许多情况下**`E_ALL`**也是适当的，因为它可以提供对潜在问题的早期警告。

PHP如何处理这些错误取决于另外两个php.ini指令。 [`display_errors`](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.display-errors) 控制错误是否显示为脚本输出的一部分。在生产环境中，应始终禁用此功能，因为它可能包含机密信息（例如数据库密码），但在开发中通常很有用，因为它可以确保立即报告问题。

除了显示错误外，[`log_errors`](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.log-errors) 启用指令后，PHP还可记录错误 。这会将所有错误记录到由定义的文件或syslog中 [`error_log`](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-log)。这在生产环境中非常有用，因为您可以记录发生的错误，然后根据这些错误生成报告。

### 用户错误处理程序[¶](https://www.php.net/manual/zh/language.errors.basics.php#language.errors.basics.user)

如果PHP的默认错误处理不充分，您还可以通过使用[set_error_handler（）](https://www.php.net/manual/zh/function.set-error-handler.php)安装它来使用自己的自定义错误处理程序来处理许多类型的错误 。尽管某些错误类型无法通过这种方式处理，但是可以按照脚本认为合适的方式处理那些可以处理的错误：例如，可以将其用于向用户显示自定义错误页面，然后比通过日志，例如发送电子邮件。



## PHP7错误处理

PHP 7 改变了大多数错误的报告方式。不同于传统（PHP 5）的错误报告机制，现在大多数错误被作为 **Error** 异常抛出。

这种 **Error** 异常可以像 [Exception](https://www.php.net/manual/zh/class.exception.php) 异常一样被第一个匹配的 *try* / *catch* 块所捕获。如果没有匹配的 [*catch*](https://www.php.net/manual/zh/language.exceptions.php#language.exceptions.catch) 块，则调用异常处理函数（事先通过 [set_exception_handler()](https://www.php.net/manual/zh/function.set-exception-handler.php) 注册）进行处理。 如果尚未注册异常处理函数，则按照传统方式处理：被报告为一个致命错误（Fatal Error）。

**Error** 类并非继承自 [Exception](https://www.php.net/manual/zh/class.exception.php) 类，所以不能用 `catch (Exception $e) { ... }` 来捕获 **Error**。你可以用 `catch (Error $e) { ... }`，或者通过注册异常处理函数（ [set_exception_handler()](https://www.php.net/manual/zh/function.set-exception-handler.php)）来捕获 **Error**。



## 如何正确的使用错误异常处理

### php程序的错误发生一般归属下面3个领域

```
 1、语法错误
   语法错误最常见，并且也容易修复，如：代码中遗漏一个分号，这类错误会阻止脚本的执行。
 2、运行时的错误：
    这种错误一般不会阻止php脚本的执行，但会阻止当前要做的事情，输出一条错误，但php脚本
    会继续执行。
 3、逻辑错误：
    这种错误最麻烦，既不阻止脚本的执行，也不输出错误消息。
```

### php的错误报错级别

```
   级别常量            错误值               错误报告描述
   E_ERROR             1              致命的运行时错误（阻止脚本执行）
   E_WARNING           2              运行时警告(非致命性错误)
   E_PARSE             4              从语法中解析错误
   E_NOTICE            8              运行时注意消息(可能是或可能不是一个问题)
   E_CORE_ERROR        16             PHP启动时初始化过程中的致命错误
   E_CORE_WARNING      32             PHP启动时初始化过程中的警告(非致命性错)
   E_COMPILE_ERROR     64             编译时致命性错
   E_COMPILE_WARNING   128            编译时警告(非致命性错)
   E_USER_ERROR        256            用户自定义的致命错误
   E_USER_WARNING      512            用户自定义的警告(非致命性错误)
   E_USER_NOTICE       1024           用户自定义的提醒(经常是bug)
   E_STRICT            2048           编码标准化警告(建议如何修改以向前兼容)
   E_ALL               6143           所有的错误、警告和注意信息
```

### 调整错误报告级别

```
1、display_errors：是否开启php输出错误报告的级别。
 值为：On (默认的输出错误报告)、Off (屏蔽所有的错误信息)
 -- 在php脚本中可以调用ini_set( ) 函数，动态设置php.ini配置文件。
 -- 如：ini_set("display_errors", "On"); 显示所有的错误信息
 
2、error_reporting: 设置不同的错误级别报告
    error_reporting = E_ALL & ~E_NOTICE
      -- 可以抛出任何非注意的错误
    error_reporting = E_ERROR | E_PARSE | E_CORE_ERROR
      -- 只考虑致命的运行时错误，新解析错误和核心错误。
    error_reporting = E_ALL & ~(E_USER_ERROR | E_USER_WARNING | E_USER_NOTICE)
      -- 报告用户导致的错误之外的所有错误。
    在php脚本可以通过error_reporting() 函数动态设置错误报告级别。
    如：error_reporting(E_ALL);
```

### error_reporting()

error_reporting — 设置应该报告何种 PHP 错误

### 说明

error_reporting ([ int `$level` ] ) : int

**error_reporting()** 函数能够在运行时设置 [error_reporting](https://www.php.net/manual/zh/errorfunc.configuration.php#ini.error-reporting) 指令。 PHP 有诸多错误级别，使用该函数可以设置在脚本运行时的级别。 

如果没有设置可选参数 `level`， **error_reporting()** 仅会返回当前的错误报告级别。

**Example #1 \**error_reporting()\** 范例**

```php
<?php

// 关闭所有PHP错误报告
error_reporting(0);

// Report simple running errors
error_reporting(E_ERROR | E_WARNING | E_PARSE);

// 报告 E_NOTICE也挺好 (报告未初始化的变量
// 或者捕获变量名的错误拼写)
error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);

// 除了 E_NOTICE，报告其他所有错误
error_reporting(E_ALL ^ E_NOTICE);

// 报告所有 PHP 错误 (参见 changelog)
error_reporting(E_ALL);

// 报告所有 PHP 错误
error_reporting(-1);

// 和 error_reporting(E_ALL); 一样
ini_set('error_reporting', E_ALL);

?>
```

