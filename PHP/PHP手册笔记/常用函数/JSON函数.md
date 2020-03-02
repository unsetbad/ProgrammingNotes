#### json_decode

对JSON格式的字符串进行解码

**说明**

```php
json_decode ( string $json [, bool $assoc = FALSE [, int $depth = 512 [, int $options = 0 ]]] ) : mixed
```

​	接受一个 JSON 编码的字符串并且把它转换为 PHP 变量

**参数**

`json`

​	待解码的 `json` [string](https://www.php.net/manual/zh/language.types.string.php) 格式的字符串。

​	这个函数仅能处理 UTF-8 编码的数据。

> **Note**:
>
> PHP implements a superset of JSON as specified in the original [» RFC 7159](http://www.faqs.org/rfcs/rfc7159).

`assoc`

​	当该参数为 **`TRUE`** 时，将返回 [array](https://www.php.net/manual/zh/language.types.array.php) 而非 [object](https://www.php.net/manual/zh/language.types.object.php) 。

`depth`

​	指定递归深度。

`options`

​	由 **`JSON_BIGINT_AS_STRING`**, **`JSON_INVALID_UTF8_IGNORE`**, **`JSON_INVALID_UTF8_SUBSTITUTE`**, 	**`JSON_OBJECT_AS_ARRAY`**, **`JSON_THROW_ON_ERROR`** 组成的掩码。 这些常量的行为在[JSON constants](https://www.php.net/manual/zh/json.constants.php)页面有进一步描述。

**返回值**

​	通过恰当的 PHP 类型返回在 `json` 中编码的数据。值*true*, *false* 和 *null* 会相应地返回 **`TRUE`**, **`FALSE`** 和 **`NULL`**。 如果 `json` 无法被解码， 或者编码数据深度超过了递归限制的话，将会返回**`NULL`** 。

------



#### json_encode

对变量进行JSON编码

**说明**

```php
json_encode ( mixed $value [, int $options = 0 [, int $depth = 512 ]] ) : string
```

​	返回字符串，包含了 `value` 值 JSON 形式的表示。

​	编码受传入的 `options` 参数影响，此外浮点值的编码依赖于 [serialize_precision](https://www.php.net/manual/zh/ini.core.php#ini.serialize-precision)。

**参数**

`value`

​	待编码的 `value` ，除了[resource](https://www.php.net/manual/zh/language.types.resource.php) 类型之外，可以为任何数据类型。

​	所有字符串数据的编码必须是 UTF-8。

> **Note**:
>
> PHP implements a superset of JSON as specified in the original [» RFC 7159](http://www.faqs.org/rfcs/rfc7159).

`options`

​	由以下常量组成的二进制掩码： **`JSON_HEX_QUOT`**, **`JSON_HEX_TAG`**, **`JSON_HEX_AMP`**, **`JSON_HEX_APOS`**, **`JSON_NUMERIC_CHECK`**, **`JSON_PRETTY_PRINT`**, **`JSON_UNESCAPED_SLASHES`**, **`JSON_FORCE_OBJECT`**, **`JSON_PRESERVE_ZERO_FRACTION`**, **`JSON_UNESCAPED_UNICODE`**, **`JSON_PARTIAL_OUTPUT_ON_ERROR`**。

​	 关于 JSON 常量详情参考[JSON 常量](https://www.php.net/manual/zh/json.constants.php)页面。

`depth`

​	设置最大深度。 必须大于0。

**返回值**

​	成功则返回 JSON 编码的 [string](https://www.php.net/manual/zh/language.types.string.php) 或者在失败时返回 **`FALSE`** 。

------



#### json_last_error_msg [ ¶](https://www.php.net/manual/zh/function.json-last-error-msg.php)

------



#### json_last_error

返回最后发生的错误

**说明**

```php
json_last_error ( void ) : int
```

​	如果有，返回 JSON 编码解码时最后发生的错误。

**参数**

​	此函数没有参数

**返回值**

​	返回一个整型（integer），这个值会是以下的常量（[参见手册](https://www.php.net/manual/zh/function.json-last-error.php#refsect1-function.json-last-error-returnvalues)）

**范例**

**Example #1 `json_last_error()` 例子**

```php
<?php
// 一个有效的 json 字符串
$json[] = '{"Organization": "PHP Documentation Team"}';

// 一个无效的 json 字符串会导致一个语法错误，在这个例子里我们使用 ' 代替了 " 作为引号
$json[] = "{'Organization': 'PHP Documentation Team'}";


foreach ($json as $string) {
    echo 'Decoding: ' . $string;
    json_decode($string);

    switch (json_last_error()) {
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_STATE_MISMATCH:
            echo ' - Underflow or the modes mismatch';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_UTF8:
            echo ' - Malformed UTF-8 characters, possibly incorrectly encoded';
        break;
        default:
            echo ' - Unknown error';
        break;
    }

    echo PHP_EOL;
}
?>
```

以上例程会输出：

```
Decoding: {"Organization": "PHP Documentation Team"} - No errors
Decoding: {'Organization': 'PHP Documentation Team'} - Syntax error, malformed JSON
```

**Example #2 [json_encode()](https://www.php.net/manual/zh/function.json-encode.php) 的 `json_last_error()`**

```php
<?php
// 无效的 UTF8 序列
$text = "\xB1\x31";

$json  = json_encode($text);
$error = json_last_error();

var_dump($json, $error === JSON_ERROR_UTF8);
?>
```

以上例程会输出：

```
string(4) "null"
bool(true)
```