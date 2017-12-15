<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>优秀团队后台首页</title>
    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="/team/Public/Admin/style/bootstrap.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/font-awesome.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/weather-icons.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/team/Public/Admin/style/iconfont.css">
    <!--Beyond styles-->
    <link id="beyond-link" href="/team/Public/Admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/team/Public/Admin/style/demo.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/typicons.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="/team/Public/Admin/style/Admin.css">
</head>
<body>
    <!-- 头部 -->
    <!-- 头部 -->
<div class="navbar">
    <div class="navbar-inner">
        <div class="navbar-container">
            <div class="navbar-header pull-left">
                <a href="/team/index.php/Admin/Index/index" class="navbar-brand">后台管理系统</a>
            </div>
            <div class="sidebar-collapse" id="sidebar-collapse">
                <i class="collapse-icon fa fa-bars"></i>
            </div>
            <div class="navbar-header pull-right">
                <div class="navbar-account">
                    <ul class="account-area">
                        <li>
                            <a class="login-area dropdown-toggle" data-toggle="dropdown">
                                <div class="avatar" title="View your public profile">
                                    <img src="/team/Uploads/userPic/<?php echo (session('userPic')); ?>">
                                </div>
                                <section>
                                    <h2><span class="profile"><span><?php echo (session('admin_name')); ?>&nbsp;&nbsp;<i class="fa fa-chevron-down"></i></span></span></h2>
                                </section>
                            </a>
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                <li class="dropdown-footer">
                                    <a href="/team/index.php/Admin/Administrator/AdministratorInfo">个人中心</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="/team/index.php/Home/Index/index">返回前台</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="/team/index.php/Admin/Login/logout">退出登录</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /头部 -->
    <!-- /头部 -->
    
    <div class="main-container container-fluid">
        <div class="page-container">

            <!-- 左侧 -->
            <!-- 左侧 -->
<div class="page-sidebar" id="sidebar">
    <ul class="nav sidebar-menu">
        <li>
            <a href="/team/index.php/Admin/Index/index" class="menu-dropdown">
                <i class="menu-icon glyphicon glyphicon-home"></i>
                <span class="menu-text">首页</span>
                <i class="menu-expand"></i>
            </a>
        </li>
        <?php if(is_array($info1)): $i = 0; $__LIST__ = $info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><li>
            <a href="javascript:;" class="menu-dropdown">
                <i class="menu-icon <?php echo ($vo1["auth_icon"]); ?>"></i>
                <span class="menu-text"><?php echo ($vo1["auth_name"]); ?></span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
            <?php if(is_array($info2)): $i = 0; $__LIST__ = $info2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2['auth_pid'] == $vo1['auth_id']): ?><li>
                    <a href="/team/index.php/Admin/<?php echo ($vo2["auth_c"]); ?>/<?php echo ($vo2["auth_a"]); ?>?parent=<?php echo (md5pid($vo2["auth_pid"])); ?>">
                        <span class="menu-text"><?php echo ($vo2["auth_name"]); ?></span>
                        <i class="menu-expand"></i>
                    </a>
                </li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
    </ul>
</div>
<!-- /左侧 -->
            <!-- 左侧 -->
            
            <!-- 右侧内容 -->
            <div class="page-content">
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li class="active">控制面板</li>
                    </ul>
                </div>
                <div class="page-body">
                    <div class="result-title">
                        <h1>系统基本信息</h1>
                    </div>
                    <div class="result-content">
                        <ul class="sys-info-list">
                            <?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                <label class="res-lab"><?php echo ($key); ?></label><span class="res-info"><?php echo ($vo); ?></span>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- 右侧内容 -->

        </div>
    </div>

    <!--Basic Scripts-->
    <script src="/team/Public/Admin/style/jquery_002.js"></script>
    <script src="/team/Public/Admin/style/bootstrap.js"></script>
    <script src="/team/Public/Admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/team/Public/Admin/style/beyond.js"></script>
    
</body></html>