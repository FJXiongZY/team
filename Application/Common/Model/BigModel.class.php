<?php
namespace Common\Model;
use Think\Model;
class BigModel extends Model{
    protected $_map = array(
        'name' => 'big_name',
        'pic' => 'big_pic',
        'describe' => 'big_describe',
        'status' => 'big_status',
    );
    protected $insertFields = array('big_name', 'big_pic', 'big_describe');

    public function getInfo(){
        if(I('status',1)){
            $condtion['big_status']=I("status",1);
        }
        $data=$this->where($condtion)->order("sort_id desc")->select();
        return array("condtion"=>$condtion, "data"=>$data);
    }

    public function getfrontBigInfo(){
        return $this->where("big_status=1")->order("sort_id desc")->select();
    }

    public function getFindData($id){
        return $this->where("big_id=$id")->find();
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
            return $img;
        }
    }

    public function getAdd(){
        if(I("identify") == 'add'){
            $pic = I("pic");
            $basename = basename($pic);
            if(!trim(I('name'))) {
                E("标题不能为空");
            }
            if(!$pic) {
                E("图片不能为空");
            }
            if(!trim(I('describe'))) {
                E("描述不能为空");
            }
            $data=$this->create(I('post.'),1);
            if($id=$this->add($data)){
                $data['big_pic'] = $basename;
                $data['big_id']=$id;
                if($this->save($data)){
                    rename($pic, "./Uploads/BigPic/$basename");
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

    public function getUpdate($id, $curPic){
        if(I("identify") == 'update'){
            $pic = I("pic");
            $basename = basename($pic);
            if(!trim(I('name'))) {
                E("标题不能为空");
            }
            if(!$pic) {
                E("图片不能为空");
            }
            if(!trim(I('describe'))) {
                E("描述不能为空");
            }
            $data = $this->create();
            if($curPic != $pic){
                $data['big_pic'] = $basename;
                rename($pic, "./Uploads/BigPic/$basename"); 
            }
            $data['big_id'] = $id;
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
            $picUrl = $this->where("big_id=$key")->field("big_pic")->find()['big_pic'];
            unlink("./Uploads/BigPic/$picUrl");
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
            $data['big_status'] = 1;
            $resultInfo = $this->where("big_id={$value}")->save($data);
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
            $data['big_status'] = 2;
            $resultInfo = $this->where("big_id={$value}")->save($data);
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
            $this->where("big_id={$key}")->save($data);
        }
    }
}