<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>后台管理-个人中心</title>
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
		<link rel="stylesheet" type="text/css" href="/team/Public/Admin/style/userInfo.css" />
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
				<div class="page-content">
					<div class="page-breadcrumbs">
						<ul class="breadcrumb">
							<li class="active">控制面板</li>
						</ul>
					</div>
					<div class="page-body">
						<div class="top">
							<div class="media">
								<div class="media-left text-center">
									<div class="userImg">
										<img src="/team/Uploads/userPic/<?php echo (session('userPic')); ?>" width="150" alt="我的头像" title="我的头像" />
									</div>
									<button type="button" id="updatePic" class="btn btn-info" data-toggle="modal" data-target="#editUserPic">
									更换图像
									</button>
								</div>
								<div class="media-body">
									<div class="userInfo">
										<button type="button" id="edit" class="btn btn-info btn-sm" data-toggle="modal" data-target="#editUserInfo">
										编辑资料
										</button>
										<ol class="list-inline">
											<li class="col-md-6"><span class="glyphicon glyphicon-user"></span>&nbsp;<?php echo (session('admin_name')); ?>&nbsp;您好！</li>
											<li class="col-md-6">邮箱：<?php echo (isnull($cur["email"])); ?></li>
											<li class="col-md-6">性别：<?php echo (getsex($cur["male"])); ?></li>
											<li class="col-md-6">手机：<?php echo (isnull($cur["phone"])); ?></li>
											<li class="col-md-6">等级：<?php echo (getlevel($cur["role_id"])); ?></li>
											<li class="col-md-6">微信号：<?php echo (isnull($cur["weChat"])); ?></li>
											<li class="col-md-6">创建时间：<?php echo (date("Y-m-d H:m:s",$cur["createTime"])); ?></li>
											<li class="col-md-6">登录次数：<?php echo ($cur["count"]); ?></li>
										</ol>
									</div>
								</div>
							</div>
						</div>
						<div class="bottom">
							<div class="logInfo">
								<table class="table table-hover">
									<thead bgColor="#e0e0e0">
										<th>#</th>
										<th>登陆用户</th>
										<th>登陆IP</th>
										<th>IP地址</th>
										<th>登陆时间</th>
									</thead>
									<tbody>
										<?php if(is_array($curLoginInfo)): $i = 0; $__LIST__ = array_slice($curLoginInfo,0,5,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
											<td><?php echo ($i); ?></td>
											<td><?php echo ($vo["admin_name"]); ?></td>
											<td><?php echo ($vo["admin_loginIp"]); ?></td>
											<td><?php echo (getipcity($vo["admin_loginIp"])); ?></td>
											<td><?php echo (date("Y-m-d H:m:s",$vo["admin_loginTime"])); ?></td>
										</tr><?php endforeach; endif; else: echo "" ;endif; ?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--修改头像模态框-->
		<div class="modal fade bs-example-modal-lg" id="editUserPic" tabindex="-1" role="dialog" aria-labelledby="userPicSrc">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="userPicSrc">更换头像</h4>
					</div>
					<div class="modal-body">
						<form action="" id="uploadFiyForm">
						<div class="media">
							<div class="media-left">
								<div class="uploadPic">
									<span class="fileName">选择要上传图片</span>
									<input type="file" name="uploadPic" data-src="./Uploads/userPic/<?php echo (session('userPic')); ?>" value="上传图片" id="btn">
								</div>
								<div class="showUserPic">
									<img src="/team/Uploads/userPic/<?php echo (session('userPic')); ?>" id="target" width="300" height="300" alt="我的头像" title="我的头像" />
								</div>
							</div>
							<div class="media-body">
								<div class="media-heading" id="preview-pane">
								    <div class="preview-container">
								        <img src="/team/Uploads/userPic/<?php echo (session('userPic')); ?>" class="jcrop-preview" alt="Preview"/>
								    </div>
								</div>
							</div>
						</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" id="uploadBtn" class="btn btn-primary btn-lg">确定</button>
				        <button type="button" class="btn btn-warning btn-lg" data-dismiss="modal">取消</button>
				    </div>
				</div>
			</div>
		</div>
		<!--/修改头像模态框-->
		<!--修改用户资料-->
		<div class="modal fade bs-example-modal-lg" id="editUserInfo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
						<h4 class="modal-title" id="myModalLabel2">编辑资料</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" id="updateCurInfo" role="form">
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">用户名</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_name" placeholder="请输入用户名" value="<?php echo ($cur["name"]); ?>" disabled="diabled" required="required" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">密码</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_password" placeholder="请输入密码" value="<?php echo ($cur["password"]); ?>"  name="admin_password" required="required" type="text">
								</div>
								<p class="help-block col-sm-4 red">* 必填</p>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">确认密码</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_passwordTow" placeholder="请输入密码" value="<?php echo ($cur["password"]); ?>"  name="admin_passwordTow" required="required" type="text">
								</div>
								<p class="help-block col-sm-4 red">* 必填</p>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">手机号</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_phone" placeholder="请输入手机号" value="<?php echo ($cur["phone"]); ?>"  name="admin_phone" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">微信号</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_weChat" placeholder="请输入微信号" value="<?php echo ($cur["weChat"]); ?>"  name="admin_weChat" type="text">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">邮箱</label>
								<div class="col-sm-6">
									<input class="form-control" id="admin_email" placeholder="请输入邮箱" name="admin_email" value="<?php echo ($cur["email"]); ?>"  type="email">
								</div>
							</div>
							<div class="form-group">
								<label class="col-sm-2 control-label no-padding-right">性别</label>
								<div class="col-xs-4">
									<label class="radio-inline">
										<input type="radio" <?php if($cur['male'] == 1): ?>checked="checked"<?php endif; ?> name="admin_sex" value="1" > 男
									</label>
									<label class="radio-inline">
										<input type="radio" <?php if($cur['male'] == 0): ?>checked="checked"<?php endif; ?> name="admin_sex" value="0"> 女
									</label>
								</div>
							</div>
							<div class="form-group">
								<div class="col-sm-offset-2 col-sm-10">
									<input name="identify" value="<?php echo ($identify); ?>" type="hidden">
									<button class="btn btn-info">保存信息</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
		<!--/修改用户资料-->
		<!--Basic Scripts-->
		<script src="/team/Public/Admin/style/jquery_002.js"></script>
		<script src="/team/Public/Admin/style/bootstrap.js"></script>
		<script src="/team/Public/Admin/style/jquery.js"></script>
		<!--Beyond Scripts-->
		<script src="/team/Public/Admin/style/beyond.js"></script>
		<script type="text/javascript" src="/team/Public/Admin/style/dialog/layer.js"></script>
		<script type="text/javascript" src="/team/Public/Admin/style/dialog.js"></script>
		<script type="text/javascript" src="/team/Public/Common/js/common.js"></script>
		<script src="/team/Public/Admin/style/jquery.Jcrop.js"></script>
   	 	<script type="text/javascript" src="/team/Public/Admin/style/xiaoguo.js"></script>
		<script>
		//图片上传
		$("#btn").on("change", function(){
			var postUrl = '<?php echo U("Admin/Administrator/uploadify");?>';
			uploadFly(postUrl, "/team");
		});

		$("#uploadBtn").on("click", function(){
	        var postUrl = '<?php echo U("Admin/Administrator/doUploadifyCrop");?>';
	        var successUrl = '<?php echo U("Admin/Administrator/AdministratorInfo");?>';
	        doUploadCrop(postUrl, successUrl);
		});
		$("#admin_passwordTow").blur(function (){
			admin_passwordTow();
		});
		$('#admin_email').blur(function (){
			admin_email();
		});
		$('#admin_phone').blur(function (){
			admin_phone();
		});
		$('#admin_weChat').blur(function (){
			admin_weChat();
		});
		$("#updateCurInfo").submit(function(){
		var url = '/team/index.php/Admin/Administrator/AdministratorInfo.html';
		var data = $(this).serialize();
		var successUrl = '<?php echo U("Admin/Administrator/AdministratorInfo");?>';
		if (!$('#admin_password').val()) {
		dialog.error("密码不能为空");
		}else{
		ajaxFn(url,data,successUrl);
		}
		return false;
		})
		</script>
	</body>
</html>