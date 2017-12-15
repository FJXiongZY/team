<?php
namespace Admin\Controller;
use Components\AdminController;
class BigController extends AdminController {
    public function showList(){
        $big = D("Big");
        $Authmenu = D("Authmenu");

        $result = $big->getInfo();
        $this->assign("data", $result['data']);
        $this->assign("condtion", $result['condtion']);

        //获取当前父级
        session("parent", I("parent"));
        $curPid = $Authmenu->getCurPid();
        $this->assign("curPid", $curPid);

        $this->display();
    }

    public function uploadify(){
        if(!empty($_FILES)){
            $big = D("Big");
            try{
                $uploadResult = $big->getUploadify();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, "上传成功", $uploadResult);
        }else{
            return show(0, "上传失败");
        }
    }

    public function add(){
        $big = D("Big");
        if(IS_POST){
            try{
                $addResult = $big->getAdd();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $addResult);
        }
        $this->assign("identify", "add");

        $this->display();
    }

    public function update(){
        $big = D("Big");
        $id = $_GET['id'];
        if($id == '[object Object]'){
            $this->redirect("Admin/Big/showList");
        }
        // 显示当前的菜单
        $cur = $big->getFindData($id);
        $this->assign("cur",$cur);

        if(IS_POST){
            try{
                $updateResult = $big->getUpdate($id, $cur['big_pic']);
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $updateResult);
        }

        $this->assign('identify', 'update');
        $this->display();
    }

    public function del(){
        $big = D("Big");
        if (IS_POST) {
            try{
                $result = $big->getDel();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function toLine(){
        $big = D("Big");
        if (IS_POST) {
            try{
                $result = $big->getToLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function offLine(){
        $big = D("Big");
        if (IS_POST) {
            try{
                $result = $big->getOffLine();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, $result);
        }
    }

    public function updateSort(){
        $big = D("Big");
        if (IS_POST) {
            try{
                $big->getUpdateSort();
            }catch(\Exception $e){
                return show(0, $e->getMessage());
            }
            return show(1, '排序成功');
        }else{
            return show(0, '排序失败');
        }
    }

}