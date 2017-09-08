<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/8
 * Time: 15:23
 */
namespace app\study\model;
use think\Model;
class Profile extends Model{
    //设定默认的字段格式
    protected $type = [
        'birthday'=>'timestamp:Y-m-d',
    ];

    public function user() {
        //profile(档案)与用户(user)表关联
        return $this->belongsTo('user');
    }
}