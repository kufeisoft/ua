# 解析用户UA信息 V1.0

*By [酷飞软件](https://kufeisoft.com)*

## Installation

Use [Composer](https://getcomposer.org/) to install the library.

``` bash
$ composer require kufeisoft/ua 
```
## Basic usage

* 获取用户操作系统信息
``` php
$serverName = \kufeisoft\Ua::getOS($ua = "");
print_r($serverName);
// 返回的值是一个数组
// 返回结果： 
// ['server' => '操作系统', 'version' => '版本号'] 
```
## Demo
```php
$ua = 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/100.0.4896.127 Safari/537.36', ;
$serverInfo = \kufeisoft\Ua::getOS($ua);
print_r($serverInfo);
// 输出结果
// ['server' => 'Mac OS X', 'version' => '10.15.7']
```

## Advanced usage

通过用户传入的useragent串来返回用户操作系统类型及版本号

## Built-in validation reader

想好了再写

## License

This bundle is under the MIT license. For the full copyright and license
information please view the LICENSE file that was distributed with this source code.