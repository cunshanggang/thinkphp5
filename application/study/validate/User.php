<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/6/23
 * Time: 14:45
 */
namespace app\study\validate;
use think\Validate;
class User extends Validate
{
    protected $rule =   [
        'userName'  => 'require|min:2',
    ];

    protected $message  =   [
        'userName.require' => '名称必须',
        'userName.min'     => '名称最多不能超过25个字符',
    ];

}