<?php
namespace Common\Model;
use Think\Model;
class AdministratorModel extends Model{
    protected $_map = array(
        'admin_id' => 'id',
        'admin_name' => 'name',
        "admin_password"  => 'password',
        'roleId' => 'role_id',
        'status' => 'admin_status',
        'admin_phone' =>    'phone',
        'admin_weChat'  =>  'weChat',
        'admin_email'   =>  'email',
        'admin_sex' =>  'male',
        'uploadPic' =>  'userPic'
    );

	protected $insertFields = array('name', 'password', 'role_id', 'email', 'phone', 'userPic', 'admin_status', 'weChat', 'male');

    public function getFindData($id){
        return $this->field("name, password, role_id")->where(array("id" => $id))->find();
    }

    public function getCurInfo(){
        $admin_id = session("admin_id");
        return $this->where("id=$admin_id")->find();
    }

    public function getSessionInfo($where){
        $session = M("starmoon_session");
        $data = $session->where($where)->select();
        foreach ($data as $key => $value) {
            $vars = preg_split(  
                '/([a-zA-Z_\x7f-\xff][a-zA-Z0-9_\x7f-\xff]*)\|/',  
                $value['session_data'], -1, PREG_SPLIT_NO_EMPTY |  
                PREG_SPLIT_DELIM_CAPTURE);  
            for ($i = 0; isset($vars[$i]); $i++) {  
                $result[$vars[$i++]] = unserialize($vars[$i]);  
            }
            $array[] = $result;
        }
        return $array;
    }

    public function getAdminLoginInfo(){
        $admin_id = session("admin_id");
        $ad_login_info = M("ad_login_info");
        return $ad_login_info->order("id desc")->where("admin_id=$admin_id")->select();
    }

