<?php
namespace Admin\Controller;
use Components\AdminController;
class AuthMenuController extends AdminController {
    public function showList(){
    	$AuthMenu = D("Authmenu");

        $result = $AuthMenu->getAuthMenuInfo(5);
        $data = $result['data'];
        $pagestr = $result['pagestr'];
        $condtion = $result['condtion'];

        $this->assign("condtion", $condtion);
        $this->assign("data", $data);
        $this->assign("pagestr", $pagestr);

        // 查询父级
        $getPid = $AuthMenu->getPid();
        $this->assign("getPid", $getPid);

        // 获取当前父级
        session("parent", I("parent"));
        $curPid = $AuthMenu->getCurPid();
        $this->assign("curPid", $curPid);

		$this->display();
	}

	public function add(){
        $AuthMenu = D("Authmenu");
        
        if(IS_POST){
            try{
                $addResult = $AuthMenu->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $addResult);
        }

        $getPid = $AuthMenu->getPid();
        $this->assign("getPid", $getPid);
        
        $this->assign('identify', 'add');
		$this->display();
	}

    public function del(){
        $AuthMenu = D("Authmenu");
        if (IS_POST) {
            try{
                $result = $AuthMenu->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function updateSort(){
        $AuthMenu = D("Authmenu");
        if (IS_POST) {
            try{
                $AuthMenu->getUpdateSort();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, '排序成功');
        }else{
            return show(0, '排序失败');
        }
    }

    public function update(){
        $Authmenu=D("Authmenu");
        $auth_id = $_GET['id'];
        if($auth_id == '[object Object]'){
            $this->redirect("Admin/Authmenu/showList");
        }
        // 显示当前的菜单
        $curAuth = $Authmenu->getFindData("auth_id={$auth_id}");
        $this->assign("cur",$curAuth);
        if(IS_POST){
            try{
                $updateResult = $Authmenu->getUpdate($auth_id, $curAuth['auth_name']);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }
        //显示父级ID
        $getPid = $Authmenu->getPid();
        $this->assign("getPid",$getPid);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function showAuthmune(){
        $Authmenu=D("Authmenu");
        if (IS_POST) {
            try{
                $result = $Authmenu->getShowAuthmune();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function hideAuthmune(){
        $Authmenu=D("Authmenu");
        if (IS_POST) {
            try{
                $result = $Authmenu->getHideAuthmune();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }
}