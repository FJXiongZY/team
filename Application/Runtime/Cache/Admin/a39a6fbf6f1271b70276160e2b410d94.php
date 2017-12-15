<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>管理员-编辑菜单</title>
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

<div class="sidebar-wrap" id="side_left">
    <div class="panel-group" id="panelParent">

        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="/team/index.php/Admin/Index/index" data-parent="#panelParent" >
                        <span class="glyphicon glyphicon-user"></span>&nbsp;&nbsp;&nbsp;首页<i class="glyphicon glyphicon-chevron-right pull-right"></i>
                    </a>
                </h3>
            </div>
        </div>
        <?php if(is_array($info1)): $i = 0; $__LIST__ = $info1;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">
                    <a href="#" data-toggle="collapse" data-target="#show<?php echo ($vo1["auth_id"]); ?>" data-parent="#panelParent" >
                        <span class="menu-icon <?php echo ($vo1["auth_icon"]); ?>"></span>&nbsp;&nbsp;&nbsp;<?php echo ($vo1["auth_name"]); ?><i class="glyphicon glyphicon-chevron-right pull-right"></i>
                    </a>
                </h3>
            </div>
            <div class="collapse panel-collapse collapse" id="show<?php echo ($vo1["auth_id"]); ?>">
                <div class="panel-body">
                    <ul>
                        <?php if(is_array($info2)): $i = 0; $__LIST__ = $info2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2['auth_pid'] == $vo1['auth_id']): ?><li><a href="/team/index.php/Admin/<?php echo ($vo2["auth_c"]); ?>/<?php echo ($vo2["auth_a"]); ?>?parent=<?php echo (md5pid($vo2["auth_pid"])); ?>"><?php echo ($vo2["auth_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    </ul>
                </div>
            </div>
        </div><?php endforeach; endif; else: echo "" ;endif; ?>

    </div>
</div>
</div>
<!-- /左侧 -->
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
                        <li class="active">编辑菜单</li>
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
                                        <form class="form-horizontal" id="updateForm" role="form">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">菜单名</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="name" placeholder="请输入菜单名" name="name" required="required" type="text" value="<?php echo ($cur["auth_name"]); ?>">
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">父级ID</label>
                                                <div class="col-sm-6">
                                                    <select name="parentId" style="width: 100%;">
                                                    <option <?php if($cur['auth_pid'] == 0): ?>selected="selected"<?php endif; ?> value="0">--父级--</option>
                                                        <?php if(is_array($getPid)): $i = 0; $__LIST__ = $getPid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$getPid): $mod = ($i % 2 );++$i;?><option <?php if($cur['auth_pid'] == $getPid['auth_id']): ?>selected="selected"<?php endif; ?> value="<?php echo ($getPid["auth_id"]); ?>"><?php echo ($getPid["auth_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">控制器</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="control" value="<?php echo ($cur["auth_c"]); ?>" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">方法名</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" value="<?php echo ($cur["auth_a"]); ?>" name="action" type="text">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">排序</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="sortId" value="<?php echo ($cur["sort_id"]); ?>" type="text">
                                                </div>
                                                <input name="identify" value="<?php echo ($identify); ?>" type="hidden">
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">分类</label>
                                                <div class="col-xs-4">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="Classification" <?php if($cur['auth_category'] == 1): ?>checked="checked"<?php endif; ?> value="1" checked="checked"> 后台菜单
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="Classification" <?php if($cur['auth_category'] == 2): ?>checked="checked"<?php endif; ?> value="2"> 前台导航
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">是否展示</label>
                                                <div class="col-xs-4">
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" <?php if($cur['auth_status'] == 1): ?>checked="checked"<?php endif; ?> value="1" checked="checked"> yes
                                                    </label>
                                                    <label class="radio-inline">
                                                        <input type="radio" name="status" <?php if($cur['auth_status'] == 0): ?>checked="checked"<?php endif; ?> value="0"> no
                                                    </label>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">按钮图标</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" name="icon" value="<?php echo ($cur["auth_icon"]); ?>" type="text">
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
        $("#updateForm").submit(function(){
            var url = '/team/index.php/Admin/Authmenu/update.html?id=107';
            var data = $(this).serialize();
            var successUrl = '<?php echo U("Admin/Authmenu/showList");?>';
            if (!$('#name').val()) {
                dialog.error("菜单名不能为空");
            }else{
                ajaxFn(url,data,successUrl);
            }
            return false;
        })
    </script>
    
</body>
</html>