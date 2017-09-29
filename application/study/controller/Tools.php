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
class Tools extends Controller {
    public function __construct() {
        vendor("PHPExcel.PHPExcel.PHPExcel");
        vendor("PHPExcel.PHPExcel.Writer.Excel5.");
        vendor("PHPExcel.PHPExcel.Writer.Excel2007.");
        vendor("PHPExcel.PHPExcel.IOFactory");
    }
    public function excel() {

        if(request()->isPost()) {
            $excel = request()->file('excel')->getInfo();
            $objPHPExcel = \PHPExcel_IOFactory::load($excel['tmp_name']);//读取上传的文件
            $arrExcel = $objPHPExcel->getSheet(0)->toArray();//获取其中的数据
            print_r($arrExcel);die;
        }
        return $this->fetch();
    }
}