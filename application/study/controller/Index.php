<?php
namespace app\study\controller;
//use test1\Test1;
//use test1\Test1;
//use first\second\Foo;
use think\Controller;
use think\Loader;
use think\Validate;
use app\study\model\User;
use app\study\model\Profile;
use app\study\model\Role;
use think\Session;
use think\Request;
//use think\Captcha;
use cropAvatar\CropAvatar;
class Index extends Controller
{
    public function index()
    {
//        echo "<pre>";
//        print_r($_REQUEST);
        return $this->fetch();
//        return '<style type="text/css">*{ padding: 0; margin: 0; } div{ padding: 4px 48px;} a{color:#2E5CD5;cursor: pointer;text-decoration: none} a:hover{text-decoration:underline; } body{ background: #fff; font-family: "Century Gothic","Microsoft yahei"; color: #333;font-size:18px;} h1{ font-size: 100px; font-weight: normal; margin-bottom: 12px; } p{ line-height: 1.6em; font-size: 42px }</style><div style="padding: 24px 48px;"> <h1>:)</h1><p> ThinkPHP V5<br/><span style="font-size:30px">十年磨一剑 - 为API开发设计的高性能框架</span></p><span style="font-size:22px;">[ V5.0 版本由 <a href="http://www.qiniu.com" target="qiniu">七牛云</a> 独家赞助发布 ]</span></div><script type="text/javascript" src="http://tajs.qq.com/stats?sId=9347272" charset="UTF-8"></script><script type="text/javascript" src="http://ad.topthink.com/Public/static/client.js"></script><thinkad id="ad_bd568ce7058a1091"></thinkad>';
    }

    public function add() {
//        echo "<pre>";
//        print_r($_REQUEST);
        //判断是否为POST提交，助手函数：request()->isPost()
//        if(request()->isPost()) {
//            echo "是POST提交！";
//        }

    //独立验证
//        $validate = new Validate([
//            'userName'  => 'require|max:25',
//        ]);
    //规则
//        $rule = [
//            'userName'  => 'require|max:1',
//        ];
    //信息
//        $msg = [
//            'userName.require' => '名称必须',
//            'userName.max'     => '名称最多不能超过1个字符',
//        ];
//        $data = [
//            'name'  => 'thinkphp',
//            'email' => 'thinkphp@qq.com'
//        ];
    //使用
//        $validate = new Validate($rule,$msg);
//        $result   = $validate->check($_POST['userName']);
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        print_r($_POST['userName']);
        $data = input();//输出的是数组
//        $data = input('post.');//输出的是数组
//        $data = input('post.userName');//输出是字符串
        echo "<pre>";
        var_dump($data);
        $validate = Loader::validate('User');
        if(!$validate->check($data)){
            echo "<pre>";
            print_r($validate->getError());
//            dump($validate->getError());
        }


    }

    //上传图片(单文件)
    public function upload(){
        // 获取表单上传文件 例如上传了001.jpg
        $file = request()->file('image');
        // 移动到框架应用根目录/public/uploads/ 目录下
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');//没有验证的
        //加上验证
        $info = $file->validate(['size'=>15678,'ext'=>'jpg,png,gif'])->move(ROOT_PATH . 'public' . DS . 'uploads');
        if($info){
            // 成功上传后 获取上传信息
            // 输出 jpg
            echo $info->getExtension();
            echo "<hr>";
            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getSaveName();//不知道怎么来的
            echo "<hr>";
            // 输出 42a79759f284b767dfcb2a0197904287.jpg
            echo $info->getFilename();
        }else{
            // 上传失败获取错误信息
            echo $file->getError();
        }
    }

