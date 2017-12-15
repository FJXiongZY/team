<?php
	function show($status,$message,$data=array()){
		$result = array(
			"status" => $status,
			"message" => $message,
			"data"	=>	$data,
		);
		exit(json_encode($result)); 
	}

	function getStatus($data){
		$str = '展示';
		if ($data == 1) {
			return $str;
		}else{
			return $str = '隐藏';
		}
	}

	function getCategory($data){
		$str = "后台菜单";
		if($data == 1){
			return $str;
		}else if($data == 2){
			return $str = '前台导航';
		}
	}

	function getUserStatus($data){
		$str = '正常';
		if ($data == 1) {
			return $str;
		}else{
			return $str = '禁用';
		}
	}

	function getFrontStatus($data){
		$str = "未上线";
		if($data == 2){
			return $str;
		}else if($data == 1){
			return $str = '上线';
		}
	}

	function getLevel($data){
		if ($data == 0) {
			return $str = '最强王者';
		}else{
			$role = M('role');
			$curRole = $role->where("role_id='$data'")->find();
			$curLevel = $curRole['role_name'];
			return $curLevel;
		}
	}

	function getPuppet($data){
		if($data == 1){
			return '非法入侵';
		}
		return $data;
	}

	function getSex($data){
		if($data == 0){
			return $str = '女';
		}else if($data == 1){
			return $str = '男';
		}
	}

	function isNull($data){
		if(empty($data) || !isset($data)){
			return "<span style='color:red;'>请完善个人资料</span>";
		}else{
			return $data;
		}
	}

	function isUserInfo($data){
		if(empty($data) || !isset($data)){
			return "<span style='color:red;'>这个人很懒，什么都没留下</span>";
		}else{
			return $data;
		}
	}

	function getIpCity($data){
		$Ip = new \Org\Net\IpLocation('UTFWry.dat');
        return $Ip->getlocation($data)['country'];
	}

	function md5Pid($data){
		$count = strlen($data);
		$str = md5(md5($data)."@#$@%#&$$@*&465asdfEWRa.&)&*^$@$@^*^");
		return substr($str, 0, (strlen($str)-($count+1))).$data.$count;
	}

	function getFrontParent($data){
		return M("Authmenu")->where("auth_id={$data}")->field("auth_name")->find()['auth_name'];
	}
