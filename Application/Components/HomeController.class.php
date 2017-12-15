<?php
namespace Components;
use Think\Controller;
class HomeController extends Controller {
    function __construct(){
    	parent::__construct();
        //导航
        $auth = D("Authmenu");
        $parentInfo = $auth->getFrontmenuParent();
        $this->assign("frontmenu", $parentInfo);

        $id = $auth->getfrontPid();
        $this->assign("dname", $id);

        $seo = D("Seo");
        $seoInfo = $seo->SelectData()[0];
        $this->assign("seoInfo", $seoInfo);
    }

}