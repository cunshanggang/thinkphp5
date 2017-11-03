<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/29
 * Time: 15:35
 */
namespace app\study\controller;
use think\Controller;
use think\Loader;
use PHPExcel_IOFactory;
use PHPExcel;
use think\Db;
use Csv\Csv;
use app\study\model\User;
class Tools extends Controller {
    public function __construct() {
        //如果没有这一句就会报错；
        parent::__construct();
        //集体引入类库
        vendor("PHPExcel.PHPExcel.PHPExcel");
        //5后面如果没有.的话也会报错
        vendor("PHPExcel.PHPExcel.Writer.Excel5.");
        //7后面如果没有.的话也会报错
        vendor("PHPExcel.PHPExcel.Writer.Excel2007.");
        vendor("PHPExcel.PHPExcel.IOFactory");
    }

    public function excel() {
//        vendor("PHPExcel.PHPExcel.PHPExcel");
//        vendor("PHPExcel.PHPExcel.Writer.Excel5.");
//        vendor("PHPExcel.PHPExcel.Writer.Excel2007.");
//        vendor("PHPExcel.PHPExcel.IOFactory");

        if(request()->isPost()) {
            $excel = request()->file('excel')->getInfo();
            $objPHPExcel = \PHPExcel_IOFactory::load($excel['tmp_name']);//读取上传的文件
            $arrExcel = $objPHPExcel->getSheet(0)->toArray();//获取其中的数据
            echo "<pre>";
            print_r($arrExcel);
            echo "</pre>";
            die;
        }
        return $this->fetch();
    }

