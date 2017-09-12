<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/9/12
 * Time: 17:18
 */
namespace app\study\api\controller\v2;
use app\study\api\model\User;
class User{
    // 获取用户信息
    public function read($id = 2)
    {
        $user = User::get($id);
        if ($user) {
            return json($user);
        } else {
            return json(['error' => '用户不存在'], 404);
        }
    }
}