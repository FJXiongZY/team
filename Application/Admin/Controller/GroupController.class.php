<?php
namespace Admin\Controller;
use Components\AdminController;
class GroupController extends AdminController {
    public function showList(){
        $group = D("Group");
        $AuthMenu = D("Authmenu");

        $result = $group->getPagesInfo(8);
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
        $groupParent = $group->getGroupParent();
        $this->assign("groupParent", $groupParent);

        $this->display();
    }

    public function add(){
        $group = D("Group");

        //获取内容的父级
        $groupParent = $group->getGroupParent();
        $this->assign("groupParent", $groupParent);

        if(IS_POST){
            try{
                $result = $group->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }

        $this->assign("identify", "add");

        $this->display();
    }
    public function update(){
        $group = D("Group");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Group/showList");
        }
        // 显示当前信息
        $cur = $group->getFindData("id={$id}");
        $this->assign("cur",$cur);
        if(IS_POST){
            try{
                $updateResult = $group->getUpdate($id);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }
        //获取内容的父级
        $groupParent = $group->getGroupParent();
        $this->assign("groupParent", $groupParent);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $group = D("Group");
        if (IS_POST) {
            try{
                $result = $group->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function toLine(){
        $group = D("Group");
        if (IS_POST) {
            try{
                $result = $group->getToLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function offLine(){
        $group = D("Group");
        if (IS_POST) {
            try{
                $result = $group->getOffLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function particular(){
        $group = D("Group");
        $id = I("admin_id");
        $cur = $group->getFindData("id={$id}");
        $this->assign("cur", $cur);
        $this->display();
    }
}