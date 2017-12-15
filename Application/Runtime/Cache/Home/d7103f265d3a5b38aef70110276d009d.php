<?php if (!defined('THINK_PATH')) exit();?>
		<!DOCTYPE html>
<html lang="zh-CN">

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title><?php echo ($seoInfo["title"]); ?></title>
		<meta name="keywords" content="<?php echo ($seoInfo["keyword"]); ?>">
		<meta name="description" content="<?php echo ($seoInfo["describe"]); ?>">

		<link href="/team/Public/Home/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="/team/Public/Admin/style/iconfont.css">
		<link rel="stylesheet" type="text/css" href="/team/Public/Home/css/index.css"/>

		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
      <script src="https://cdn.bootcss.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	</head>

	<body>
<!--头部-->
<header id="header">
	<!--log-->
	<div class="container">
		<div class="topbar"></div>
		<div class="toTeamLogo"></div>
		<div class="topSearch col-xs-12 col-sm-5">
			<form action="" class="form-horizontal text-center" method="post">
				<div class="form-group">
					<div class="col-sm-10">
						<input type="search" class="form-control" id="searchKeyword" placeholder="请输入关键字">
					</div>
					<button type="button" id="searchBtn" class="btn btn-search col-sm-1"><span class="glyphicon glyphicon-search"></span></button>
				</div>
			</form>
		</div>
	</div>
	<!--/log-->
</header>
<!--/头部-->

<!--导航-->
<nav class="navbar navbar-inverse navbar-static-top text-center" id="navbarHeader">
	<div class="container">
		<div class="row">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
			</div>
			<div id="navbar" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-setPadding">
					<li <?php if($dname['auth_id'] == null): ?>class="active"<?php endif; ?> ><a href="/team/index.php/Home/Index/index">首页</a></li>
					<?php if(is_array($frontmenu)): $i = 0; $__LIST__ = $frontmenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$frontmenu): $mod = ($i % 2 );++$i;?><li <?php if($dname['auth_id'] == $frontmenu['auth_id']): ?>class="active"<?php endif; ?> ><a href="/team/index.php/Home/<?php echo ($frontmenu["auth_c"]); ?>/<?php echo ($frontmenu["auth_a"]); ?>/name/<?php echo (md5pid($frontmenu["auth_id"])); ?>/gbrk/<?php echo ($frontmenu["auth_a"]); ?>"><?php echo ($frontmenu["auth_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
					<li><a href="/team/index.php/Admin/Index/Index">访问后台</a></li>
				</ul>
			</div>
			<!--/.nav-collapse -->
		</div>
	</div>
</nav>
<!--/导航-->
		
		<!--网站内容-->
		<div class="container" id="secondBody">
			<div class="col-md-3" id="left">
					<div class="left_location text-center">
						<p><?php echo ($parentInfo["auth_name"]); ?></p>
					</div>
					<div class="left_nav">
						<ul class="nav nav-pills nav-stacked text-center">
							<?php if(is_array($sonInfo)): $i = 0; $__LIST__ = $sonInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$sonInfo): $mod = ($i % 2 );++$i;?><li <?php if($gbrkName == $sonInfo['auth_a']): ?>class="active"<?php endif; ?> ><a href="/team/index.php/Home/<?php echo ($parentInfo["auth_c"]); ?>/<?php echo ($parentInfo["auth_a"]); ?>/name/<?php echo (md5pid($parentInfo["auth_id"])); ?>/gbrk/<?php echo ($sonInfo["auth_a"]); ?>"><?php echo ($sonInfo["auth_name"]); ?></a></li><?php endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div>
				</div>
				<div class="col-md-9" id="right">
					<ul class="breadcrumb hidden-xs">
						<li><span class="glyphicon glyphicon-map-marker"></span>&nbsp;当前位置：</li>
						<li><a href="/team/index.php/Home/Index/index">首页</a></li>
						<li><a href="javascript:;"><?php echo ($parentInfo["auth_name"]); ?></a></li>
						<li class="active"><a href="javascript:;"><?php echo ($data["title"]); ?></a></li>
					</ul>
					<div class="right_title text-center">
						<h3><?php echo ($data["title"]); ?></h3>
						<ol class="list-inline">
							<li><?php echo (date("Y-m-d H:m:s",$data["createTime"])); ?></li>
							<li><?php echo ($data["count"]); ?>人浏览</li>
						</ol>
					</div>
					<div>
						<?php echo htmlspecialchars_decode($data['content']);?>
					</div>
					
				</div>
		</div>
		<!--/网站内容-->
		
		<!--页脚-->
		<footer id="footer">
	<div class="container">
		<div class="row">
			<ul class="text-center">
				<li>版权所有：©广东松山职业技术学院</li>
				<li>地址：广东省韶关市曲江区南华</li>
				<li class="visible-lg">电话：0751-6501658</li>
				<li class="visible-lg">备案号：粤ICP备11020318号</li>
				<li class="hidden-xs">粤公网安备44020502000108号</li>
				<li class="hidden-xs hidden-sm">Powered by SiteServer CMS</li>
			</ul>
		</div>
	</div>
</footer>
		<!--/页脚-->
		

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script src="/team/Public/Home/js/jquery-1.11.1.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script src="/team/Public/Home/js/bootstrap.min.js"></script>
		<script src="/team/Public/Home/js/index.js"></script>
	</body>

</html>