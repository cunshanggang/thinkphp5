<?php
namespace app\study\controller;
//use test1\Test1;
//use test1\Test1;
use think\Controller;
use think\Loader;
use think\Validate;
use app\study\model\User;
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
//        print_r($_POST['userName']);
        $data = input();//输出的是数组
//        $data = input('post.');//输出的是数组
//        $data = input('post.userName');//输出是字符串
        echo "<pre>";
        var_dump($data);
        $validate = Loader::validate('User');
        if(!$validate->check($data)){
            echo "<pre>";
            print_r($validate->getError());
//            dump($validate->getError());
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
    public function impClass() {
//        echo '789798';
        //引入类文件的三种方法
        //1.使用 vendor()
//        vendor("test1.test1",'.class.php');
        //2.直接实例化,在头部使用命名空间：use \test1\Test1;
//        $test = new Test1();
//        $test->show();
//        print_r($r);
//        echo EXTEND_PATH;
//        var_dump(Loader::import('test1.Test1',EXTEND_PATH));
//        Loader::import('test1.Test1',EXTEND_PATH);
//        $test = new \Test1();
        //检查文件是否被引入
        //------- start --------
//        $included_files = get_included_files();
//        foreach ($included_files as $filename) {
//            echo "$filename\n";
//        }
        //------- end ---------
//        $hello = new \first\second\Foo();
//        $hello->hello();
        Loader::import('first.second.Foo');
        $foo = new \Foo();
//        echo "<pre>";
//        print_r($foo);
        echo "54545";
        echo "<hr>";
        $test1 = new Test1();
        var_dump(class_exists("Foo"));
//        $foo->hello();
//        $test = new \Test1();
//        $test->show();

    }
    //导入数据
    function impUser(){
//        $file = request()->file('import');
//        echo "<pre>";
//        print_r($file);
//        echo "</pre>";exit;
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'excel');

//        echo "<pre>";
//        print_r($info);
//        echo "</pre>";//exit;
//        if($info){
//            // 成功上传后 获取上传信息
//            // 输出 jpg
//            echo $info->getExtension();
//            echo "<hr>";
//            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getSaveName();//不知道怎么来的
//            echo "<hr>";
//            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
//        }else{
//            // 上传失败获取错误信息
//            echo $file->getError();
//        }
        //exit;
//        if (!empty($_FILES)) {
//            $config=array(
//                'allowExts'=>array('xlsx','xls'),
//                'savePath'=>'./Public/upload/',
//                'saveRule'=>'time',
//            );
//            $upload = new UploadFile($config);
//            if (!$upload->upload()) {
//                $this->error($upload->getErrorMsg());
//            } else {
//                $info = $upload->getUploadFileInfo();
//
//            }

//            $file_name = $info->getSaveName();
//        echo $file_name;exit;
//        echo EXTEND_PATH;exit;
//        echo dirname(__FILE__);
//        echo "<hr>";
//        require_once ('../../'.'PHPExcel'.'/'.'PHPExcel'.'/'.'IOFactory.php');
//        echo "<pre>";
//        print_r($_FILES);
//        $filePath = $_FILES['import']['tmp_name'];
//        $PHPExcel = new PHPExcel();
        include 'D:\www\htdocs\thinkphp5\extend\test1\Test1.php';
        $test = new Test1();
        echo $test->show();exit;

        /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
            }
        }

        $PHPExcel = $PHPReader->load($filePath);
        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);

        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();
        $data = array();
        /**从第二行开始输出，因为excel表中第一行为列名*/
        for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){//循环读取每个单元格的内容。注意行从1开始，列从A开始
            for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                $addr = $colIndex.$rowIndex;
//        echo $addr;
//        echo "<hr>";
                $cell = $currentSheet->getCell($addr)->getValue();
//        echo "<pre>";
//        print_r($cell);
//        echo "</pre>";//exit;
                if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                    $cell = $cell->__toString();
                }
                $data[$rowIndex][$colIndex] = $cell;
            }
        }
echo "<pre>";
        print_r($data);
        echo "</pre>";exit;
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); //取得总行数
        echo $highestRow;
            $highestColumn = $sheet->getHighestColumn(); //取得总列数
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
//            $this->success('导入成功！');
//        }else
//        {
//            $this->error("请选择上传的文件");
//        }
    }

    public function TestModel() {
        //需要实例化的
        /*
//        $user = new User;
//        $user->name = '林书豪';
//        $user->age = '28';
//        $user->sex = '1';
//
//        if($user->save()){
//            return "插入成功";
//        }else{
//            return $user->getError();
//        }
        */

        //不需实例化
        $user['name'] = '易建联';
        $user['age'] = '32';
        $user['sex'] = '0';

        if($result=User::create($user)) {
            return $result->name.'插入成功';
            //带提示的
//            return $this->success("{$result->name}成功",url('Index/index'));
        }else{
            return '插入错误';
        }

    }

    //批量添加
    public function addList() {
//        $csg = new User();
//        $result = $csg->testCsg();
//        echo $result;

        $list = [
            ['name'=>'北田小一郎','age'=>'36','sex'=>'0'],
            ['name'=>'丰田章男','age'=>'46','sex'=>'0'],
            ['name'=>'手冢治虫','age'=>'76','sex'=>'0']
        ];

        $user = new User();
        if($user->saveAll($list)) {
            return "批量插入成功!";
        }else{
//            echo "批量插入失败!";
            //显示错误信息
            return $user->getError();
        }
    }

    //查询数据
    public function read() {
        //获取一条信息
        /*
        $result = User::get(1);
        //结果是一个对象
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";

//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //根据字段来查询
//        $result = User::getByName('林书豪');
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //根据用户自定义的字段来查询，多条件传入数组
//        $result = User::get(['name'=>'丰田章男','age'=>'406']);
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //更复杂的查询则可以使用查询构建器来完成
//        $result = User::where('name','手冢治虫')->find();
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //获取所有的列表
//        $result = User::all(['sex'=>0,'name'=>'孙杨']);//带条件
//        foreach($result as $k=>$v) {
//            echo '姓名'.$v['name'].'<br />';
//            echo '年龄'.$v['age'].'<br />';
//            echo '性别'.$v['sex'].'<br />';
//            echo "<hr>";
//        }
        */

        /*
        //使用数据库的查询构建器完成更多的条件查询
        $result = User::where('id','>','3')->select();
//        foreach($result as $k=>$v) {
//            echo '姓名'.$v['name'].'<br />';
//            echo '年龄'.$v['age'].'<br />';
//            echo '性别'.$v['sex'].'<br />';
//            echo "<hr>";
//        }
        //或者
//        foreach($result as $user) {
//            echo '姓名'.$user->name.'<br />';
//            echo '年龄'.$user->age.'<br />';
//            echo '性别'.$user->sex.'<br />';
//            echo "<hr>";
//        }
        */
    }

    //更新数据
    public function update91($id) {
        $result = User::get($id);
        echo "<pre>";
        print_r($result);
        echo "</pre>";
//        $result['name'] = '林依蓝';
//        $result['age'] = '24';
//        $result['sex'] = '0';

//        $result->name = '林依蓝';
//        $result->age = '24';
//        $result->sex = 1;
//
//        if(false !== $result->save()) {
//            return '更新成功';
//        }else{
//            return $result->getError();
//        }


    }
}
