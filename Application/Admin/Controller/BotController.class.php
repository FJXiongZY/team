<?php
namespace Admin\Controller;
use Components\AdminController;
class BotController extends AdminController {
    public function showList(){
        $Bot = D("Bot");
        $AuthMenu = D("Authmenu");

        $result = $Bot->getPagesInfo(8);
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
        $BotParent = $Bot->getBotParent();
        $this->assign("BotParent", $BotParent);

        $this->display();
    }

    public function add(){
        $Bot = D("Bot");

        //获取内容的父级
        $BotParent = $Bot->getBotParent();
        $this->assign("BotParent", $BotParent);

        if(IS_POST){
            try{
                $result = $Bot->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }

        $this->assign("identify", "add");

        $this->display();
    }

    public function update(){
        $Bot = D("Bot");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Bot/showList");
        }
        // 显示当前信息
        $cur = $Bot->getFindData("id={$id}");
        $this->assign("cur",$cur);
        if(IS_POST){
            try{
                $updateResult = $Bot->getUpdate($id);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }
        //获取内容的父级
        $BotParent = $Bot->getBotParent();
        $this->assign("BotParent", $BotParent);

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $Bot = D("Bot");
        if (IS_POST) {
            try{
                $result = $Bot->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function toLine(){
        $Bot = D("Bot");
        if (IS_POST) {
            try{
                $result = $Bot->getToLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function offLine(){
        $Bot = D("Bot");
        if (IS_POST) {
            try{
                $result = $Bot->getOffLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function particular(){
        $Bot = D("Bot");
        $id = I("admin_id");
        $cur = $Bot->getFindData("id={$id}");
        $this->assign("cur", $cur);
        $this->display();
    }
}