<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<style type="text/css">
*{
	margin: 0;
	padding: 0;
	text-transform: none;
	text-decoration: none;
}
html,body{
	background: #f4f3ef;
	width: 100%;

}
.box{
	text-align: center;
	
}

h1{
	color: #fd6703;
    margin-bottom: 40px;
    margin-top: 50px;
}
#img{
	 margin-bottom: 40px;
	 max-width: 100%;
}
a{
	background: #e5e5e5;
	color: #fd6703;
	display: inline-block;
	width: 150px;
	height: 50px;
	border-radius: 20px;
	text-align: center;
	line-height: 50px;
	font-size: 20px;
	font-weight: bold;
	margin-left: 10px;
	
}
a:hover{
	background: #fd6703;
	color: white;
}
.active{
	background: #fd6703;
	color: white;
}

	</style>
</head>
<body>
<div class="box">
<h1><img src="/team/Public/Admin/images/404_1.png">很抱歉，您访问的界面不存在</h1>
	<img src="/team/Public/Admin/images/404.png" id="img"><br/>
	<a href="#" onclick="history.go(-1)">访问上一页</a>
	</div>
</body>
</html>