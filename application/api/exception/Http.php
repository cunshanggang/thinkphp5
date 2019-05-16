<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/13
 * Time: 16:17
 */
namespace app\api\exception;
use think\exception\Handle;
use think\exception\HttpException;
class Http extends Handle
{
    public function render(\Exception $e)
    {
        if ($e instanceof HttpException) {
            $statusCode = $e->getStatusCode();
        }
        if (!isset($statusCode)) {
            $statusCode = 500;
        }
        $result = [
            'code' => $statusCode,
            'msg' => $e->getMessage(),
            'time' => $_SERVER['REQUEST_TIME'],
        ];
        return json($result, $statusCode);
    }
}