<?php
namespace Admin\Controller;
use Components\AdminController;
class NotificationController extends AdminController {
    public function showList(){
        $Notification = D("Notification");
        $AuthMenu = D("Authmenu");

        $result = $Notification->getPagesInfo(8);
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
        $NoticeParent = $Notification->getNoticeParent();
        $this->assign("NoticeParent", $NoticeParent);

        $this->display();
    }

    public function add(){
        $Notification = D("Notification");

        //获取内容的父级
        $NoticeParent = $Notification->getNoticeParent();
        $this->assign("NoticeParent", $NoticeParent);

        if(IS_POST){
            try{
                $result = $Notification->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }

        $this->assign("identify", "add");

        $this->display();
    }

    public function update(){
        $Notification = D("Notification");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Notification/showList");
        }
        // 显示当前信息
        $cur = $Notification->getFindData("id={$id}");
        $this->assign("cur",$cur);
        if(IS_POST){
            try{
                $updateResult = $Notification->getUpdate($id);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }
        //获取内容的父级
        $NoticeParent = $Notification->getNoticeParent();
        $this->assign("NoticeParent", $NoticeParent);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $Notification = D("Notification");
        if (IS_POST) {
            try{
                $result = $Notification->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function toLine(){
        $Notification = D("Notification");
        if (IS_POST) {
            try{
                $result = $Notification->getToLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function offLine(){
        $Notification = D("Notification");
        if (IS_POST) {
            try{
                $result = $Notification->getOffLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function particular(){
        $Notification = D("Notification");
        $id = I("admin_id");
        $cur = $Notification->getFindData("id={$id}");
        $this->assign("cur", $cur);
        $this->display();
    }
}