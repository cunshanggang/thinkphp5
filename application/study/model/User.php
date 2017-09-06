<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/6
 * Time: 13:47
 */
namespace app\study\model;
use think\Model;
class User extends Model {
    //不含前缀名表
    protected $name="student";
    //含有其他的前缀或者其他特定的表
//    protected $table="";

    //测试
    public function testCsg() {
        return '你好，村上岗';
    }
}