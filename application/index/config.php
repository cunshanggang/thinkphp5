<?php
//配置文件
return [
    'log'                    => [
        // 日志记录方式，内置 file socket 支持扩展
        'type'  => 'File',
        // 日志保存目录
//        'path'  => LOG_PATH,
        // 日志记录级别
        'level' => ['error'],
    ],
];