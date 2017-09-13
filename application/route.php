<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
$v = request()->header('version');
if($v==null) $v = "v2";
//api post get put delete的演示
Route::resource('blogs','study/blog');
return [
    '__pattern__' => [
        'name' => '\w+',
    ],
    '[hello]'     => [
        ':id'   => ['index/hello', ['method' => 'get'], ['id' => '\d+']],
        ':name' => ['index/hello', ['method' => 'post']],
    ],

    //设置api的路由
    //api版本控制
    'api/:controller$'=>['api/'.$v.'.:controller/index',['method' => 'get']],
    'api/:controller/:function$'=>'api/'.$v.'.:controller/:function',

    //资源路由
    '__rest__'=>[
        //api
        'api/house'=>['api/'.$v.'.house',['only'=>['index','read','update','delete']]],
        'api/book'=>['api/'.$v.'.book',['only'=>['index','read','save','delete']]],
        'api/book_rent'=>['api/'.$v.'.book_rent',['only'=>['index','read','save']]],
    ]

];