    //引入类库
    public function impClass() {
//        echo '789798';
        //引入类文件的三种方法
        //1.使用 vendor()
//        vendor("test1.test1",'.class.php');
        //2.直接实例化,在头部使用命名空间：use \test1\Test1;
//        $test = new Test1();
//        $test->show();
//        print_r($r);
//        echo EXTEND_PATH;
//        var_dump(Loader::import('test1.Test1',EXTEND_PATH));
//        Loader::import('test1.Test1',EXTEND_PATH);
//        $test = new \Test1();
        //检查文件是否被引入
        //------- start --------
//        $included_files = get_included_files();
//        foreach ($included_files as $filename) {
//            echo "$filename\n";
//        }
        //------- end ---------
//        $hello = new \first\second\Foo();
//        $hello->hello();
//        Loader::import('first.second.Foo');
//        require_once '../extend/first/second/Foo.php';
        $foo = new \first\second\Foo();
        echo $foo->hello();exit;
//        echo "<pre>";
//        print_r($foo);
        echo "54545";
        echo "<hr>";
        $test1 = new Test1();
        var_dump(class_exists("Foo"));
//        $foo->hello();
//        $test = new \Test1();
//        $test->show();

    }
    //导入数据
    function impUser(){
//        $file = request()->file('import');
//        echo "<pre>";
//        print_r($file);
//        echo "</pre>";exit;
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads'. DS . 'excel');

//        echo "<pre>";
//        print_r($info);
//        echo "</pre>";//exit;
//        if($info){
//            // 成功上传后 获取上传信息
//            // 输出 jpg
//            echo $info->getExtension();
//            echo "<hr>";
//            // 输出 20160820/42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getSaveName();//不知道怎么来的
//            echo "<hr>";
//            // 输出 42a79759f284b767dfcb2a0197904287.jpg
//            echo $info->getFilename();
//        }else{
//            // 上传失败获取错误信息
//            echo $file->getError();
//        }
        //exit;
//        if (!empty($_FILES)) {
//            $config=array(
//                'allowExts'=>array('xlsx','xls'),
//                'savePath'=>'./Public/upload/',
//                'saveRule'=>'time',
//            );
//            $upload = new UploadFile($config);
//            if (!$upload->upload()) {
//                $this->error($upload->getErrorMsg());
//            } else {
//                $info = $upload->getUploadFileInfo();
//
//            }

//            $file_name = $info->getSaveName();
//        echo $file_name;exit;
//        echo EXTEND_PATH;exit;
//        echo dirname(__FILE__);
//        echo "<hr>";
//        require_once ('../../'.'PHPExcel'.'/'.'PHPExcel'.'/'.'IOFactory.php');
//        echo "<pre>";
//        print_r($_FILES);
//        $filePath = $_FILES['import']['tmp_name'];
//        $PHPExcel = new PHPExcel();
        include 'D:\www\htdocs\thinkphp5\extend\test1\Test1.php';
        $test = new Test1();
        echo $test->show();exit;

        /**默认用excel2007读取excel，若格式不对，则用之前的版本进行读取*/
        $PHPReader = new PHPExcel_Reader_Excel2007();
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return ;
            }
        }

        $PHPExcel = $PHPReader->load($filePath);
        /**读取excel文件中的第一个工作表*/
        $currentSheet = $PHPExcel->getSheet(0);

        /**取得最大的列号*/
        $allColumn = $currentSheet->getHighestColumn();
        /**取得一共有多少行*/
        $allRow = $currentSheet->getHighestRow();
        $data = array();
        /**从第二行开始输出，因为excel表中第一行为列名*/
        for($rowIndex=1;$rowIndex<=$allRow;$rowIndex++){//循环读取每个单元格的内容。注意行从1开始，列从A开始
            for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                $addr = $colIndex.$rowIndex;
//        echo $addr;
//        echo "<hr>";
                $cell = $currentSheet->getCell($addr)->getValue();
//        echo "<pre>";
//        print_r($cell);
//        echo "</pre>";//exit;
                if($cell instanceof PHPExcel_RichText){ //富文本转换字符串
                    $cell = $cell->__toString();
                }
                $data[$rowIndex][$colIndex] = $cell;
            }
        }
