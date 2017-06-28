<?php
namespace app\study\controller;
use think\Controller;
use think\Loader;
use think\Validate;
class Index extends Controller
{
    public function index()
    {
//        echo "<pre>";
//        print_r($_REQUEST);
        return $this->fetch();
//        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    public function add() {
//        echo "<pre>";
//        print_r($_REQUEST);
        //判断是否为POST提交，助手函数：request()->isPost()
//        if(request()->isPost()) {
//            echo "是POST提交！";
//        }

    //独立验证
//        $validate = new Validate([
//            'userName'  => 'require|max:25',
//        ]);
    //规则
//        $rule = [
//            'userName'  => 'require|max:1',
//        ];
    //信息
//        $msg = [
//            'userName.require' => '名称必须',
//            'userName.max'     => '名称最多不能超过1个字符',
//        ];
//        $data = [
//            'name'  => 'thinkphp',
//            'email' => 'thinkphp@qq.com'
//        ];
    //使用
//        $validate = new Validate($rule,$msg);
//        $result   = $validate->check($_POST['userName']);
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";

        $validate = Loader::validate('User');
        if(!$validate->check($_POST['userName'])){
            dump($validate->getError());
        }


    }

    //上传图片(单文件)
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');//没有验证的
        //加上验证
        $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            echo "<hr>";
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();//不知道怎么来的
            echo "<hr>";
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }
}
