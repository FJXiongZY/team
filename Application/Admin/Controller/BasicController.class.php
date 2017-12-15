<?php
namespace Admin\Controller;
use Components\AdminController;
class BasicController extends AdminController {
    public function seo(){
    	$seo = D("Seo");
    	$seoInfo = $seo->getInfo();
    	$this->assign("seoInfo", $seoInfo);

    	if(IS_POST){
    		try{
    			$result = $seo->getUpdate();
    		}catch(\Exception $e){
    			return show(0, $e->getMessage());
    		}
    		return show(1, $result);
    	}

    	$this->assign("identify", "seo");

		$this->display();
	}

	public function index(){
		$this->display();
	}

    public function showPuppet(){
        $ban = D("Ban");
        $result = $ban->getInfo(10);
        $this->assign("data", $result['data']);
        $this->assign("pagestr", $result['pagestr']);
        $this->display();
    }

	public function showLoginUser(){
        $session = D('starmoon_session');
		$Administrator = D('Administrator');
        
		$where = array('session_expire'=>array('gt',NOW_TIME),'session_data'=>array('neq',''));
		$inline = $session->where($where)->count();
        $this->assign("inline", $inline);

		$array = $Administrator->getSessionInfo($where);
        $this->assign("array", $array);
        $this->display();
	}

}