echo "<pre>";
        print_r($data);
        echo "</pre>";exit;
        $objReader = \PHPExcel_IOFactory::createReader('Excel5');
            $objPHPExcel = $objReader->load($file_name,$encode='utf-8');
            $sheet = $objPHPExcel->getSheet(0);
            $highestRow = $sheet->getHighestRow(); //取得总行数
        echo $highestRow;
            $highestColumn = $sheet->getHighestColumn(); //取得总列数
            for($i=3;$i<=$highestRow;$i++)
            {
                $data['account']= $data['truename'] = $objPHPExcel->getActiveSheet()->getCell("B".$i)->getValue();
                $sex = $objPHPExcel->getActiveSheet()->getCell("C".$i)->getValue();
                // $data['res_id']    = $objPHPExcel->getActiveSheet()->getCell("D".$i)->getValue();
                $data['class'] = $objPHPExcel->getActiveSheet()->getCell("E".$i)->getValue();
                $data['year'] = $objPHPExcel->getActiveSheet()->getCell("F".$i)->getValue();
                $data['city']= $objPHPExcel->getActiveSheet()->getCell("G".$i)->getValue();
                $data['company']= $objPHPExcel->getActiveSheet()->getCell("H".$i)->getValue();
                $data['zhicheng']= $objPHPExcel->getActiveSheet()->getCell("I".$i)->getValue();
                $data['zhiwu']= $objPHPExcel->getActiveSheet()->getCell("J".$i)->getValue();
                $data['jibie']= $objPHPExcel->getActiveSheet()->getCell("K".$i)->getValue();
                $data['honor']= $objPHPExcel->getActiveSheet()->getCell("L".$i)->getValue();
                $data['tel']= $objPHPExcel->getActiveSheet()->getCell("M".$i)->getValue();
                $data['qq']= $objPHPExcel->getActiveSheet()->getCell("N".$i)->getValue();
                $data['email']= $objPHPExcel->getActiveSheet()->getCell("O".$i)->getValue();
                $data['remark']= $objPHPExcel->getActiveSheet()->getCell("P".$i)->getValue();
                $data['sex']=$sex=='男'?1:0;
                $data['res_id'] =1;

                $data['last_login_time']=0;
                $data['create_time']=$data['last_login_ip']=$_SERVER['REMOTE_ADDR'];
                $data['login_count']=0;
                $data['join']=0;
                $data['avatar']='';
                $data['password']=md5('123456');
                M('Member')->add($data);

            }
