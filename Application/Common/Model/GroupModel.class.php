<?php
namespace Common\Model;
use Think\Model;
class GroupModel extends Model{
    protected $_map = array(
        'group_id' => 'id',
        "group_title"  => 'title',
        'group_createTime' => 'createTime',
        'group_count' => 'count',
        'editorValue' => 'content',
        'group_status' => 'status',
        'group_parent' => 'parent'
    );

    protected $insertFields = array("title", "parent", "content");

    public function getFindData($where){
        return $this->where($where)->find();
    }

    public function getGroupParent(){
        $md5Pid = session("parent");
        $sublen = strlen($md5Pid);
        $pidLen = substr($md5Pid, $sublen-1);
        $pid = substr($md5Pid, $sublen-$pidLen-1, $pidLen);
        return M("Authmenu")->where("auth_pid={$pid} and auth_level=1 and auth_category=2")->select();
    }

    public function getPagesInfo($limit){
        $indexpage=I("p",1,"int");
        if(I('group_status',1)){
            $condtion['status']=I("group_status",1);
        }
        if(I('group_parent')){
            $condtion['parent']=I("group_parent");
        }
        if(I('group_title')){
            $condtion['title']=array("like","%".trim(I('group_title'))."%");
        }
        if ($condtion) {
            $data=$this->where($condtion)->page($indexpage,$limit)->select();
        }else{
            $data=$this->page($indexpage,$limit)->select();
        }
        $count=$this->where($condtion)->count();
        $page=new \Think\Page($count,$limit);
        //分页跳转的时候保证查询条件
        if(I('group_status',1)){
            $condtion['status']=I("group_status",1);
        }
        if(!I('group_parent')){
            $condtion['parent']=null;
        }
        if(I('group_parent')){
            $condtion['parent']=I("group_parent");
        }
        if(I('group_title')){
            $condtion['title']=array("like","%".trim(I('group_title'))."%");
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
            if(!trim(I('group_title'))) {
                E("标题不能为空");
            }
            if(!I('group_parent')) {
                E("请选择父级");
            }
            $data=$this->create(I('post.'),1);
            if($id=$this->add($data)){
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
            E("非法操作");
        }
    }

    public function getUpdate($id){
        if(I("identify") == 'update'){
            if(!trim(I('group_title'))) {
                E("标题不能为空");
            }
            if(!I('group_parent')) {
                E("请选择父级");
            }
            $data = $this->create();
            $data['id'] = $id;
            if($this->save($data)){
                return "编辑成功！";
            }else{
                E("编辑失败！");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E("非法操作");
        }
    }

    public function getDel(){
        foreach ($_POST as $key) {
            $resultInfo = $this->delete($key);
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

    public function getToLine(){
        foreach ($_POST as $value) {
            $data['status'] = 1;
            $resultInfo = $this->where("id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "上线成功";
        }else{
            E('上线错误,错误ID:'.implode($array, ","));
        }
    }

    public function getOffLine(){
        foreach ($_POST as $value) {
            $data['status'] = 2;
            $resultInfo = $this->where("id={$value}")->save($data);
            if($resultInfo === false){
                $array[] = $value;
            }
        }
        if(empty($array[0]) || !isset($array[0])){
            return "下线成功";
        }else{
            E('下线错误,错误ID:'.implode($array, ","));
        }
    }

}