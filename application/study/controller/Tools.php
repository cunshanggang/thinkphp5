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
        $PHPWriter = \PHPExcel_IOFactory::createWriter( $objPHPExcel,"Excel2007");
        header('Content-Disposition: attachment;filename="用户信息.xlsx"');
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        $PHPWriter->save("php://output"); //表示在$path路径下面生成demo.xlsx文件

    }
}