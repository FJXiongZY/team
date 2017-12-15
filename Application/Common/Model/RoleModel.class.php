<?php
namespace Common\Model;
use Think\Model;
class RoleModel extends Model{
	protected $insertFields = array('role_name');

    protected $_map = array(
        'name' =>'role_name'
    );

    public function getFindData($where){
        return $this->where($where)->find();
    }

    public function getFieldSelect($where){
        return $this->field($where)->select();
    }

    public function getRoleInfo($limit){
        $indexpage=I("p",1,"int");
        $data=$this->page($indexpage,$limit)->select();
        $count=$this->count();
        $page=new \Think\Page($count,$limit);

        $page->setConfig('header', '<span>共<b>%TOTAL_ROW%</b>条记录 第<b>%NOW_PAGE%</b>页/共<b>%TOTAL_PAGE%</b>页</span>');
        $page->setConfig('first','【首页】');
        $page->setConfig('last','【末页】');
        $page->setConfig('prev','【上一页】');
        $page->setConfig('next','【下一页】');
        $page->setConfig('theme','共 %TOTAL_ROW% 条记录 当前是%NOW_PAGE%/%TOTAL_PAGE% %FIRST%  %UP_PAGE% %LINK_PAGE%   %DOWN_PAGE%   %END%');
        $page->lastSuffix = false;//最后一页不显示为总页数
        $pagestr=$page->show();

        return array("data"=>$data, "pagestr"=>$pagestr);
    }

    public function getAdd(){
        $Authmenu = M("Authmenu");
        $name = I('name');
        if(I("identify") == "roleAdd"){
            if (!trim($name)) {
                E("角色名不能为空");
            }else{
                $Findinfo = $this->where(array("role_name"=>$name))->find();
                if($Findinfo){
                    E('角色名已存在');
                }
                $auth_ids = implode(",", $_POST["auth"]);
                $cur_authInfo=$Authmenu->select($auth_ids);
                $array=array();
                foreach ($cur_authInfo as $key) {
                    if(empty($key["auth_c"]) || empty($key["auth_a"]))
                        continue;;
                    $array[]=$key["auth_c"].'-'.$key["auth_a"];
                }
                $role_auth_ac=join(",",$array);
                $data=$this->create(I('post.'),1);
                $data['role_name']=$name;
                $data['role_auth_ids']=$auth_ids;
                $data['role_auth_ac']=$role_auth_ac;
                if ($this->add($data)) {
                    return "添加成功!";
                }else{
                    E('添加失败');
                }
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E("非法操作");
        }
    }

    public function getDel(){
        foreach ($_POST as $key) {
            $resultInfo = D("role")->delete($key);
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

    public function getUpdate($id, $curName){
        $Authmenu = M("Authmenu");
        $name = I("name");
        if(I("identify") == "update"){
            if (!trim($name)) {
                E("角色名不能为空");
            }
            if($name != $curName){
                $Findinfo = $this->where(array("role_name"=>$name))->find();
                if($Findinfo){
                    E('角色名已存在');
                }
            }
            $auth_ids = implode(",", I("auth"));
            $cur_authInfo=$Authmenu->select($auth_ids);
            $array=array();
            foreach ($cur_authInfo as $key) {
                if(empty($key["auth_c"]) || empty($key["auth_a"]))
                    continue;;
                $array[]=$key["auth_c"].'-'.$key["auth_a"];
            }
            $role_auth_ac=join(",",$array);
            $data['role_id']=$id;
            $data['role_name']=$name;
            $data['role_auth_ids']=$auth_ids;
            $data['role_auth_ac']=$role_auth_ac;
            if($this->save($data)){
                return "编辑成功!";
            }else{
                E("编辑失败!");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E("非法操作");
        }    
    }

}