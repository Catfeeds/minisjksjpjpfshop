<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minisjksjpjpfshop/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minisjksjpjpfshop/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minisjksjpjpfshop/Public/ht/js/action.js"></script>
</head>
<body>
<div class="aaa_pts_show_1">【 店铺分类管理 】</div>

<div class="aaa_pts_show_2">
    
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('index');?>">全部分类</a></div>
       <div class="aaa_pts_4"><a href="<?php echo U('add');?>">添加分类</a></div>
    </div>
    <div class="aaa_pts_3">
      <form action="<?php echo U('save');?>" method="post" onsubmit="return ac_from();" enctype="multipart/form-data">
      <ul class="aaa_pts_5">
         <li>
            <div class="d1">分类名称:</div>
            <div>
              <input class="inp_1" name="name" id="name" value="<?php echo $brand_info['name']; ?>"/>
            </div>
         </li>
         <li><input type="submit" name="submit" value="提交" class="aaa_pts_web_3" border="0" >
            <input type="hidden" name="id" id="id" value="<?php echo $brand_info['id']; ?>">
         </li>
      </ul>
      </form>
         
    </div>
    
</div>
<script>
function ac_from(){

  var name=document.getElementById('name').value;
  
  if(!name){
	  alert('请输入分类名称！');
	  return false;
	} 
}

</script>
</body>
</html>