<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 16:33
 */
namespace app\study\model;
use think\Model;
class Blog extends Model
{
    protected $autoWriteTimestamp = true;
    protected $insert = [
        'status' => 1,
    ];
    protected $field = [
        'id' => 'int',
        'create_time' => 'int',
        'update_time' => 'int',
        'name', 'title', 'content',
    ];
}