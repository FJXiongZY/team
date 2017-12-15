<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>管理员-添加菜单</title>
    <meta name="description" content="Dashboard">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!--Basic Styles-->
    <link href="/team/Public/Admin/style/bootstrap.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/font-awesome.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/weather-icons.css" rel="stylesheet">
    <!--Beyond styles-->
    <link id="beyond-link" href="/team/Public/Admin/style/beyond.css" rel="stylesheet" type="text/css">
    <link href="/team/Public/Admin/style/demo.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/typicons.css" rel="stylesheet">
    <link href="/team/Public/Admin/style/animate.css" rel="stylesheet">
    <link rel="stylesheet" href="/team/Public/Admin/style/Admin.css">
    <link rel="stylesheet" href="/team/Public/Admin/style/page.css">
    
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
                                    <img src="/team/Public/Admin/images/adam-jansen.jpg">
                                </div>
                                <section>
                                    <h2><span class="profile"><span>admin</span></span></h2>
                                </section>
                            </a>
                            <ul class="pull-right dropdown-menu dropdown-arrow dropdown-login-area">
                                
                                
                                <li class="dropdown-footer">
                                    <a href="/admin/user/logout.html">个人中心</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="/admin/user/changePwd.html">修改密码</a>
                                </li>
                                <li class="dropdown-footer">
                                    <a href="/admin/user/logout.html">退出登录</a>
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
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">菜单管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/team/index.php/Admin/authmenu/showList">
                        <span class="menu-text">菜单列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">管理员</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/team/index.php/Admin/Administrator/showList">
                        <span class="menu-text">管理列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-user"></i>
                <span class="menu-text">角色管理</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/team/index.php/Admin/Role/showList">
                        <span class="menu-text">角色列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-file-text"></i>
                <span class="menu-text">文档</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/admin/document/index.html">
                        <span class="menu-text">文章列表</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#" class="menu-dropdown">
                <i class="menu-icon fa fa-gear"></i>
                <span class="menu-text">系统</span>
                <i class="menu-expand"></i>
            </a>
            <ul class="submenu">
                <li>
                    <a href="/admin/document/index.html">
                        <span class="menu-text">配置</span>
                        <i class="menu-expand"></i>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</div>
<!-- 左侧 -->
            <!-- /左侧 -->
            <!-- Page Content -->
            <div class="page-content">
                <!-- Page Breadcrumb -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/team/index.php/Admin/Index/index">首页</a>
                        </li>
                        <li>
                            <a href="/team/index.php/Admin/Authmenu/showList">菜单管理</a>
                        </li>
                        <li class="active">添加菜单</li>
                    </ul>
                </div>
                <!-- /Page Breadcrumb -->
                <!-- Page Body -->
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget">
                                <div class="widget-header bordered-bottom bordered-blue">
                                    <span class="widget-caption">新增菜单</span>
                                </div>
                                <div class="widget-body">
                                    <div id="horizontal-form">
                                        <form class="form-horizontal" id="addForm" role="form">
                                            <div class="form-group">
                                                <label for="auth_name" class="col-sm-2 control-label no-padding-right">菜单名</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="auth_name" placeholder="请输入菜单名" name="auth_name" required="required" type="text">
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label for="auth_pid" class="col-sm-2 control-label no-padding-right">父级ID</label>
                                                <div class="col-sm-6">
                                                    <select name="auth_pid" style="width: 100%;">
                                                        <option selected="selected" value="0">--父级--</option>
                                                        <?php if(is_array($getPid)): $i = 0; $__LIST__ = $getPid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$getPid): $mod = ($i % 2 );++$i;?><option value="<?php echo ($getPid["auth_id"]); ?>"><?php echo ($getPid["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="auth_c" class="col-sm-2 control-label no-padding-right">控制器</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="auth_c" name="auth_c" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="auth_a" class="col-sm-2 control-label no-padding-right">方法名</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="auth_a" name="auth_a" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="sort_id" class="col-sm-2 control-label no-padding-right">排序</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="sort_id" name="sort_id" value="1" type="text">
                                                </div>
                                                <input name="identify" value="<?php echo ($identify); ?>" type="hidden">
                                            </div>
                                            <div class="form-group">
                                                <label for="auth_status" class="col-sm-2 control-label no-padding-right">是否展示</label>
                                                <div class="col-xs-4">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="auth_status" value="1" checked="checked"> yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="auth_status" value="0"> no
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <button type="submit" class="btn btn-info">保存信息</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Page Body -->
            </div>
            <!-- /Page Content -->
        </div>
    </div>
    <!--Basic Scripts-->
    <script src="/team/Public/Admin/style/jquery_002.js"></script>
    <script src="/team/Public/Admin/style/bootstrap.js"></script>
    <script src="/team/Public/Admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/team/Public/Admin/style/beyond.js"></script>
    <script type="text/javascript" src="/team/Public/Admin/style/dialog/layer.js"></script>
    <script type="text/javascript" src="/team/Public/Admin/style/dialog.js"></script>
    <script type="text/javascript" src="/team/Public/Common/js/common.js"></script>
    <script>
        $("#addForm").submit(function(){
            var url = '<?php echo U("Admin/Authmenu/add");?>';
            var data = $(this).serialize();
            var successUrl = '<?php echo U("Admin/Authmenu/showList");?>';
            if (!$('#auth_name').val()) {
                dialog.error("菜单名不能为空");
            }else{
                ajaxFn(url,data,successUrl);
            }
            return false;
        })
    </script>
    
</body>
</html>