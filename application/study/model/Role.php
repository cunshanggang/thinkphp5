<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/11
 * Time: 16:37
 */
namespace app\study\model;
use think\Model;

class Role extends Model{
    //定义多对多关系
    public function user() {
        return $this->belongsToMany('User','tp_access');
    }
}