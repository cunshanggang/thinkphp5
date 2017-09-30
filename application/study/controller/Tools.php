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

    //使用数据库
    public function db() {
//        $r = db('user')->select();
        $r = Db::name('user')->select();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    //不带前缀名的
    public function db1() {
        $r = Db::table('csg_student')->select();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

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

}