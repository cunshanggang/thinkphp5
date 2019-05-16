<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12
 * Time: 17:31
 */
namespace app\study\api\model;
use think\Model;
class User extends Model{
    // 定义一对一关联
    public function profile()
    {
        return $this->hasOne('Profile');
    }
}