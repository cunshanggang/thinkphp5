<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/8
 * Time: 13:59
 */
namespace app\study\model;
use think\Model;

class Book extends Model{
    protected $name="book";

    //定义出版的时间
    protected $type = [
        'publish_time'=>'timestamp:Y-m-d',
    ];
    //开启自动写入时间戳
    protected $autoWriteTimestamp = true;
    //定义自动完成的属性
    protected $insert = ['status'=>1];
    //定义关联的方法
    public function user() {
        return $this->belongsTo('User');
    }
}