//            $this->success('导入成功！');
//        }else
//        {
//            $this->error("请选择上传的文件");
//        }
    }

    public function TestModel() {
        //需要实例化的
        /*
//        $user = new User;
//        $user->name = '林书豪';
//        $user->age = '28';
//        $user->sex = '1';
//
//        if($user->save()){
//            return "插入成功";
//        }else{
//            return $user->getError();
//        }
        */

        //不需实例化
        $user['name'] = '易建联';
        $user['age'] = '32';
        $user['sex'] = '0';

        if($result=User::create($user)) {
            return $result->name.'插入成功';
            //带提示的
//            return $this->success("{$result->name}成功",url('Index/index'));
        }else{
            return '插入错误';
        }

    }

    //批量添加
    public function addList() {
//        $csg = new User();
//        $result = $csg->testCsg();
//        echo $result;

        $list = [
            ['name'=>'北田小一郎','age'=>'36','sex'=>'0'],
            ['name'=>'丰田章男','age'=>'46','sex'=>'0'],
            ['name'=>'手冢治虫','age'=>'76','sex'=>'0']
        ];

        $user = new User();
        if($user->saveAll($list)) {
            return "批量插入成功!";
        }else{
//            echo "批量插入失败!";
            //显示错误信息
            return $user->getError();
        }
    }

    //查询数据
    public function read() {
        //获取一条信息
        echo $_GET['889779'];exit;
        $result = User::get(9);
//        dump($result);
        //结果是一个对象
        echo "<pre>";
        print_r($result);
        echo "</pre>";

//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';


        /*
        //根据字段来查询
//        $result = User::getByName('林书豪');
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //根据用户自定义的字段来查询，多条件传入数组
//        $result = User::get(['name'=>'丰田章男','age'=>'406']);
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //更复杂的查询则可以使用查询构建器来完成
//        $result = User::where('name','手冢治虫')->find();
//        echo '姓名'.$result->name.'<br />';
//        echo '年龄'.$result->age.'<br />';
//        echo '性别'.$result->sex.'<br />';
        */

        /*
        //获取所有的列表
//        $result = User::all(['sex'=>0,'name'=>'孙杨']);//带条件
//        foreach($result as $k=>$v) {
//            echo '姓名'.$v['name'].'<br />';
//            echo '年龄'.$v['age'].'<br />';
//            echo '性别'.$v['sex'].'<br />';
//            echo "<hr>";
//        }
        */

        /*
        //使用数据库的查询构建器完成更多的条件查询
        $result = User::where('id','>','3')->select();
//        foreach($result as $k=>$v) {
//            echo '姓名'.$v['name'].'<br />';
//            echo '年龄'.$v['age'].'<br />';
//            echo '性别'.$v['sex'].'<br />';
//            echo "<hr>";
//        }
        //或者
//        foreach($result as $user) {
//            echo '姓名'.$user->name.'<br />';
//            echo '年龄'.$user->age.'<br />';
//            echo '性别'.$user->sex.'<br />';
//            echo "<hr>";
//        }
        */
    }

    //更新数据
    public function update() {
//        $result = User::get();
//        echo "<pre>";
//        print_r($result);
//        echo "</pre>";
//        $result['name'] = '林依蓝';
//        $result['age'] = '24';
//        $result['sex'] = '0';

//        $result->name = '林依蓝';
//        $result->age = '24';
//        $result->sex = 1;
//
//        if(false !== $result->save()) {
//            return '更新成功';
//        }else{
//            return $result->getError();
//        }

        $result = User::get(1);
        $result['name'] = '押井守';
        $result['age'] = '68';
        if(false !== $result->save()) {
            return "更新成功";
        }else{
            return "更新失败";
        }
    }

    //删除数据
    public function delete() {
        //第一种方法
//        $result = User::get(50);
//        if($result) {
//            $result->delete();
//            return "删除成功";
//        }else{
//            return "删除失败";
//        }

        //第二种方法
        $result = User::destroy(49);
        if($result) {
            return "删除成功";
        }else{
            return "删除失败";
        }

    }

    //使用读取器
    public function getRead(){
        $r = User::get(48);
//        echo "<pre>";
//        print_r($r);
//        echo "</pre>";
        echo $r->time;
    }

    //使用修改器
    public function setRead(){
        $r = new User;
        $r->name='林书北';
        $r->age='25';
        $r->sex='0';
        $r->time='2017-09-07';

        if($r->save()){
            return "插入成功";
        }else{
            return $r->getError();
        }
    }

    //类型转换
    public function transfer(){
        $r = new User;
        $r->name='林书炜';
        $r->age='25';
        $r->sex='0';
        $r->time='2017-09-07';

        if($r->save()){
            return "插入成功";
        }else{
            return $r->getError();
        }
    }

    //查询范围scope
    public function showResult() {
        $r = User::scope('name','age')->all();
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    //查询结果
    public function showConnect() {
        $r = User::get(5);
        //获取User对象的nickname属性
//        echo $r->nickname;
        //获取User对象的Book关联对象
//        dump($r->books());
        //执行关联的Book对象的查询
        $result = $r->books()->where('title','thinkphp')->find();
//        echo "<pre>";
//        print_r($result->title);
//        echo "</pre>";
    }

    //添加书籍
    public function addBook() {
        $user = User::get(1);
        $books = [
            ['title'=>'ThinkPHP5快速入门','publish_time'=>'2017-09-08'],
            ['title'=>'ThinkPHP5开发手册','publish_time'=>'2017-09-08']
        ];
        $user->books()->saveAll($books);
        return '添加Book成功!';
    }

    //往档案(profile)添加数据
    public function addProfile() {
        $user = new User();
        $user->name = 'thinkphp';
        $user->password = '123456';
        $user->nickname = '流年';
        if($user->save()) {
            //写入关联数据
            $profile = new Profile();
            $profile->truename = '刘晨';
            $profile->birthday = '2017-09-08';
            $profile->address = '广州市白云区村上岗集团)';
            $profile->email = 'thinkphp@qq.com';
            $user->profile()->save($profile);
            return "新增用户!";
        }else{
            return $user->getError();
        }
    }

    //读取profile表
    public function readProfile($id) {
        //访问路径：http://localhost/thinkphp5/index.php/study/index/readProfile/id/7
        $user = User::get($id);
        echo $user->name.'<br />';
        echo $user->nickname.'<br />';
        echo $user->profile->truename.'<br />';
        echo $user->profile->email.'<br />';
    }

    //更新profile表
    public function updateProfile($id) {
        $user = User::get($id);
        $user->name = 'framework';
        if($user->save()) {
            //更新关联数据
            $user->profile->email = 'liu21st@gmail.com';
            $user->profile->save();
            return '用户['.$user->name.']';
        }else{
            return $user->getError();
        }
    }

    //删除关联数据
    public function deleteProfile($id) {
        $user = User::get($id);
        if($user->delete()) {
            $user->profile->delete();
            return '用户名['.$user->name.']删除成功！';
        }else{
            return "删除失败!";
        }
    }

    //查询books
    public function readBook() {
        /*
        $user = User::get(1,'books');
        $books = $user->books();//结果返回是：对象
//        $books = $user->book;//结果返回是：数组
//        dump($books);
        */

        $user = User::get(1);
        //获取状态为1的关联数据
        $books = $user->books()->where('status',1)->select();
//        dump($books);
        $book = $user->books()->getByTitle('ThinkPHP5快速入门');
//        dump($book);
//        echo $book->user_id;
        //查询有写过书的作者
//        $user = User::has('books')->select();
//        echo "<pre>";
//        print_r($user);
//        echo "</pre>";
        //查询有写过3本书的作者
//        $user = User::has('books','>=','2')->select();
//        dump($user);
        //查询写过ThinkPHP5快速入门的作者
        $user = User::hasWhere('books',['title'=>'ThinkPHP5快速入门'])->select();
        echo "<pre>";
        print_r($user);
        echo "</pre>";
    }

    public function updateBook($id) {
        //方法一
//        $user = User::get($id);
//        $book = $user->books()->getByTitle('ThinkPHP5开发手册');
//        $book->title = 'ThinkPHP5快速入门123456';
//        $book->save();

        //方法二
        $user = User::get($id);
        $user->books()->where('title','ThinkPHP5快速入门123456')->update(['title'=>'ThinkPHP5开发手册']);
    }

    //删除数据
    public function deleteBook($id) {
        //删除部分
//        $user = User::get($id);
//        $book = $user->books()->getByTitle('ThinkPHP5开发手册');
//        $book->delete();

        //删除全部
        $user = User::get($id);
        if($user->delete()) {
           //删除所有的关联的数据
            $user->books()->delete();
        }
    }

    //多对多关系 添加role
    public function addRole() {
        //添加单个角色
//        $user = User::getByNickname('张三');
//        //新增用户角色，并自动写入枢纽表
//        $user->roles()->save(['name'=>'editor','title'=>'编辑']);
//        return '用户新增角色成功!';

        //添加多个角色
//        $user = User::getByNickname('张三');
//        //给当前用户添加多个用户角色
//        $user->roles()->saveAll([
//            ['name'=>'leader','title'=>'领导'],
//            ['name'=>'admin','title'=>'管理员'],
//        ]);
//        return '用户新增角色成功';

        //通过attach添加新角色
//        $user = User::getByNickname('押井守');
//        $user->roles()->attach(2);
//        return '用户角色添加成功!!!';
    }

    //关联删除数据
    public function deleteRole() {
        //删除部分数据
//        $user = User::get(9);
//        $role = Role::getByName('admin');
//        //删除关联数据，但不删除关联模型数据
//        $user->roles()->detach($role);
//        return '删除角色成功！！！888';

        //删除全部数据
        $user = User::getByNickname('张三');
        $role = Role::getByName('editor');
        //删除关联数据的同时删除关联模型的数据
        $user->roles()->detach($role,true);
        return '用户角色删除成功77987';
    }

    //查询数据
    public function readRole() {
        $user = User::getByNickname('张三');
//        dump($user->roles);
        $r = $user->roles;
//        echo $r[0]['title'];
        echo $r['title'];
//        echo "<pre>";
//        print_r($user->roles);
//        echo "</pre>";
    }

    //同样支持对多对关联使用预载入查询
    public function readRole1() {
        $user = User::get(2,'roles');
        //将数组里的对象转换成数组
//        dump($user->toArray());
        $r = $user->toArray();
        echo $r['roles'][0]['title'];//三维数组
//        echo "<pre>";
//        print_r(gettype($user->roles[0]));
//        echo '<br />';
////        dump($user->roles);
//        print_r($user->roles);
//        echo "</pre>";
//        dump($user->roles[0]->title);
    }

    //输出数组，将对象转换成数组
    public function toArray($id='') {
        $user = User::get($id);
        echo "<pre>";
        dump($user->toArray());
        echo "</pre>";
    }

    //隐藏属性
    public function hidden($id) {
        $user = User::get($id);
        dump($user->hidden(['create_time','update_time'])->toArray());
    }

    //指定属性
    public function visible($id) {
        $user = User::get($id);
        dump($user->visible(['id','nickname','name'])->toArray());
    }

    //插入修改的属性
    public function append($id='') {
        $user = User::get($id);
//        dump($user);
        echo "<pre>";
        dump($user->append(['status'])->toArray());
        echo "</pre>";
    }

    //输出json格式
    public function toJson($id) {
        //方法一
//        $user = User::get($id);
//        dump($user->toJson());

        //方法二
        echo User::get($id);//直接输出
    }

    //读取用户列表
    public function userList() {
        $list = User::paginate(2);
        $this->assign('list',$list);
        $this->assign('count',count($list));
//        可以在这里定义样式的路径，也可以在config.php配置文件里面配置
        $this->view->replace([
            '__PUBLIC__' => '../../../public/static',
        ]);
        return $this->fetch('Index/index');
    }

    //使用全局方法
    public function myFirst() {
        echo my_fun();
        echo "<br />";
        echo my_first();
    }

    //使用session
    public function mySession() {
        //设置session
//        Session::set('name','csg');
//        Session::set('pwd','123456');
//        Session::set('status','12222');
        //读取session
//        echo Session::get('name');
//        echo Session::get('pwd');
//        echo Session::get('status');

        //加上前缀或者作用域
//        Session::set('email','jamse_lin@gmail.com','csg');
//        Session::set('lin','yaoming','yaoming');
        //判断sessino是否已经存在了,1:存在，空的话为否
//        echo Session::has('name');

        //使用助手函数来进行判断,注意开头是小写
//        echo session('?name');

        //取值当前think的作用域
//        echo session('name','','think');

        //在模板输出
//        Session::clear();
//        Session:delete('csg.email');
//        echo "<pre>";
//        print_r($_SESSION);
//        echo "</pre>";
//        session(null);
        $arr = array('name'=>array('yaoming'));
//        Session::set('lin.name','yaoming','csg');
//        Session::set('lin.name','yaoming','csg');


//        echo "<pre>";
//        print_r($_SESSION);
//        echo "</pre>";
        session('name.ym','yaoming','csg');
//        session('star.yjl','yijianlian');
//        echo "<pre>";
//        print_r($_SESSION);
//        echo "</pre>";
        return $this->fetch('Index/index');
    }

    //cookie怎么使用cookie
    public function myCookie() {
        //设置cookie
        cookie('name','yaoming');
        //删除cookie
        cookie('name',null);
        //读取cookie
        echo cookie('name','');
//        echo "<pre>";
//        print_r($_COOKIE);
//        echo "</pre>";
    }

    //验证码的使用
    public function captcha() {
//        $captcha = new think\Captcha();
//        $captcha->fontSize = 30;
//        $captcha->length   = 3;
        return $this->fetch('index/captcha');
    }

    //验证码的检验
    public function check($code) {
        if (!captcha_check($code)) {
            $this->error('验证码错误');
        } else {
            $this->success('验证码正确');
        }
    }

    //上传图片
    public function upFile() {
        return $this->fetch('index/upload');
    }

    public function up(Request $request) {
        // 获取表单上传文件
        $file = $request->file('file');
        if (empty($file)) {
            $this->error('请选择上传文件');
        }
        // 移动到框架应用根目录/public/uploads/ 目录下
        // 路径：D:\www\htdocs\thinkphp5\public\uploads\20170922\c2557b90746f96f604589c83839b0098.png
        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
        //限制只能上传jpg图片,如果上传的是png,则会报错：文件后缀名不允许
//        $info = $file->validate(['ext'=>'jpg'])->move(ROOT_PATH.'public'.DS.'uploads');
        //生成的路径和文件名：D:\www\htdocs\thinkphp5\public\uploads\c7\51e39e60e437bf2a32a9739af941a4.png
//        $info = $file->rule('md5')->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传路径：D:\www\htdocs\thinkphp5\public\uploads\59c4772e690f3.png
//        $info = $file->rule('uniqid')->move(ROOT_PATH . 'public' . DS . 'uploads');
        //上传保留图片的原名，不重新命名文件，路径有变化：
        //路径：D:\www\htdocs\thinkphp5\public\uploads\weibo.png
        //没有了已时间命名的文件夹
//        $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads','');
        echo "<pre>";
        print_r($info);
        echo "</pre>";
//        echo $info->getRealPath();exit;
        if ($info) {
            echo $info->getRealPath();exit;
            $this->success('文件上传成功：' . $info->getRealPath());
        } else {
        // 上传失败获取错误信息
            $this->error($file->getError());
        }
    }

    //上传多文件
    public function upMore(Request $request) {
        // 获取表单上传文件
        $files = $request->file('image');
        $item = [];
        foreach($files as $file){
// 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $item[] = $info->getRealPath();
            }else{
// 上传失败获取错误信息
                $this->error($file->getError());
            }
        }
//        echo "<pre>";
//        print_r($item);
//        echo "</pre>";exit;
        echo implode('<br/>',$item);
//        $this->success('文件上传成功'.implode('<br/>',$item));
    }

    public function cropAvatar() {
//        echo "<pre>";
//        print_r($_REQUEST);
//        echo "</pre>";exit;
        $crop = new CropAvatar(
            isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
            isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
            isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null
        );

        //强行拼装img路径
        $r = explode('\\',$crop->getResult());
        $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        $u = dirname(dirname(dirname((dirname($url)))));
        $p = $u.'/'.$r[4].'/'.$r[5].'/'.$r[6];
        $response = array(
            'state' => 200,
            'message' => $crop->getMsg(),
//            'result' => $crop->getResult()
            'result' => $p
        );
        echo json_encode($response);
//        return $this->fetch(json_encode($response));
//        echo "<pre>";
//        print_r($response);
//        echo "</pre>";
    }

    public function url() {
        echo ROOT_PATH;
        echo "<pre>";
        print_r($_SERVER);
        echo "</pre>";

        $url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
        echo dirname(dirname(dirname((dirname($url)))));
        echo "<hr>";
        $str = "D:\\www\\htdocs\\thinkphp5\\public\\uploads\\20170928103237.png";
        $r = explode('\\',$str);
        echo "<pre>";
        print_r($r);
        echo "</pre>";
    }

    public function varDefault() {
        $var1 = "This is a variable";
        $html = "<h1>你好！姚明</h1>";
        $this->assign("html",$html);
//        $this->assign("var",$var);
        return $this->fetch('var');
    }

    public function findUser() {
        $userModel = new User();
        $r = $userModel->users();
        $res = User::all();
        $res1 = User::get(2);
//        echo "<pre>";
//        print_r($res1->toArray());//查询单个数据可以使用toArray()
//        echo "</pre>";
//        echo "<hr>";
//        echo "<pre>";
//        print_r($res->toArray());
//        echo "</pre>";
//        echo "Test";
//        echo "<pre>";
//        print_r($r);
//        echo "</pre>";
        //将对象转换成数组 start
//        foreach($r as $v) {
//            $list = $v->toArray();
//            echo "<pre>";
//            print_r($list);
//            echo "</pre>";
//        }
        //将对象转换成数组 end
        $list = User::all();
        if($list) {
            $list = collection($list)->toArray();
        }
//        echo "<pre>";
//        print_r($list);
//        echo "</pre>";
//        echo THINK_VERSION;//查看thinkphp的版本


    }

    public function useModel() {
        $m = model("User");
        $r = $m->users;
//        echo "<pre>";
//        print_r($r);
//        echo "</pre>";
        $arr = array();
        //将对象转换成数组
        foreach($r as $k=>$v) {
//            $arr = $v->toArray();
            array_push($arr,$v->toArray());
        }

        echo "<pre>";
        print_r($arr);
        echo "</pre>";
    }

    //带参数访问
    public function argModel() {
        $m = model("User");
        $r = $m->haveArg("Yaoming");
        echo $r;
    }
}
