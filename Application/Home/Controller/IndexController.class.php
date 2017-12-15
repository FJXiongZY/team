<?php
namespace Home\Controller;
use Components\HomeController;
class IndexController extends HomeController {
    public function index($type=''){
    	$auth = D("Authmenu");
    	//内容
    	$array = $auth->getfrontContent();
    	$this->assign("parentInfo", $array['parent']);
    	$this->assign("sonInfo", $array['son']);

    	//大图信息
    	$big = D("Big");
    	$data = $big->getfrontBigInfo();
    	$this->assign("bigData", $data);

    	if($type == 'buildHtml'){
            $this->buildHtml('index',HTML_PATH,'Index/index');
        }else{
            $this->display();
        }
    }

    public function build_html(){
        $this->index('buildHtml');
        return show(1,"更新缓存成功");
    }
}