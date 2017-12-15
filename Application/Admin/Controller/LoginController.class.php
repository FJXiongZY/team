<?php
namespace Admin\Controller;
use Think\Controller;
class LoginController extends Controller {
    public function findtUser(){
        $Administrator = D('Administrator');
        if (IS_POST) {
            try{
                $fineResult = $Administrator->getFindtUser();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $fineResult['message'], $fineResult['data']);
        }else{
            return show(0, "参数错误");
        }
    }

    public function login(){
        $Administrator = D('Administrator');
        $session = D('starmoon_session');
        if (IS_POST) {
            try{
                $loginResult = $Administrator->getLogin();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, '登录成功');
        }
        $this->assign("identify", 'login');
        $this->display();
    }

    public function logout(){
        session(null);
        $this->redirect("Admin/Login/login");
    }
}