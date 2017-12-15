<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>系统管理-SEO管理</title>
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
            <!-- 左侧 -->
            
            <!-- 右侧内容 -->
            <div class="page-content">
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li><a href="/team/index.php/Admin/Index/index">首页</a></li>
                        <li class="active">SEO信息</li>
                    </ul>
                </div>
                <div class="page-body">
                    <div class="row">
                        <div class="col-lg-12 col-sm-12 col-xs-12">
                            <div class="widget">
                                <div class="widget-header bordered-bottom bordered-blue">
                                    <span class="widget-caption">SEO信息</span>
                                </div>
                                <div class="widget-body">
                                    <div id="horizontal-form">
                                        <form class="form-horizontal" id="updateForm" role="form">
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">title</label>
                                                <div class="col-sm-6">
                                                    <input class="form-control" id="title" value="<?php echo ($seoInfo["title"]); ?>" name="title" required="required" type="text">
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">关键字</label>
                                                <div class="col-sm-6">
                                                    <textarea name="keyword" class="form-control" id="keyWord" rows="5"><?php echo ($seoInfo["keyword"]); ?></textarea>
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-sm-2 control-label no-padding-right">描述</label>
                                                <div class="col-sm-6">
                                                    <textarea name="describe" id="describe" class="form-control" rows="5"><?php echo ($seoInfo["describe"]); ?></textarea>
                                                </div>
                                                <p class="help-block col-sm-4 red">* 必填</p>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-offset-2 col-sm-10">
                                                    <input type="hidden" name="identify" value="<?php echo ($identify); ?>">
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
    <script type="text/javascript" src="/team/Public/Admin/style/dialog/layer.js"></script>
    <script type="text/javascript" src="/team/Public/Admin/style/dialog.js"></script>
    <script type="text/javascript" src="/team/Public/Common/js/common.js"></script>
    <script>
        $("#updateForm").submit(function(){
            var url = '/team/index.php/Admin/Basic/seo?parent=53593102c131c278ea6a27f7d09a3922';
            var data = $(this).serialize();
            if (!$('#title').val()) {
                dialog.error("title不能为空");
            }else if (!$('#keyWord').val()) {
                dialog.error("关键字不能为空");
            }else if (!$('#describe').val()) {
                dialog.error("描述不能为空");
            }else{
                ajaxFn(url,data,url);
            }
            return false;
        })
    </script>
    
</body></html>