<?php
//配置文件
return [
    //分页配置
    'paginate'               => [
        'type'      => 'bootstrap',
        'var_page'  => 'page',
        'list_rows' => 15
    ],

    //自定义路径（csg）
    'view_replace_str'  =>  [
        '__PUBLIC__'=>'../../../public',
        '__ROOT__'=>'/',
    ],

//    //配置session
//    'session' => [
//        'prefix' => 'think',
//        'type' => '',
//        'auto_start' => true,
//    ],
];