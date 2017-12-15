<?php
namespace Admin\Controller;
use Components\AdminController;
class AdministratorController extends AdminController {
    public function showList(){
        $Administrator = D("Administrator");
    	$Authmenu = D("Authmenu");
    	$result = $Administrator->getAdministratorInfo(8);
    	$data = $result['data'];
    	$pagestr = $result['pagestr'];
    	$condtion = $result['condtion'];

    	$this->assign("data", $data);
    	$this->assign("pagestr", $pagestr);
    	$this->assign("condtion", $condtion);

        //获取当前父级
        session("parent", I("parent"));
        $curPid = $Authmenu->getCurPid();
        $this->assign("curPid", $curPid);

		$this->display();
	}

	public function add(){
        $Administrator = D("Administrator");
        $Role = D("Role");
        //获取角色
        $roleInfo = $Role->getFieldSelect(array("role_id, role_name"));
        $this->assign("roleInfo", $roleInfo);

        if(IS_POST){
            try{
                $addResult = $Administrator->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $addResult);
        }

        $this->assign("identify", "add");

		$this->display();
	}

    public function update(){
        $Administrator=D("Administrator");
        $Role = D("Role");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Administrator/showList");
        }
        // 显示当前的菜单
        $cur = $Administrator->getFindData($id);
        $this->assign("cur",$cur);

        //获取角色
        $roleInfo = $Role->getFieldSelect(array("role_id, role_name"));
        $this->assign("roleInfo", $roleInfo);

        if(IS_POST){
            try{
                $updateResult = $Administrator->getUpdate($id, $cur['name'], $cur['password']);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $Administrator=D("Administrator");
        if (IS_POST) {
            try{
                $result = $Administrator->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function seal(){
        $Administrator=D("Administrator");
        if (IS_POST) {
            try{
                $result = $Administrator->getSeal();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function deblocking(){
        $Administrator=D("Administrator");
        if (IS_POST) {
            try{
                $result = $Administrator->getDeblocking();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function particular(){
        $Administrator=D("Administrator");
        $id = $_GET['admin_id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Administrator/showList");
        }
        $cur = $Administrator->getSeeCur($id, 5);
        $this->assign("cur", $cur['curUserInfo']);
        $this->assign("loginInfo", $cur['data']);
        $this->assign("pagestr", $cur['pagestr']);

        $this->display();
    }

    public function AdministratorInfo(){
        $Administrator=D("Administrator");
        $id = session("admin_id");

        $cur = $Administrator->getCurInfo();
        $this->assign("cur", $cur);

        if(IS_POST){
            try{
                $updateResult = $Administrator->getUpdateCurUserInfo($id, $cur['name'], $cur['password']);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }

        $adminUserLoginInfo = $Administrator->getAdminLoginInfo();
        $this->assign("curLoginInfo", $adminUserLoginInfo);

        $this->assign("identify", "updateCurUserInfo");
        $this->display();
    }

    public function uploadify(){
        if(!empty($_FILES)){
            $Administrator=D("Administrator");
            try{
                $uploadResult = $Administrator->getUploadify();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, "上传成功", $uploadResult);
        }else{
            return show(0, "上传失败");
        }
    }

    public function doUploadifyCrop(){
        if(IS_POST){
            $Administrator=D("Administrator");
            try{
                $uploadResult = $Administrator->getUploadifyCrop(I("picPath"), I("w"), I("h"), I("x"), I("y"));
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, "上传成功", $uploadResult);
        }else{
            return show(0, "上传失败");
        }
    }
}