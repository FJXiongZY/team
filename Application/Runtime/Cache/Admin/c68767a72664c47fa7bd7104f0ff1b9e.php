<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>大图管理-大图列表</title>
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
            <!-- 右侧内容 -->
            <div class="page-content">
                <!-- 面包屑导航 -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/team/index.php/Admin/Index/index">首页</a>
                        </li>
                        <li class="active">大图列表</li>
                    </ul>
                </div>
                <!-- /面包屑导航 -->
                <!-- 列表内容 -->
                <div class="page-body">
                    <!-- 条件搜索 -->
                    <div class="page-search">
                        <form class="form-inline" action="/team/index.php/Admin/Big/showList.html" method="post">
                            <div class="form-group">
                                <label>选择状态:</label>
                                <select name="status" class="form-control">
                                <option <?php if($condtion['big_status'] == 1): ?>selected="selected"<?php endif; ?> value="1">上线大图</option>
                                    <option <?php if($condtion['big_status'] == 2): ?>selected="selected"<?php endif; ?> value="2">下线大图</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary shiny">查询</button>
                        </form>
                    </div>
                    <!-- /条件搜索 -->
                    <!-- 功能 -->
                    <?php if(is_array($info4)): $i = 0; $__LIST__ = $info4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info4): $mod = ($i % 2 );++$i; if((!in_array($info4['auth_id'], $info3)) AND ($info4['auth_pid'] == $curPid['auth_id'])): ?><a type="button" tooltip="<?php echo ($info4["auth_name"]); ?>" id="<?php echo ($info4["auth_a"]); ?>" class="btn btn-sm btn-colorpicker"><i class="<?php echo ($info4["auth_icon"]); ?>"></i><?php echo ($info4["auth_name"]); ?>
                    </a> &nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <!-- /功能 -->
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                <form id="myform" name="myform" method="post">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">操作</th>
                                <th class="text-center" width="6%">排序</th>
                                <th class="text-center">ID</th>
                                <th class="text-center">title</th>
                                <th class="text-center" width="20%">图片</th>
                                <th class="text-center">描述</th>
                                <th class="text-center">状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input type="checkbox" name="operate" value="<?php echo ($vo["big_id"]); ?>"></td>
                                <td align="center"><input type="text" name="<?php echo ($vo["big_id"]); ?>" value="<?php echo ($vo["sort_id"]); ?>" class="form-control"></td>
                                <td align="center"><?php echo ($vo["big_id"]); ?></td>
                                <td align="center"><?php echo ($vo["big_name"]); ?></td>
                                <td align="center"><img src="/team/Uploads/BigPic/<?php echo ($vo["big_pic"]); ?>" height="50px" alt=""></td>
                                <td align="center"><?php echo ($vo["big_describe"]); ?></td>
                                <td align="center"><?php echo (getfrontstatus($vo["big_status"])); ?></td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    </form>
                </div>
                <div class="list-page text-center sabrosus"><?php echo ($pagestr); ?></div>
            </div>
        </div>
    </div>
</div>
                </div>
                <!-- /列表内容 -->
            </div>
            <!-- /右侧内容 -->
        </div>
    </div>
    <!--Basic Scripts-->
    <script src="/team/Public/Admin/style/jquery_002.js"></script>
    <script src="/team/Public/Admin/style/bootstrap.js"></script>
    <script src="/team/Public/Admin/style/jquery.js"></script>
    <!--Beyond Scripts-->
    <script src="/team/Public/Admin/style/beyond.js"></script>
    <script src="/team/Public/Admin/style/beyond.js"></script>
    <script type="text/javascript" src="/team/Public/Admin/style/dialog/layer.js"></script>
    <script type="text/javascript" src="/team/Public/Admin/style/dialog.js"></script>
    <script type="text/javascript" src="/team/Public/Common/js/common.js"></script>
    <script>
        var successUrl = '<?php echo U("Admin/Big/showList");?>';
        //添加
        $("#add").on("click", function(){
            window.location = '<?php echo U("Admin/Big/add");?>';
        })
        //更新排序
        $('#updateSort').on("click",function(){
            var sortData = $("#myform").serializeArray();
            var url = '<?php echo U("Admin/Big/updateSort");?>';
            updateSort(sortData, '是否排序?', url, successUrl);
            return false;
        });
        //编辑菜单
        $('#update').on("click",function(){
            var url = '<?php echo U("Admin/Big/update");?>';
            updateFn(url);
            return false;
        });
        //删除
        $('#del').on("click",function(){
            var url = '<?php echo U("Admin/Big/del");?>';
            batch('是否删除?', url, successUrl);
            return false;
        });
        //上线
        $("#toLine").on("click", function(){
            var url = '<?php echo U("Admin/Big/toLine");?>';
            batch('是否上线?', url, successUrl);
            return false;
        });
        //下线
        $("#offLine").on("click", function(){
            var url = '<?php echo U("Admin/Big/offLine");?>';
            batch('是否下线?', url, successUrl);
            return false;
        });
    </script>
    
</body></html>