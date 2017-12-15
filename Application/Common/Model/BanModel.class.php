<?php
namespace Common\Model;
use Think\Model;
class BanModel extends Model{
    protected $insertFields = array("name", "ip", "time");

    public function doAdd($name, $ip, $time){
        if (!empty($name) || isset($name)) {
            $data['name'] = $name;
        }else{
            $data['name'] = 1;
        }
        $data['ip'] = $ip;
        $data['time'] = $time;
        $this->add($data);

        if(!empty($name) || isset($name)){
            $Administrator=D("Administrator");
            $userData['admin_status'] = 2;
            $Administrator->where(array("name"=>$name))->save($userData);
            session(null); 
        }
    }

    public function getInfo($limit){
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

}