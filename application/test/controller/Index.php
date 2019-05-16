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
//    protected $beforeActionList = [
//        'first',
//        'second' => ['except'=>'hello'],
//        'three' => ['only'=>'hello,data'],
//    ];
//    protected function first()
//    {
//        echo 'first<br/>';
//    }
//    protected function second()
//    {
//        echo 'second<br/>';
//    }
//    protected function three()
//    {
//        echo 'three<br/>';
//    }
    public function hello()
    {
        return 'hello';
    }
    public function data()
    {
        return 'data';
    }

    public function test() {
//        echo "我是测试！";
        $arr = array("name" => "姚明","sex" => "男","职业" => "中国篮协主席","家乡" => "上海");
//        return $arr;
        // 默认输出类型2.
//        return "65465456Hello World!";

//        return ['name'=>'thinkphp','status'=>1];
//        return json_encode($arr,JSON_UNESCAPED_UNICODE);

    }
}
