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

<div class="aaa_pts_show_1">【 栏目管理 】</div>

<div class="aaa_pts_show_2">
    <div class="aaa_pts_3"><span style="color:red">备注：产品分类建议4个字以内，否则在小程序端不能显示完整</span>
      <table class="pro_3">
         <tr class="tr_1">
           <td style="width:80px;">栏目ID</td>
           <td>栏目名称</td>
           <td style="width:80px;">属性</td>
           <td style="width:110px;">排序</td>
           <td style="width:200px;">操作选项</td>
         </tr>
         <?php foreach ($list as $k => $v) { ?>	
          <tr data-id="tr_<?php echo $v['tid']; ?>">
			<td><?php echo $v['id']; ?></td>
			<td style="text-align:left; padding-left:15px;">- <?php echo $v['name']; ?></td>
			<td><?php if($v['bz_2']=='1') { ?><font style="color:#090">推荐</font><?php } ?></td>
			<td></td>
			<td>
			    <!-- <a href="<?php echo U('set_tj');?>?tj_id=<?php echo ($tr1["id"]); ?>">推荐</a> -->
			    <?php if($v['bz_4']=='1') { ?>
			    	| <a href="<?php echo U('add');?>?cid=<?php echo $v['id']; ?>">修改</a> | 
					<a onclick="del_id_url(<?php echo $v['id']; ?>)">删除</a>
				<?php } ?>	
			</td>
		  </tr>
		  <?php foreach ($v['list2'] as $k2 => $v2) { ?>
		  <tr data-id="tr_<?php echo $v2['tid']; ?>">
			<td><?php echo $v2['id']; ?></td>
			<td style="text-align:left; padding-left:15px;">&nbsp; &nbsp; &nbsp;- <?php echo $v2['name']; ?></td>
			<td><!-- <?php if($tr2["bz_2"] == 1): ?><font style="color:#090">推荐</font><?php endif; ?> --></td>
			<td></td>
			<td>
			    <!-- <a href="<?php echo U('set_tj');?>?tj_id=<?php echo ($tr2["id"]); ?>">推荐</a> |  -->
				<a href="<?php echo U('add');?>?cid=<?php echo $v2['id']; ?>">修改</a> | 
				<a onclick="del_id_url(<?php echo $v2['id']; ?>)">删除</a>
			</td>
		  </tr>
		  <?php foreach ($v2['list3'] as $k3 => $v3) { ?>
		  <tr data-id="tr_<?php echo $v3['tid']; ?>">
			 <td><?php echo $v3['id']; ?></td>
			 <td style="text-align:left; padding-left:15px;">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;- <?php echo $v3['name']; ?></td>
			 <td><?php if($v3['bz_2']=='1') { ?><font style="color:#090">推荐</font><?php } ?></td>
			 <td><?php echo $v3['sort']; ?></td>
			 <td>
			    <a href="<?php echo U('set_tj');?>?tj_id=<?php echo $v3['id']; ?>">推荐</a> | 
				<a href="<?php echo U('add');?>?cid=<?php echo $v3['id']; ?>">修改</a> | 
				<a onclick="del_id_url(<?php echo $v3['id']; ?>)">删除</a>
			 </td>
		  </tr>
			<volist name='tr3["list4"]' id='tr4'>
			<?php foreach ($v3['list4'] as $k4 => $v4) { ?>
			  <tr data-id="tr_<?php echo $v4['tid']; ?>">
				<td><?php echo $v4['id']; ?></td>
				<td style="text-align:left; padding-left:15px;">&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp;-- <?php echo $v4['name']; ?></td>
				<td><?php if($v4['bz_2']=='1') { ?><font style="color:#090">推荐</font><?php } ?></td>
				<td><?php echo $v4['sort']; ?></td>
				<td>
				    <a href="<?php echo U('set_tj');?>?tj_id=<?php echo $v4['id']; ?>">推荐</a> | 
					<a href="<?php echo U('add');?>?cid=<?php echo $v4['id']; ?>">修改</a> | 
					<a onclick="del_id_url(<?php echo $v4['id']; ?>)">删除</a>
				</td>
			  </tr>
			<?php } ?>
		 <?php } ?>
		 <?php } ?>
         <?php } ?>
     </table>
    </div>
    
</div>
<script>
function del_id_url(id){
   if(confirm("确认删除吗？"))
   {
	  location='<?php echo U("del");?>?did='+id;
   }
}
</script>
</body>
</html>