<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 11:38
 */
// [ 应用入口文件 ]

// 定义应用目录
define('APP_PATH', __DIR__ . '/application/');

// 加载框架引导文件
require __DIR__ . '/thinkphp/start.php';
// 读取自动生成定义文件
$build = include APP_PATH.'build.php';
// 运行自动生成
\think\Build::run($build);