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
//        trace('Test454645465464546 Log','error');

//        $this->recordErrorLog();
//        Log::record('测试日志信息');

//        Log::init(['type' => 'File', 'path' => LOG_PATH]);
//        Log::write('test log', 'info');
        Log::record('记录每一个坑','error');
        Log::write('写入每一个坑','error');
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


    /*
     * SCRIPT_NAME:当前脚本路径
     *
     * HTTP_REFERER:引导用户代理到当前页的前一页的地址，即：从哪个页面跳转过来的。从收藏夹跳转该值为空
     *
     * HTTP_USER_AGENT:用户代理，也可以使用函数get_browser():需要相关的配置;
     *
     * */
    public function checkeHome()
    {
        if (isset($_SERVER["SCRIPT_NAME"])
            && strpos($_SERVER["SCRIPT_NAME"], '/home.php') !== false
            && !isset($_SERVER["HTTP_REFERER"])
            && isset($_SERVER["HTTP_USER_AGENT"])
            && strpos($_SERVER["HTTP_USER_AGENT"], 'Chrome/65') !== false
        ) {
            echo '该网页不存在';
        }
    }

    public function getBrowser()
    {
        $browser = get_browser(null, true);
        echo "<pre>";
        print_r($browser);
        echo "</pre>";
        echo "<hr>";
        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";exit;
    }

}