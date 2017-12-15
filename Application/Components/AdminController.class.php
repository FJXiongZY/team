<?php
namespace Components;
use Think\Controller;
class AdminController extends Controller {
    function __construct(){
    	parent::__construct();
        $Administrator = D("Administrator");
        $Authmenu = D("Authmenu");
        $Role = D("Role");
    	$ban = D("Ban");

    	$admin_id = session("admin_id");
        $curUserId = $Administrator->where("id='$admin_id'")->find();
        $curRoleId = $curUserId['role_id'];                             //获取当前用户的角色id
        $curRoleInfo = $Role->where("role_id='$curRoleId'")->find();    //查询当前角色的信息
        $curRole_ids = $curRoleInfo['role_auth_ids'];                   //获取当前角色的 ids
        $curRole_ac = $curRoleInfo['role_auth_ac'];                   //获取当前角色的 权限集合

        if($curRoleId==0){
            $info1=$Authmenu->where("auth_level=0")->order("sort_id asc")->select();
            $info2=$Authmenu->where("auth_level=1 and auth_status=1 and auth_category=1")->order("sort_id asc")->select();
            $info3 = $Authmenu->where("auth_level=1 and auth_category=1 and ( auth_name like '%列表%')")->field("auth_id")->select();
            $info4 = $Authmenu->where("auth_level=1 and auth_category=1")->select();
        }else{
            $info1=$Authmenu->where("auth_level=0 and auth_id in ($curRole_ids)")->order("sort_id asc")->select();
            $info2=$Authmenu->where("auth_level=1 and auth_id in ($curRole_ids) and auth_status=1 and auth_category=1")->order("sort_id asc")->select();
            $info3 = $Authmenu->where("auth_level=1 and auth_category=1 and ( auth_name like '%列表%') and auth_id in ($curRole_ids)")->field("auth_id")->select();
            $info4 = $Authmenu->where("auth_level=1 and auth_category=1 and auth_id in ($curRole_ids)")->select();
        }

        $authArray = array();
        foreach ($info3 as $key => $value) {
            foreach ($value as $key2 => $value2) {
                $authArray[] = $value2;
            }
        }

        $this->assign("info1",$info1);
        $this->assign("info2",$info2);
        $this->assign("info3",$authArray);
        $this->assign("info4",$info4);

    	$now_ac=CONTROLLER_NAME.'-'.ACTION_NAME;	//获取当前请求的控制器和方法

    	if(empty($admin_id)){
    		$url=U("Admin/Login/login");
			$js= <<<eof
				<script>
					window.top.location.href="{$url}";
				</script>
eof;
		//这里一定要留个空行
			echo $js;
    	}

    	$admin_name=session("admin_name");
    	$allow_ac="Index-index,Error-error,Administrator-AdministratorInfo,Administrator-uploadify,Administrator-doUploadifyCrop,Group-particular,Talent-particular,Bot-particular,Notification-particular,Big-uploadify";
    	if(stripos($curRole_ac,$now_ac)===false && $admin_name!=="root" && stripos($allow_ac,$now_ac)===false){
    		$this->redirect("Admin/Error/error");
    	}
    }
}