    public function getAdministratorInfo($limit){
        $indexpage=I("p",1,"int");
        if(I('status')){
            $condtion['admin_status']=trim(I('status'));
        }
        if(I('admin_name')){
            $condtion['name']=array("like","%".trim(I('admin_name'))."%");
        }
        if ($condtion) {
            $data=$this->where($condtion)->where("name != 'root'")->page($indexpage,$limit)->select();
        }else{
            $data=$this->page($indexpage,$limit)->where("name != 'root'")->select();
        }
        $count=$this->where($condtion)->count();
        $page=new \Think\Page($count-1,$limit);
        //分页跳转的时候保证查询条件
        if(I('status')){
            $condtion['status']=trim(I('status'));
        }
        if(I('admin_name')){
            $condtion['name']=trim(I('admin_name'));
        }
        foreach($condtion as $key=>$val) {
            $page->parameter[$key]=$val;
        }

        $page->setConfig('header', '<span>共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</span>');
        $page->setConfig('first','【首页】');
        $page->setConfig('last','【末页】');
        $page->setConfig('prev','【上一页】');
        $page->setConfig('next','【下一页】');
        $page->setConfig('theme','共 %TOTAL_ROW% 条记录 当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST%  %UP_PAGE% %LINK_PAGE%   %DOWN_PAGE%   %END%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $pagestr=$page->show();

        return array("data"=>$data, "pagestr"=>$pagestr, "condtion"=>$condtion);
    }

    public function getAdd(){
        if(I("identify") == 'add'){
            $admin_name = I('admin_name');
            $admin_password = I("admin_password");
            if (!trim($admin_name)) {
                E('用户名不能为空');
            }
            if (!trim($admin_password)) {
                E('密码不能为空');
            }
            if (!trim(I('roleId'))) {
                E('非法操作');
            }
            $Findinfo = $this->where(array("name"=>$admin_name))->find();
            if($Findinfo){
                E('用户名已存在');
            }
            $data=$this->create(I('post.'),1);   // 1 指定这是添加的功能
            if($id=$this->add($data)){
                $data['password'] = md5(md5($admin_password)."!#%&%&#$ASDA.15%^*465435(&*(");
                $data['createTime'] = time();
                $data['id']=$id;
                if($this->save($data)){
                    return "添加成功！";
                }else{
                    E("添加失败！");
                }
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E('非法操作');
        }
    }

    public function getUpdate($id, $name, $password){
        if(empty($id) || !isset($id)){
            E("非法ID");
        }
        if(I("identify") == 'update'){
            $admin_name = I('admin_name');
            $admin_password = I("admin_password");
            if (!trim($admin_name)) {
                E('用户名不能为空');
            }
            if (!trim($admin_password)) {
                E('密码不能为空');
            }
            if (!trim(I('roleId'))) {
                E('非法操作');
            }
            if($name != $admin_name){
                $Findinfo = $this->where(array("name"=>$admin_name))->find();
                if($Findinfo){
                    E('用户名已存在');
                }
            }
            $data=$this->create();
            if($admin_password != $password){
                $data['password'] = md5(md5($admin_password)."!#%&%&#$ASDA.15%^*465435(&*(");
            }
            $data['updateTime'] = time();
            $data['id']=$id;
            if($this->save($data)){
                return "编辑成功！";
            }else{
                E("编辑失败！");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E('非法操作');
        }
    }

    public function getDel(){
        $Administrator = D("Administrator");
        foreach ($_POST as $key) {
            $picUrl = $Administrator->where("id=$key")->field("userPic")->find()['userPic'];
            if($picUrl != "asaf45f4aw5f.jpg"){
                unlink("./Uploads/userPic/$picUrl");
            }
            $resultInfo = $Administrator->delete($key);
            if(empty($resultInfo) || !isset($resultInfo)){
                $array[] = $key;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "删除成功";
        }else{
            E('删除错误,错误ID:'.implode($array, ","));
        }
    }

    public function getSeal(){
        foreach ($_POST as $value) {
            $data['admin_status'] = 2;
            $resultInfo = $this->where("id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "封印成功";
        }else{
            E('封印错误,错误ID:'.implode($array, ","));
        }
    }

    public function getDeblocking(){
        foreach ($_POST as $value) {
            $data['admin_status'] = 1;
            $resultInfo = $this->where("id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "解封成功";
        }else{
            E('解封错误,错误ID:'.implode($array, ","));
        }
    }

    public function getFindtUser(){
        $admin_name = I('admin_name');
        $cur = $this->where(array("name" => $admin_name))->find();
        if ($cur) {
            $curUserPic= $cur['userPic'];
            return array("message" => '接收成功', "data" => $curUserPic);
        }else{
            E('用户名不存在');
        }
    }

    public function getSeeCur($id, $limit){
        $ad_login_info = M("ad_login_info");
        $curUserInfo = $this->where("id=$id")->find();

        $indexpage=I("p",1,"int");
        $data=$ad_login_info->page($indexpage,$limit)->where("admin_id=$id")->select();
        $count=$ad_login_info->where("admin_id=$id")->count();
        $page=new \Think\Page($count,$limit);

        $page->setConfig('header', '<span>共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</span>');
        $page->setConfig('first','【首页】');
        $page->setConfig('last','【末页】');
        $page->setConfig('prev','【上一页】');
        $page->setConfig('next','【下一页】');
        $page->setConfig('theme','共 %TOTAL_ROW% 条记录 当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST%  %UP_PAGE% %LINK_PAGE%   %DOWN_PAGE%   %END%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $pagestr=$page->show();

        return array("curUserInfo"=>$curUserInfo, "data"=>$data, "pagestr"=>$pagestr);
    }

    public function getLogin(){
        if(I("identify") == 'login'){
            $session = D('starmoon_session');
            $adLofinInfo = D('ad_login_info');
            $admin_name = I('admin_name');
            $admin_password = I('admin_password');
            $admin_password = md5(md5($admin_password)."!#%&%&#$ASDA.15%^*465435(&*(");
            if (empty($admin_name) || !isset($admin_name)) {
                E('用户名不能为空');
            }
            if (empty($admin_name) || !isset($admin_name)) {
                E('密码不能为空');
            }
            $userStatus = $this->where(array("name" => $admin_name))->field("admin_status")->find();
            if($userStatus['admin_status'] == "2"){
                E("用户已查封");
            }
            $array = $this->getSessionInfo();
            foreach ($array as $key => $value) {
                if ($value['admin_name'] == $admin_name) {
                    E('当前用户已登录');
                }
            }
            $passwordArray = array(
                "name"=>$admin_name,
                "password"=>$admin_password
            );
            $logInfo = $this->where($passwordArray)->find();
            if ($logInfo) {
                $ip=get_client_ip();
                $admin_name = $logInfo["name"];
                $admin_id = $logInfo["id"];
                $admin_time = strval(time());
                session("admin_id",$admin_id);
                session("admin_name", $admin_name);
                session("userPic", $logInfo["userPic"]);
                session("admin_ip", $ip);
                session("admin_logTime", $admin_time);
                $data['admin_id'] = $admin_id;
                $data['admin_name'] = $admin_name;
                $data['admin_loginTime'] = $admin_time;
                $data['admin_loginIp'] = $ip;
                $data['id']=$adLofinInfo_id;
                if($adLofinInfo->data($data)->add()){
                    $this->where(array('id' => $admin_id))->setInc("count",1);
                    return "登录成功！";
                }else{
                    E("意外错误, 请重新登录");
                }
            }else{
                E("您的账号或密码错误");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E("非法操作");
        }  
    }

    public function getUpdateCurUserInfo($id, $name, $password){
        if(empty($id) || !isset($id)){
            E("非法ID");
        }
        if(I("identify") == 'updateCurUserInfo'){
            $admin_password = I("admin_password");
            $admin_phone = I("admin_phone");
            $admin_email = I("admin_email");
            if (trim(I('admin_name')) || trim(I("name"))) {
                $ban = D("Ban");
                $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
                E('非法操作');
            }
            if (trim(I('roleId')) || trim(I("role_id"))) {
                $ban = D("Ban");
                $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
                E('非法操作');
            }
            if (!trim($admin_password)) {
                E('密码不能为空');
            }
            if ($admin_password != I("admin_passwordTow")) {
                E('两次密码不匹配');
            }
            if ($admin_email) {
                if (preg_match("/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,})$/",$admin_email) == false) {
                    E("邮箱格式不正确");
                }
            }
            if ($admin_phone) {
                if (preg_match('/^1[34578]{1}\d{9}$/', $admin_phone) == false) {
                    E("手机格式不正确");
                }
            }
            if(I("admin_weChat")){
                if(preg_match('/[\x{4e00}-\x{9fa5}]/u', $str)){
                    E("微信号不能含有中文");
                }
            }
            $data=$this->create();
            if($admin_password != $password){
                $data['password'] = md5(md5($admin_password)."!#%&%&#$ASDA.15%^*465435(&*(");
            }
            $data['updateTime'] = time();
            $data['id']=$id;
            if($this->save($data)){
                return "编辑成功！";
            }else{
                E("编辑失败！");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E('非法操作');
        }
    }

    public function getUploadify(){
        $config = array(
            'maxSize'    =>    3145728,
            'rootPath'      =>  "./Uploads/zeroPic/", //保存根路径
            'savePath'   =>    '',
            'saveName'   =>    array('uniqid',''),
            'exts'       =>    array('jpg', 'gif', 'png', 'jpeg'),
            'autoSub'    =>    false,
            'subName'    =>    array('date','Ymd'),
        );
        $upload = new \Think\Upload($config);
        $images = $upload->upload();
        if(!$images){
            E("上传失败");
        }else{
            $info = $images['uploadPic']['savePath'].$images['uploadPic']['savename'];
            $img = "./Uploads/zeroPic/".$info;//获取文件上传目录
            $image = new \Think\Image(); 
            $image->open($img);
            $image->thumb(300, 300,\Think\Image::IMAGE_THUMB_FILLED)->save("./Uploads/zeroPic/".$info);
            return $img;
        }
    }

    public function getUploadifyCrop($path, $w, $h, $x, $y){
        $basePath = basename($path);
        $sessionPic = session("userPic");
        $image = new \Think\Image();
        $image->open($path);
        $image->crop($w, $h, $x, $y)->save('./Uploads/userPic/'.$basePath);
        if($basePath != "asaf45f4aw5f.jpg"){
            unlink("./Uploads/userPic/$sessionPic");  //删除用户原来的图片
            unlink($path);  //删除零时文件夹中的图片
        }else{
            unlink($path);  //删除零时文件夹中的图片
        }

        if($this->where(array("id"=>session("admin_id")))->data("userPic=$basePath")->save()){
            session("userPic", $basePath);
            return "上传成功";
        }else{
            E("上传失败");
        }   
    }
}