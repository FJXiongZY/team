<?php
namespace Common\Model;
use Think\Model;
class AuthMenuModel extends Model{
    protected $_map = array(
        'name' => 'auth_name',
        "parentId"  => 'auth_pid',
        'control' => 'auth_c',
        'action' => 'auth_a',
        'sortId' => 'sort_id',
        'status' => 'auth_status',
        'class' => 'auth_class',
        'icon' => 'auth_icon',
        'Classification' => 'auth_category'
    );

    protected $insertFields = array('auth_name', 'auth_pid', 'auth_c', 'auth_a', 'sort_id', 'auth_status', 'auth_icon', 'auth_category');

    public function getFindData($where){
        return $this->where($where)->find();
    }

    public function getWhereSelect($where){
        return $this->where($where)->select();
    }

    public function getFrontmenuParent(){
        return $this->where("auth_category=2 and auth_level=0")->select();
    }

    public function getfrontContent(){
        $parent = $this->where("auth_category=2 and auth_level=0")->select();
        $son = $this->where("auth_category=2 and auth_level=1")->select();
        return array("parent"=>$parent, "son"=>$son);
    }

    public function getClassification(){
        return $this->field("auth_category")->select();
    }

    public function getAllAuthmenu(){
        $authParent = $this->where("auth_level=0")->field("auth_id,auth_name")->select();
        $authSon = $this->where("auth_level=1 and auth_category=1")->field("auth_id,auth_name,auth_pid")->order("sort_id asc")->select();
        return array("authParent"=>$authParent, "authSon"=>$authSon);
    }

    public function getPid(){
        return $this->where("auth_level=0")->field("auth_id,auth_name")->select();
    }

    public function getCurPid(){
        $md5Pid = session("parent");
        $sublen = strlen($md5Pid);
        $pidLen = substr($md5Pid, $sublen-1);
        $pid = substr($md5Pid, $sublen-$pidLen-1, $pidLen);
        return $this->where("auth_id=$pid")->field("auth_id")->find();
    }

    public function getfrontPid(){
        $md5Pid = I("name");
        $sublen = strlen($md5Pid);
        $pidLen = substr($md5Pid, $sublen-1);
        $pid = substr($md5Pid, $sublen-$pidLen-1, $pidLen);
        return $this->where("auth_id=$pid")->field("auth_id")->find();
    }

    public function getDel(){
        foreach ($_POST as $key) {
            $resultInfo = D("Authmenu")->delete($key);
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

    public function getAuthMenuInfo($limit){
        $indexpage=I("p",1,"int");
        if(I('class')){
            $condtion['auth_class']=I("class");
        }
        if(I('name')){
            $condtion['auth_name']=array("like","%".trim(I('name'))."%");
        }
        if ($condtion) {
            $data=$this->where($condtion)->order(array("auth_level asc", "sort_id asc",'auth_id asc'))->page($indexpage,$limit)->select();
        }else{
            $data=$this->order(array("auth_level asc", "sort_id asc",'auth_id asc'))->page($indexpage,$limit)->select();
        }
        $count=$this->where($condtion)->count();
        $page=new \Think\Page($count,$limit);
        //分页跳转的时候保证查询条件
        if(!I('class')){
            $condtion['auth_class'] = null;
        }
        if(I('class')){
            $condtion['auth_class']=trim(I('class'));
        }
        if(I('name')){
            $condtion['auth_name']=array("like","%".trim(I('name'))."%");
        }
        foreach($_POST as $key=>$val) {
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
            if (!trim(I('name'))) {
                E('菜单名不能为空');
            }
            $Findinfo = $this->where(array("auth_name"=>I("name")))->find();
            if($Findinfo){
                E('菜单名已存在');
            }
            $data=$this->create(I('post.'),1);   // 1 指定这是添加的功能
            $data['auth_path']='';
            $data['auth_level']=0;
            if($auth_id=$this->add($data)){
                if($data['auth_category'] == 1){
                    if($data['auth_pid']==0){
                        $data['auth_c']="";
                        $data['auth_a']="";
                        $data['auth_path']=$auth_id;
                        $data['auth_class']=$auth_id;
                        $data['auth_level']=0;
                    }else{
                        $data['auth_path']=$data['auth_pid'].'-'.$auth_id;
                        $data['auth_class']=$data['auth_pid'];
                        $data['auth_level']=1;
                    }
                }else{
                    if($data['auth_pid']==0){
                        $data['auth_path']=$auth_id;
                        $data['auth_class']=$auth_id;
                        $data['auth_level']=0;
                    }else{
                        $data['auth_path']=$data['auth_pid'].'-'.$auth_id;
                        $data['auth_class']=$data['auth_pid'];
                        $data['auth_level']=1;
                    }
                }
                $data['auth_id']=$auth_id;
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

    public function getUpdateSort(){
        if (!$_POST) {
            E("参数错误");
        }
        foreach ($_POST as $key=>$value) {
            if (!is_numeric($key) || !isset($key)) {
                E("ID不合法");
            }
            if (!is_numeric($value) || !isset($value)) {
                E("排序的ID不合法");
            }
            $data['sort_id'] = $value;
            $this->where("auth_id={$key}")->save($data);
        }
        
    }

    public function getUpdate($auth_id, $auth_name){
        if(empty($auth_id) || !isset($auth_id)){
            E("非法ID");
        }
        if(I("identify") == 'update'){
            $name = I("name");
            if (!trim($name)) {
                E('菜单名不能为空');
            }
            if($name != $auth_name){
                $Findinfo = $this->where(array("auth_name"=>$name))->find();
                if($Findinfo){
                    E('菜单名已存在');
                }
            }
            $data=$this->create();
            if($data['auth_category'] == 1){
                if($data['auth_pid']==0){
                    $data['auth_c']="";
                    $data['auth_a']="";
                    $data['auth_path']=$auth_id;
                    $data['auth_class']=$auth_id;
                    $data['auth_level']=0;
                }else{
                    $data['auth_path']=$data['auth_pid'].'-'.$auth_id;
                    $data['auth_class']=$data['auth_pid'];
                    $data['auth_level']=1;
                }
            }else{
                if($data['auth_pid']==0){
                    $data['auth_path']=$auth_id;
                    $data['auth_class']=$auth_id;
                    $data['auth_level']=0;
                }else{
                    $data['auth_path']=$data['auth_pid'].'-'.$auth_id;
                    $data['auth_class']=$data['auth_pid'];
                    $data['auth_level']=1;
                }
            }
            $data['auth_id']=$auth_id;
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

    public function getShowAuthmune(){
        foreach ($_POST as $value) {
            $data['auth_status'] = 1;
            $resultInfo = $this->where("auth_id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "展示成功";
        }else{
            E('展示错误,错误ID:'.implode($array, ","));
        }
    }

    public function getHideAuthmune(){
        foreach ($_POST as $value) {
            $data['auth_status'] = 0;
            $resultInfo = $this->where("auth_id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "隐藏成功";
        }else{
            E('隐藏错误,错误ID:'.implode($array, ","));
        }
    }

}