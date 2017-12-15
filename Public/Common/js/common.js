//前台页面向服务器获取新闻和公告的阅读量
function postServer(obj,url,id){
	var countIds = {};
	$.each(obj, function(i){
		countIds[i] = $(this).attr(id);
	});
	$.post(url,countIds,function(result){
		if(result.status == 1){
			counts = result.data;
			$.each(counts,function(id,count){
				$(".node-"+id).html(count);
			});
		}
	},"json");
};

//图片上传
function uploadFly(postUrl, Rurl){
	var formData = new FormData($("#uploadFiyForm" )[0]);
	$.ajax({
	       url: postUrl,
	       type: 'POST',  
	       data: formData,  
	       dataType:'json',
	       async: false,  
	       cache: false,  
	       contentType: false,
	       processData: false,
	       success: function (response) {  
	           	if(response.status == 1){
	           		$('.showUserPic img').attr('src',Rurl + response.data).width("300").height("300");
	               	$("#jcopPic").attr('src',Rurl + response.data);
	               	$("#filename").attr('value', response.data);
	               	$("#btn").attr('data-src',response.data);
	           	}else{
	           		dialog.error(response.message);
	           	}
	       },  
	}); 
}

// 登录-失去焦点
function loseBlur(root, Url){
	var adminUser_name = $('#adminUser_name').val();
	var postData = {'admin_name':adminUser_name};
	if (!adminUser_name) {
		$('#userGroup').removeClass('has-success has-error');
        $('#success').removeClass('glyphicon-ok glyphicon-remove');
		$('#defaultImg').attr('src',root + 'Uploads/userPic/asaf45f4aw5f.jpg');
	}else{
		$.post(Url,postData,function(result){
            if(result.status == 1){
            	$('#userGroup').removeClass('has-error').addClass('has-success');
            	$('#success').removeClass('glyphicon-remove').addClass('glyphicon-ok');
                $('#defaultImg').attr('src',root + '/Uploads/userPic/'+ result.data);
            }else{
            	$('#userGroup').removeClass('has-success').addClass('has-error');
            	$('#success').removeClass('glyphicon-ok').addClass('glyphicon-remove');
            }
        },"json");
	}
}

//ajax
function ajaxFn(postUrl, data, successUrl){
	$.ajax({
        type : 'POST',
        url : postUrl,
        data : data,
        dataType : 'json',
        success : function(result){
            if(result.status == 1){
                dialog.success(result.message,successUrl);
            }else{
                dialog.error(result.message);
            }
        }
    });
}

//图片上传
function uploadFiy(postUrl, data){
	$.ajax({
        type : 'POST',
        url : postUrl,
        data : data,
        secureuri:false,  
        fileElementId:"btn", 
        contentType: false,        /*不可缺*/
        processData: false,         /*不可缺*/
        dataType : 'json',
        success : function(result){
            if(result.status == 1){
                dialog.success(result.message);
            }else{
                dialog.error(result.message);
            }
        }
    });
}

//执行裁剪
function doUploadCrop(postUrl, successUrl){
	var w = parseInt($(".jcrop-holder>div:first").css("width"));
    var h = parseInt($(".jcrop-holder>div:first").css("height"));
    var x = parseInt($(".jcrop-holder>div:first").css("left"));
    var y = parseInt($(".jcrop-holder>div:first").css("top"));
    var data = {"picPath":$("#btn").attr("data-src"),"w":w,"h":h, "x":x, "y":y};
	$.ajax({
        type : 'POST',
        url : postUrl,
        data : data,
        dataType : 'json',
        success : function(result){
            if(result.status == 1){
                dialog.success(result.message,successUrl);
            }else{
                dialog.error(result.message);
            }
        }
    });
}

//编辑
function updateFn(postUrl){
	var data = $("input[name='operate']:checked");
    if(data.length != 1){
        dialog.error("个数非法");
        return;
    }
	window.location = postUrl + "?id=" + data[0]['defaultValue'];
};
//删除
$(function(){
	$(".del").click(function(){
	    var _this=this;
	    dialog.confirm("确定删除吗？",_this);
	    return false;
	});
});

//批量操作
function batch(text, url, successUrl){
    layer.open({
        type : 0,
        title : text,
        btn: ['yes', 'no'],
        icon : 3,
        closeBtn : 2,
        content: text,
        scrollbar: true,
        yes: function(){
        	var dataObject = {};
		    var data = $("input[name='operate']:checked");
		    $.each(data, function(i){
		        dataObject[i] = this.value;
		    });
            $.post(url, dataObject, 
            	function(result){
			        if(result.status == 1){
			            return dialog.success(result.message,successUrl);
		            }else{
		                return dialog.error(result.message);
		            }
		        }
		    ,"JSON");
        },
    });
};

//更新排序
function updateSort(data, text, url, successUrl){
    layer.open({
        type : 0,
        title : text,
        btn: ['yes', 'no'],
        icon : 3,
        closeBtn : 2,
        content: text,
        scrollbar: true,
        yes: function(){
            $.post(url, data,
            	function(result){
			        if(result.status == 1){
			            return dialog.success(result.message,successUrl);
		            }else{
		                return dialog.error(result.message);
		            }
		        }
		    ,"JSON");
        },
    });
};

function admin_passwordTow(){
	var admin_passwordTow = $("#admin_passwordTow").val();
	var admin_password = $("#admin_password").val();
	if(admin_passwordTow != admin_password){
		dialog.error("两次密码不匹配");
	}
}

function admin_email(){
	var admin_email = $('#admin_email').val();
	if(admin_email.length!=0){
	reg=/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/;
	if(!reg.test(admin_email)){
	dialog.error("邮箱格式不正确！");
	}
	}
}

function admin_phone(){
	var admin_phone = $('#admin_phone').val();
	if(admin_phone.length!=0){
	var phoneReg=/^1[3|4|5|8][0-9]\d{4,8}$/;
	if(!phoneReg.test(admin_phone)){
	dialog.error("手机格式格式不正确！");
	}
	}
}	

function admin_weChat(){
	var admin_weChat = $('#admin_weChat').val();
	if(admin_weChat.length!=0){
		var weChatReg = new RegExp("[\\u4E00-\\u9FFF]+","g");
	if(weChatReg.test(admin_weChat)){
	dialog.error("微信号不能有中文！");
	}
	}
}