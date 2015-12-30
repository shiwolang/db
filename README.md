# 轻量级数据库操作组件

* 支持事务嵌套
* PDO支持
* JSON支持
* 实例对象支持
* 轻量级
* 可以轻易和其他框架兼容
* 多数据库支持


##使用方式

###通过composer安装
```
$ composer require shiwolang/db
```
###初始化连接
```php
DB::init([
    'database_type' => 'mysql',
    'database_name' => 'dbname',
    'server'        => 'localhost',
    'username'      => 'username',
    'password'      => 'yourpass',
    'charset'       => 'utf8'
]);
```
###获取数据库连接
---------------------------------------
```php
DB::connection();
```
###添加数据(单表)
---------------------------------------
```php
$lastInsertId = DB::connection()->insert("content", [
    "title"       => "title1",
    "content"     => "content1",
    "time"        =>  time()
]);
```
###删除数据(单表)
---------------------------------------
```php
$lastInsertId = DB::connection()->delete("content", "id = :id", [":id" => 1]);
```
###修改数据(单表)
---------------------------------------
```php
$lastInsertId = DB::connection()->update("content", [
    "title"       => "title1",
    "content"     => "content1",
    "time"        =>  time()
],"id = :id", [":id" => 1]);
```
###查询数据
---------------------------------------
**请注意在使用limit的时候的数值务必为整数int型！！**
```php
DB::connection()->query("SELECT * FROM content where title = 'title1' LIMIT 10")->all();

DB::connection()->query("SELECT * FROM content WHERE title = :title LIMIT :limit", [
    ":title"     => "title1",
    ":limit"     =>  10
])->all();

DB::connection()->query("SELECT * FROM content WHERE id = ? LIMIT ?", ["title1", 10])->all();

```