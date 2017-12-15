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
		
		<!--轮播图-->
		<div class="container text-center" id="videoCarouserTop">
			<div class="row">
			<div id="big_carousel" class="carousel slide" data-ride="carousel">
				<ol class="carousel-indicators">
					<?php if(is_array($bigData)): $i = 0; $__LIST__ = $bigData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$k): $mod = ($i % 2 );++$i;?><li data-target="#big_carousel" class="<?php if($i == 1): ?>active<?php endif; ?>" data-slide-to="<?php echo ($i-1); ?>"></li><?php endforeach; endif; else: echo "" ;endif; ?>
				</ol>
				<div class="carousel-inner">
					<?php if(is_array($bigData)): $i = 0; $__LIST__ = $bigData;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$bigData): $mod = ($i % 2 );++$i;?><div class="item  <?php if($i == 1 ): ?>active<?php endif; ?> ">
							<img src="/team/Uploads/BigPic/<?php echo ($bigData["big_pic"]); ?>" title="<?php echo ($bigData["big_describe"]); ?>" alt="<?php echo ($bigData["big_describe"]); ?>">
						</div><?php endforeach; endif; else: echo "" ;endif; ?>
				</div>

				<a class="left carousel-control" href="#big_carousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
				</a>
				<a href="#big_carousel" class="right carousel-control" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				</a>
			</div>
			</div>
		</div>
		<!--/轮播图-->
		
		<!--网站内容-->
		<div class="container" id="webBody">
			<div class="row">
				<?php if(is_array($parentInfo)): $i = 0; $__LIST__ = array_slice($parentInfo,0,3,true);if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><div class="col-md-4 col-sm-12 col-xs-12 text_row">
						<h4 class="webBody_title"><?php echo ($vo1["auth_name"]); ?></h4>
						<ul>
							<?php if(is_array($sonInfo)): $i = 0; $__LIST__ = $sonInfo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i; if($vo2['auth_pid'] == $vo1['auth_id']): ?><li><span class="glyphicon glyphicon-plus-sign"></span><a href="/team/index.php/Home/Second/index/name/<?php echo (md5pid($vo2["auth_pid"])); ?>/gbrk/<?php echo ($vo2["auth_a"]); ?>"><?php echo ($vo2["auth_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; ?>
						</ul>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
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