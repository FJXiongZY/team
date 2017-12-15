<?php
namespace Common\Model;
use Think\Model;
class SeoModel extends Model{
    public function getInfo(){
        return $this->where("id=1")->find();
    }

    public function SelectData(){
        return $this->select();
    }

    public function getUpdate(){
        if(I("identify") == 'seo'){
            if(!I("title")){
                E("title不能为空");
            }
            if(!I("keyword")){
                E("关键字不能为空");
            }
            if(!I("describe")){
                E("描述不能为空");
            }
            $data = $this->create();
            if($this->where("id=1")->data($data)->save()){
                return "保存信息成功";
            }else{
                E("操作失败");
            }
        }else{
            $ban = D("Ban");
            $result = $ban->doAdd(session("admin_name"), get_client_ip(), time());
            E("非法操作");
        }  
    }

}