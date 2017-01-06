<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/1/3
 * Time: 17:30
 */
namespace app\test\controller;
use think\Controller;

class Index extends Controller
{
    protected $beforeActionList = [
        'first',
        'second' => ['except'=>'hello'],
        'three' => ['only'=>'hello,data'],
    ];
    protected function first()
    {
        echo 'first<br/>';
    }
    protected function second()
    {
        echo 'second<br/>';
    }
    protected function three()
    {
        echo 'three<br/>';
    }
    public function hello()
    {
        return 'hello';
    }
    public function data()
    {
        return 'data';
    }

    public function test() {
        echo "我是测试！";
    }
}
