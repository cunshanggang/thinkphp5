<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12
 * Time: 17:18
 */
namespace app\api\controller\v1;
use app\study\model\User;
class User1{
    // 获取用户信息
    public function read($id = 2)
    {
//        echo '<pre>';
//        print_r(request());
//        echo '</pre>';
        $user = User::get($id);
        if ($user) {
            return json($user);
        } else {
            return json(['error' => '用户不存在'],404);
        }
    }
}