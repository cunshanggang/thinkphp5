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
    protected $name="user";
    //含有其他的前缀或者其他特定的表
//    protected $table="";

    //测试
    public function testCsg() {
        return '你好，村上岗';
    }

    //读取器，即对数据库某一个字段进行数据处理
    protected function getTimeAttr($time){
        return date('Y-m-d',$time);
    }

    //修改器，即对数据库插入某一个字段前进行处理
    protected function setTimeAttr($time){
        return strtotime($time);
    }

    //类型转换
//    protected $type=[
//        'time'=>'timestamp:y-m-d'
//    ];

    //name查询
    protected function scopeName($query) {
        $query->where('name','林书北');
    }

    //age查询
    public function scopeAge($query){
        $query->where('age',25);
    }

    //定义关联的方法
    public function profile() {
        return $this->hasOne("Profile");
}

    //定义关联的方法
    public function books() {
        return $this->hasMany("Book");
    }

    //定义多对多
    public function roles() {
        return $this->belongsToMany('Role','tp_access');
    }
}