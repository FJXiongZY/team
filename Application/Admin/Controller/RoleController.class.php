<?php
namespace Admin\Controller;
use Components\AdminController;
class RoleController extends AdminController {
    public function showList(){
    	$role = D("Role");
        $AuthMenu = D("Authmenu");
    	$result = $role->getRoleInfo(8);
    	$data = $result['data'];
    	$pagestr = $result['pagestr'];

    	$this->assign("data", $data);
    	$this->assign("pagestr", $pagestr);

        //获取当前父级
        session("parent", I("parent"));
        $curPid = $AuthMenu->getCurPid();
        $this->assign("curPid", $curPid);

		$this->display();
	}

	public function add(){
        $role = D("Role");
        $Authmenu = D("Authmenu");

        //获取所有信息
        $AuthmenuInfo = $Authmenu->getAllAuthmenu();
        $this->assign("authParent", $AuthmenuInfo['authParent']);
        $this->assign("authSon", $AuthmenuInfo['authSon']);

        if(IS_POST){
            try{
                $addResult = $role->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $addResult);
        }

        $this->assign('identify', 'roleAdd');

		$this->display();
	}

    public function update(){
        $role = D("Role");
        $Authmenu = D("Authmenu");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Role/showList");
        }
        // 显示当前信息
        $cur = $role->getFindData("role_id={$id}");
        $this->assign("cur",$cur);

        if(IS_POST){
            try{
                $updateResult = $role->getUpdate($id, $cur['role_name']);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }

        //获取所有信息
        $AuthmenuInfo = $Authmenu->getAllAuthmenu();
        $this->assign("authParent", $AuthmenuInfo['authParent']);
        $this->assign("authSon", $AuthmenuInfo['authSon']);

        $auth_ids=$cur['role_auth_ids'];
        $auth_ids_array=explode(",",$auth_ids);
        $this->assign("auth_ids_array",$auth_ids_array);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $role = D("Role");
        if (IS_POST) {
            try{
                $result = $role->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }
}