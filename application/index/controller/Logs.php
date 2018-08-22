<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/22
 * Time: 18:24
 */
namespace app\index\controller;
use think\Controller;
use think\Log;
class Logs extends Controller
{
    public function write()
    {
        echo LOG_PATH;
//        trace('Test Log','error');
        $log = new Log();
        $log::write('test log','error');
        $this->recordErrorLog();
//        Log::record('测试日志信息');

//        Log::init(['type' => 'File', 'path' => LOG_PATH]);
        Log::write('test log', 'error');
//        Log::init(['type' => 'File', 'path' => APP_PATH . 'wxpay_logs/']);
//        Log::write('wx支付日志');
//        Log::write('wx支付日志');
    }

    //tp的日志默认是关闭的，所以下面是初始化日志配置，在日志中记录错误信息
    private function recordErrorLog()
    {
        log::init([
            'type' => 'File',
            'path' => LOG_PATH,
            'level' => ['error']
        ]);
        Log::record('111', 'error');
    }


}