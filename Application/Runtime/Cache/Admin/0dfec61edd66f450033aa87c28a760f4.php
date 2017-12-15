<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
		<title>管理员登录</title>

		<!-- Bootstrap -->
		<link href="/team/Public/Admin/style/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/team/Public/Admin/style/login.css" />

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

	<body>
		<div class="centerColor"></div>

		<div class="box">
			<div class="box_top">
				
			</div>
			<div class="box_boder">
				<div class="box_boder_left">
					<div class="userPic">
						<img src="/team/Uploads/userPic/asaf45f4aw5f.jpg" width="120px" height="120px" id="defaultImg" />
					</div>
				</div>
				<div class="box_boder_right">
					<form action="/team/index.php/Admin/Login/login.html" method="post" id="myform" enctype="multipart/form-data" class="form-horizontal">
						<div class="form-group col-md-10 has-feedback" id="userGroup">
						  <label class="sr-only">账号</label>
						  <div class="input-group">
						    <span class="input-group-addon">账号</span>
						    <input type="text" class="form-control" id="adminUser_name" name="admin_name" placeholder="请输入用户名">
						  </div>
						  <span id="success" class="glyphicon  form-control-feedback" aria-hidden="true"><input type="hidden" name="identify" value="<?php echo ($identify); ?>"></span>
						</div>
						<div class="form-group col-md-10">
						    <label class="sr-only" for="">密码</label>
						    <div class="input-group">
						    	<div class="input-group-addon">密码</div>
						    	<input type="password" name="admin_password" class="form-control" id="adminUser_password" placeholder="请输入密码">
						    </div>
						</div>
						<div class="form-group col-md-10">
						    <label class="sr-only" for="">登陆</label>
						    <div class="input-group">
						    	<input type="submit" class="btn btn-info" value="登陆" name="">
						    </div>
						</div>
					</form>
				</div>
			</div>
		</div>
		
		<script src="/team/Public/Admin/style/jquery_002.js"></script>
   		<script src="/team/Public/Admin/style/bootstrap.js"></script>
    	<script src="/team/Public/Admin/style/jquery.js"></script>
		<script type="text/javascript" src="/team/Public/Admin/style/dialog/layer.js"></script>
    	<script type="text/javascript" src="/team/Public/Admin/style/dialog.js"></script>
    	<script type="text/javascript" src="/team/Public/Common/js/common.js"></script>
		<script type="text/javascript">
			$("#adminUser_name").on("blur", function(){
				loseBlur('/team/', '<?php echo U("Admin/Login/findtUser");?>');
	        });
			$("#myform").submit(function(){
				var UrlSuccess = '<?php echo U("Admin/Index/index");?>';
				if(!$("#adminUser_name").val()){
					dialog.error("账户不能为空");
				}else if(!$("#adminUser_password").val()){
					dialog.error("密码不能为空");
				}else{
					ajaxFn("/team/index.php/Admin/Login/login.html", $(this).serialize(), UrlSuccess);
				}
		        return false;
		    });
		</script>
	</body>

</html>