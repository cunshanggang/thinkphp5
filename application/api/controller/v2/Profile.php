<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12
 * Time: 17:44
 */
namespace app\study\api\model;
use think\Model;
class Profile extends Model
{
    protected $type = [
        'birthday' => 'timestamp:Y-m-d',
    ];
}