    public function export() {
        $path = dirname(__FILE__);
//        vendor("PHPExcel.PHPExcel.PHPExcel");
//        vendor("PHPExcel.PHPExcel.Writer.Excel5.");
//        vendor("PHPExcel.PHPExcel.Writer.Excel2007.");
//        vendor("PHPExcel.PHPExcel.IOFactory");
        $data = Db::table('csg_student')->select();
        $objPHPExcel = new \PHPExcel();
        $objWriter = new \PHPExcel_Writer_Excel5($objPHPExcel);
        $objWriter = new \PHPExcel_Writer_Excel2007($objPHPExcel);
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', '序号')
            ->setCellValue('B1', '用户名')
            ->setCellValue('C1', '年龄')
            ->setCellValue('D1', '性别')
        ;

//        $i=2;  //定义一个i变量，目的是在循环输出数据是控制行数
        $count = count($data);  //计算有多少条数据
        for ($i = 2; $i <= $count+1; $i++) {
            $objPHPExcel->getActiveSheet()->setCellValue('A' . $i, $data[$i - 2]['id']);
            $objPHPExcel->getActiveSheet()->setCellValue('B' . $i, $data[$i - 2]['name']);
            $objPHPExcel->getActiveSheet()->setCellValue('C' . $i, $data[$i - 2]['age']);
            $objPHPExcel->getActiveSheet()->setCellValue('D' . $i, $data[$i - 2]['sex']);
        }

        $objPHPExcel->getActiveSheet()->setTitle('students');      //设置sheet的名称
        $objPHPExcel->setActiveSheetIndex(0);                   //设置sheet的起始位置
        $objWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');   //通过PHPExcel_IOFactory的写函数将上面数据写出来
        $PHPWriter = \PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
        header('Content-Disposition: attachment;filename="用户信息.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件
    }

    //导出csv
    public function csv() {
        $csv=new Csv();
        $list=Db::table("csg_student")->select();//查询数据，可以进行处理
//        echo "<pre>";
//        print_r($list);
//        echo "</pre>";exit;
//        $list=Db::table("tp_information")->select();//查询数据，可以进行处理
        //处理身份证的号码，避免在csv表格中数字变为科学计数法
//        foreach ($list as $k=>$v) {
//            $list[$k]['idcard'] = "'".$v['idcard'];
//        }
        $csv_title=array('序号','名字','年龄','性别');
        $csv->put_csv($list,$csv_title);
    }

    //导入csv,测试数据在data文件夹下的csv后缀名的文件
    public function csvExport()
    {
        if (request()->isPost()) {
            $filename = $_FILES['csv']['tmp_name'];
            if (empty ($filename)) {
                echo '请选择要导入的CSV文件！';
                exit;
            }
            $handle = fopen($filename, 'r');
            $result = $this->input_csv($handle); //解析csv

            $len_result = count($result);
            if($len_result==0){
                echo '没有任何数据！';
                exit;
            }
            $r = array();
            foreach($result as $k=>$v) {
                foreach($v as $k1=>$v1) {
                    $r[$k]['name'] = iconv('gb2312', 'utf-8', $v[1]);
                    $r[$k]['age'] = iconv('gb2312', 'utf-8', $v[2]);
                    $r[$k]['sex'] = iconv('gb2312', 'utf-8', $v[3]);
                }
            }
            //去掉头部
            array_shift($r);
            $query = Db::table('csg_student')->insertAll($r);//exit;
            fclose($handle); //关闭指针
            if($query){
                echo '导入成功！';
            }else{
                echo '导入失败！';
            }
        }
    }

    //解析csv
    public function input_csv($handle) {
        $out = array ();
        $n = 0;
        while ($data = fgetcsv($handle, 10000)) {
            $num = count($data);
            for ($i = 0; $i < $num; $i++) {
                $out[$n][$i] = $data[$i];
            }
            $n++;
        }
        return $out;
    }

    //1.使用数据库
    public function db() {
//        $r = db('user')->select();
        $r = Db::name('user')->select();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    //2.不带前缀名的
    public function db1() {
        $r = Db::table('csg_student')->select();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    //3.使用数据库有前缀
    public function db2() {
        //助手函数
        $r = db('user')->select();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    //

    //生成二维码
    public function qrcode() {
        $savePath = APP_PATH . '/../public/qrcode/';
        $webPath = '/qrcode/';
        $qrData = '村上岗，姚明';
        $qrLevel = 'H';
        $qrSize = '8';
        $savePrefix = 'cunshanggang';
        $pic = "";
        if($filename = createQRcode($savePath, $qrData, $qrLevel, $qrSize, $savePrefix)){
            $pic = $filename;
        }
//        echo "<img src='../../../public/qrcode/$pic'>";
        $this->assign('pic',$pic);
        return $this->fetch();

//        \PHPQRCode\QRcode::png("Test", "/tmp/qrcode.png", 'L', 4, 2);
    }

    // 三级联动
    public function area(){

        if(request()->isAjax()){

            $code = input('post.code');
            $lists = db('area')->where('pid', $code)->select();

            return json(['code' => 1, 'data' => $lists, 'msg' => 'ok']);
        }

        $province = db('area')->where('pid', 0)->select();

        $this->assign([
            'province' => $province
        ]);

        return $this->fetch();
    }


    //ajax+jQuery+上传文件
    public function up() {
        return $this->fetch('upload');
    }

    public function upload() {
        // 获取上传文件
        $file = request()->file('myfile');
    //         echo "<pre>";
    //         print_r($file);
    //         echo "</pre>";exit;
        // 验证图片,并移动图片到框架目录下。
//        $info = $file ->validate(['size' => 512000,'ext' => 'jpg,png,jpeg','type' => 'image/jpeg,image/png'])->move(ROOT_PATH.'public'.DS.'uploads');//报错
//         $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');//成功
        $info = $file->validate(['ext'=>'jpg,png,jpeg'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // $info->getExtension();         // 文件扩展名
            $mes = $info->getFilename();      // 文件名
//            $this->success('文件上传成功!');
            echo '{"flag":"1","mes":"'.$mes.'"}';
        }else{
            // 文件上传失败后的错误信息
            $mes = $file->getError();
//            $this->error('文件上传失败!',url('Tools/up'));
            echo '{"flag":"0","mes":"'.$mes.'"}';
        }
    }

    //ajax的使用
    public function myAjax() {
        return $this->fetch('ajax');
    }

    //ajax处理
    public function ajax() {
//        echo "<pre>";
//        print_r($_REQUEST);
//        echo "</pre>";

//        echo '1';
        return 1;
    }

    public function jsonp() {
        $arr = array('1','2','3');
//        echo "<pre>";
//        print_r($arr);
//        echo "</pre>";
//        echo "<hr>";
//        echo "<pre>";
//        print_r(json($arr));
//        echo "</pre>";
//        echo "<pre>";
//        print_r(json($arr));
//        echo "</pre>";
//        $j = json($arr);
//        echo $j;
        //jsonp数据格式
//        jsonp();
        //将数组直接转化为json
//        $this->toJson();
//        $user = Db::name('user')->select();//不能使用toJson，因为不是对象，是数组
//        echo "<pre>";
//        print_r($user);
//        echo "</pre>";
        $user = User::get(9);//必须使用model才可以使用toJson()
//        echo "<pre>";
//        print_r($user);
//        echo "</pre>";
//        echo $user->toJson();
        return $user->toJson();
    }

    //thinkphp5中助手函数:json()的使用
    public function json() {
        $arr = array("1","2","3");
        $a = array('name'=>'村上岗','gender'=>'male','age'=>'24','birthday'=>'1993-07-18');
//        echo json($arr);//报错
//        return json($arr);//正确
        return json($a);
    }

    //练习使用数据库
    public function useUser() {
        $r = User::get(5);//获取到的是一个对象
//        echo "<pre>";
//        print_r($r->toArray());//将对象转换成数组
//        echo $r->nickname;//访问属性,方法一
//        echo $r['nickname'];//访问属性,方法二
//        echo "</pre>";

        //使用select
        $obj = new User;
//        $select = $obj->where()->select();

    }

    //查询数据库
    public function myDb() {
        //助手函数
//        $r = db('user')->select();
//        echo "<pre>";
//        print_r($r);
//        echo "</pre>";
        //带条件where
//        $re = db('user')->where('id',5)->find();
//        echo "<pre>";
//        print_r($re);
//        echo "</pre>";
        //更新数据
//        db('user')->where('id',5)->update(['name'=>'村上岗']);
//        $a = array('name'=>'林依蓝');
//        db('user')->where('id',5)->update($a);
        //多表查询join()
//        $res = db('user as u')->join('book','u.id=book.user_id')->where('u.id','4')->select();
        //sql语句
        //SELECT * FROM tp_user as u INNER JOIN `tp_book` `book` ON `u`.`id`=`book`.`user_id` WHERE `u`.`id` = '4'
//        echo "<pre>";
//        print_r($res);
//        echo "</pre>";
        //新建视图
//        $result = db('user as u')->field('*')->view('book','*','u.id=book.user_id')->select();
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
        //使用order
//        $r2 = db('user')->order('id','asc')->select();//默认是desc
//        $sql = db('user as u')->join('book','u.id=book.user_id')->where('u.id','4')->fetchSql()->select();//打印sql语句
//        echo $sql;
//        echo "<hr>";
//        echo "<pre>";
//        print_r($r2);
//        echo "</pre>";
        //使用group()
//        $r3 = db('user')->group('name')->select();
//        $sql = db('user')->group('name')->fetchSql()->select();
//        echo $sql;
//        echo "<hr>";
//        echo "<pre>";
//        print_r($r3);
//        echo "</pre>";
        //使用存储过程
//        $r4 = Db::query('call user5()');
//        echo "<pre>";
//        print_r($r4);
//        echo "</pre>";
        //使用事务进行操作
        //自动控制事务处理
        Db::transaction(function(){
           $u = db('user')->where('id','5')->find();
           $u['name'] = 'yaoMing1';
           db('user')->where('id','15')->update($u);
        });
        $user = Db::connect("tp");
        //手动控制事务
        $user->startTrans();
        try{
            //方法一
//            $u = db('user')->where('id','5')->find();
//            $u['name'] = 'yaoMing5';
//            db('user')->where('id','5')->update($u);

            //方法二
//            $u = Db::name('user')->where('id','15')->find();
//            $u['name'] = 'yaoMing8';
//            Db::name('user')->where('id','15')->update($u);

            //方法三
//            $u = Db::table('tp_user')->where('id','5')->find();//使用Db::table()要使用表的全称，不能省去前缀
//            $u['name'] = 'yaoMing6';
//            Db::table('tp_user')->where('id','5')->update($u);//使用Db::table()要使用表的全称，不能省去前缀
//            echo 'try';
            $r = $user->name('tp_user')->where('id','5')->find();
            echo "<pre>";
            print_r($r);
            echo "</pre>";
            //提交事务
            $user->commit();
        }catch (\Exception $e) {
            echo "<pre>";
            print_r($e->getMessage());//打印错误的信息
            echo "</pre>";
            //回滚事务
//            echo 'catch';
            $user->rollback();
        }

    }
}



