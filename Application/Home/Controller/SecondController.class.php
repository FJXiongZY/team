<?php
namespace Home\Controller;
use Components\HomeController;
class SecondController extends HomeController {
    public function index(){
        $auth = D("Authmenu");
        $pid = $auth->getfrontPid()['auth_id'];
        $parentInfo = $auth->getWhereSelect(array("auth_class"=>$pid,"auth_category"=>2,"auth_level"=>0))[0];
        $sonInfo = $auth->getWhereSelect(array("auth_class"=>$pid,"auth_category"=>2,"auth_level"=>1));
        $this->assign("parentInfo", $parentInfo);
        $this->assign("sonInfo", $sonInfo);

        $id = $auth->where(array("auth_pid"=>$pid,"auth_a"=>I("gbrk"),"auth_category"=>2,"auth_level"=>1))->field("auth_id")->find()['auth_id'];
        $module = $auth->where("auth_pid=$pid")->field("auth_c")->find()['auth_c'];

        $data = D($module)->where(array("parent"=>$id, "status"=>1))->field("title,content,createTime,count")->find();
        $this->assign("data", $data);

        if(!cookie($id)){
            $count=D($module)->where("parent=".$id)->setInc("count",1);
            cookie($id,$count,60);
        }

        $auth_a = I("gbrk");
        $this->assign("gbrkName", $auth_a);

    	$this->display();
    }
}