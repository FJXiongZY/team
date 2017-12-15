<?php
namespace Admin\Controller;
use Components\AdminController;
class TalentController extends AdminController {
    public function showList(){
        $Talent = D("Talent");
        $AuthMenu = D("Authmenu");

        $result = $Talent->getPagesInfo(8);
        $data = $result['data'];
        $pagestr = $result['pagestr'];
        $condtion = $result['condtion'];

        $this->assign("condtion", $condtion);
        $this->assign("data", $data);
        $this->assign("pagestr", $pagestr);

        // 获取当前父级
        session("parent", I("parent"));
        $curPid = $AuthMenu->getCurPid();
        $this->assign("curPid", $curPid);

        //获取内容的父级
        $TalentParent = $Talent->getTalentParent();
        $this->assign("TalentParent", $TalentParent);

        $this->display();
    }

    public function add(){
        $Talent = D("Talent");

        //获取内容的父级
        $TalentParent = $Talent->getTalentParent();
        $this->assign("TalentParent", $TalentParent);

        if(IS_POST){
            try{
                $result = $Talent->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }

        $this->assign("identify", "add");

        $this->display();
    }

    public function update(){
        $Talent = D("Talent");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Talent/showList");
        }
        // 显示当前信息
        $cur = $Talent->getFindData("id={$id}");
        $this->assign("cur",$cur);
        if(IS_POST){
            try{
                $updateResult = $Talent->getUpdate($id);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }
        //获取内容的父级
        $TalentParent = $Talent->getTalentParent();
        $this->assign("TalentParent", $TalentParent);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $Talent = D("Talent");
        if (IS_POST) {
            try{
                $result = $Talent->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function toLine(){
        $Talent = D("Talent");
        if (IS_POST) {
            try{
                $result = $Talent->getToLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function offLine(){
        $Talent = D("Talent");
        if (IS_POST) {
            try{
                $result = $Talent->getOffLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function particular(){
        $Talent = D("Talent");
        $id = I("admin_id");
        $cur = $Talent->getFindData("id={$id}");
        $this->assign("cur", $cur);
        $this->display();
    }
}