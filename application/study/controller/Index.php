<?php
namespace app\study\controller;
use think\Controller;
use think\Loader;
use Think\Upload;
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

    //引入类库
    function impClass() {
        v
    }
    //导入数据
    function impUser(){
        if (!empty($_FILES)) {
            import("@.ORG.UploadFile");
            $config=array(
                'allowExts'=>array('xlsx','xls'),
                'savePath'=>'./Public/upload/',
                'saveRule'=>'time',
            );
            $upload = new UploadFile($config);
            if (!$upload->upload()) {
                $this->error($upload->getErrorMsg());
            } else {
                $info = $upload->getUploadFileInfo();

            }

            vendor("PHPExcel.PHPExcel");
            $file_name=$info[0]['savepath'].$info[0]['savename'];
            $objReader = PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); // 取得总行数
            $highestColumn = $sheet->getHighestColumn(); // 取得总列数
            for($i=3;$i<=$highestRow;$i++)
            {
                $data['account']= $data['truename'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $sex = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                // $data['res_id']    = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                $data['class'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                $data['year'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                $data['city']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                $data['company']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                $data['zhicheng']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                $data['zhiwu']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
                $data['jibie']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
                $data['honor']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
                $data['tel']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
                $data['qq']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
                $data['email']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
                $data['remark']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
                $data['sex']=$sex=='男'?1:0;
                $data['res_id'] =1;

                $data['last_login_time']=0;
                $data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
                $data['login_count']=0;
                $data['join']=0;
                $data['avatar']='';
                $data['password']=md5('123456');
                M('Member')->add($data);

            }
            $this->success('导入成功！');
        }else
        {
            $this->error("请选择上传的文件");
        }
    }
}
