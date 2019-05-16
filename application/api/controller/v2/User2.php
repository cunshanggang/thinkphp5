<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12
 * Time: 17:18
 */
namespace app\api\controller\v2;
use app\study\model\User;
class User2{
    // 获取用户信息
    public function read($id)
    {
        $user = User::get($id,'profile');
        if ($user) {
            return json($user);
        } else {
            return json(['error' => '用户不存在'], 404);
        }

        //接管HTTP异常处理后，遇到异常后抛出异常
//        $user = User::get($id, 'profile');
//        if ($user) {
//            return json($user);
//        } else {
//        //抛出HTTP异常 并发送404状态码
//            return abort(404,'用户不存在');
//        }

        //如果希望捕获系统的任何异常并转发，可以使用try catch
//        try {
//        // 制造一个方法不存在的异常
//            $user = User::geet($id, 'profile');
//            if ($user) {
//                return json($user);
//            } else {
//                return abort(404, '用户不存在');
//            }
//        } catch (\Exception $e) {
//        // 捕获异常并转发为HTTP异常
//            return abort(404, $e->getMessage());
//        }
    }
}