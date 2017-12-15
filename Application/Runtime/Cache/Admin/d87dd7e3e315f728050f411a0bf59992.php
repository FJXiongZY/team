<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html><head>
    <meta charset="utf-8">
    <title>后台管理-导航管理</title>
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
<!-- 左侧 -->
            <!-- 右侧内容 -->
            <div class="page-content">
                <!-- 面包屑导航 -->
                <div class="page-breadcrumbs">
                    <ul class="breadcrumb">
                        <li>
                            <a href="/team/index.php/Admin/Index/index">首页</a>
                        </li>
                        <li class="active">导航管理</li>
                    </ul>
                </div>
                <!-- /面包屑导航 -->
                <!-- 列表内容 -->
                <div class="page-body">
                    <!-- 条件搜索 -->
                    <div class="page-search">
                        <form class="form-inline" action="/team/index.php/Admin/Frontmenu/showList?parent=7e84d359743782b1e67bd28262f79821" method="post">
                            <div class="form-group">
                                <label>选择状态:</label>
                                <select name="class" class="form-control">
                                    <option value="">--查询全部--</option>
                                    <option value="pid" <?php if($condtion['front_class'] == 'pid'): ?>selected="selected"<?php endif; ?> >--查询父级--</option>
                                    <?php if(is_array($getPid)): $i = 0; $__LIST__ = $getPid;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$getPid): $mod = ($i % 2 );++$i;?><option value="<?php echo ($getPid["front_id"]); ?>" <?php if($condtion['front_class'] == $getPid['front_id']): ?>selected="selected"<?php endif; ?> ><?php echo ($getPid["front_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="text" name="name" class="form-control" placeholder="用户名称">
                            </div>
                            <button type="submit" class="btn btn-primary shiny">查询</button>
                        </form>
                    </div>
                    <!-- /条件搜索 -->
                    <!-- 功能 -->
                    <?php if(is_array($info4)): $i = 0; $__LIST__ = $info4;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$info4): $mod = ($i % 2 );++$i; if((!in_array($info4['front_id'], $info3)) AND ($info4['front_pid'] == $curPid['front_id'])): ?><a type="button" tooltip="<?php echo ($info4["front_name"]); ?>" id="<?php echo ($info4["front_a"]); ?>" class="btn btn-sm <?php echo ($info4["front_color"]); ?>"><i class="<?php echo ($info4["front_icon"]); ?>"></i><?php echo ($info4["front_name"]); ?>
                    </a> &nbsp;<?php endif; endforeach; endif; else: echo "" ;endif; ?>
                    <!-- /功能 -->
<div class="row">
    <div class="col-lg-12 col-sm-12 col-xs-12">
        <div class="widget">
            <div class="widget-body">
                <div class="flip-scroll">
                <form id="myform">
                    <table class="table table-bordered table-hover">
                        <thead class="">
                            <tr>
                                <th class="text-center">操作</th>
                                <th class="text-center" width="6%">排序</th>
                                <th class="text-center">ID</th>
                                <th class="text-center">名称</th>
                                <th class="text-center">父级ID</th>
                                <th class="text-center">控制器</th>
                                <th class="text-center">方法</th>
                                <th class="text-center">等级</th>
                                <th class="text-center">状态</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                                <td align="center"><input type="checkbox" name="operate" value="<?php echo ($vo["front_id"]); ?>"></td>
                                <td align="center"><input type="text" name="<?php echo ($vo["front_id"]); ?>" value="<?php echo ($vo["sort_id"]); ?>" class="form-control"></td>
                                <td align="center"><?php echo ($vo["front_id"]); ?></td>
                                <td align="center"><?php echo ($vo["front_name"]); ?></td>
                                <td align="center"><?php echo ($vo["front_pid"]); ?></td>
                                <td align="center"><?php echo ($vo["front_c"]); ?></td>
                                <td align="center"><?php echo ($vo["front_a"]); ?></td>
                                <td align="center"><?php echo ($vo["front_level"]); ?></td>
                                <td align="center"><?php echo (getstatus($vo["front_status"])); ?></td>
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
        var successUrl = '<?php echo U("Admin/frontmenu/showList");?>';
        //添加
        $("#add").on("click", function(){
            window.location = '<?php echo U("Admin/frontmenu/add");?>';
        })
        //编辑导航
        $('#update').on("click",function(){
            var url = '<?php echo U("Admin/frontmenu/update");?>';
            updateFn(url);
            return false;
        });
        //删除
        $('#del').on("click",function(){
            var url = '<?php echo U("Admin/frontmenu/del");?>';
            batch('是否删除?', url, successUrl);
            return false;
        });
        //更新排序
        $('#updateSort').on("click",function(){
            var sortData = $("#myform").serializeArray();
            var url = '<?php echo U("Admin/frontmenu/updateSort");?>';
            updateSort(sortData, '是否排序?', url, successUrl);
            return false;
        });

        //展示导航
        $("#showfrontmune").on("click", function(){
            var url = '<?php echo U("Admin/frontmenu/showfrontmune");?>';
            batch('是否展示?', url, successUrl);
            return false;
        });

        //隐藏导航
        $("#hidefrontmune").on("click", function(){
            var url = '<?php echo U("Admin/frontmenu/hidefrontmune");?>';
            batch('是否隐藏?', url, successUrl);
            return false;
        });
    </script>
    
</body></html>