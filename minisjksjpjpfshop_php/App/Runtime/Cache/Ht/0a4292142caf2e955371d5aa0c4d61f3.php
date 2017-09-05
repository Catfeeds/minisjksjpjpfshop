<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>后台管理</title>
<link href="/minisjksjpjpfshop/Public/ht/css/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="/minisjksjpjpfshop/Public/ht/js/jquery.js"></script>
<script type="text/javascript" src="/minisjksjpjpfshop/Public/ht/js/action.js"></script>
</head>
<body>

<div class="aaa_pts_show_1">【 优惠券管理 】</div>

<div class="aaa_pts_show_2">
    <div>
       <div class="aaa_pts_4"><a href="<?php echo U('index');?>">全部优惠券</a></div>
       <div class="aaa_pts_4"><a href="<?php echo U('add');?>">添加优惠券</a></div>
    </div>
    <div class="aaa_pts_3">

      <div class="pro_4 bord_1">
         <div class="pro_5">优惠券名称：<input type="text" class="inp_1 inp_6" id="keyword" value="<?php echo ($keyword); ?>"></div>
         <div class="pro_6"><input type="button" class="aaa_pts_web_3" value="搜 索" style="margin:0;" onclick="product_option(0);"></div>
      </div>
      
      <table class="pro_3">
         <tr class="tr_1">
           <td style="width:80px;">ID</td>
           <td>满减金额</td>
           <td style="width:140px;">开始时间</td>
           <td style="width:140px;">过期时间</td>
           <td style="width:80px;">所需积分</td>
           <td style="width:80px;">发行数量</td>
           <td style="width:80px;">已领取</td>
           <td style="width:100px;">使用属性</td>
           <td style="width:180px;">操作</td>
         </tr>
         <tbody id="news_option">
         <!-- 遍历 -->
          <?php if(is_array($voucher_list)): $i = 0; $__LIST__ = $voucher_list;if( count($__LIST__)==0 ) : echo "暂时没有数据" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><tr>
             <td><?php echo ($v["id"]); ?></td>
             <td>满<span style="color:red;"><?php echo ($v["full_money"]); ?></span>减<span style="color:red;"><?php echo ($v["amount"]); ?></span></td>
             <td><?php echo ($v["start_time"]); ?></td>
             <td><?php echo ($v["end_time"]); ?></td>
             <td><?php if($v["point"] == 0): ?>免费领取<?php else: echo ($v["point"]); endif; ?></td>
             <td><?php echo ($v["count"]); ?></td>
             <td><?php echo ($v["receive_num"]); ?></td>
             <td>
                <?php if($v["proid"] == 'all'): ?><a class="label succ">店内通用</a><?php else: ?><a class="label fail">限定商品</a><?php endif; ?>
             </td>
            <td>
              <a href="<?php echo U('add');?>?id=<?php echo ($v["id"]); ?>&page=<?php echo ($page); ?>&keyword=<?php echo ($keyword); ?>">修改</a> | 
              <a onclick="del_id_url2(<?php echo ($v["id"]); ?>)">删除</a>
            </td>
           </tr><?php endforeach; endif; else: echo "暂时没有数据" ;endif; ?>
         <!-- 遍历 -->
         </tbody>
         <tr>
            <td colspan="10" class="td_2">
                  <?php echo ($page_index); ?>  
             </td>
         </tr>
      </table>      
    </div>
</div>
<script>
function product_option(page){
  var obj={
	   "name":$("#name").val(),
	  }
	  //alert(obj);exit();
  var url='?page='+page;
  $.each(obj,function(a,b){
	  url+='&'+a+'='+b;
	 });
  location=url;
}

function del_id_url2(id){
  if (confirm('您确定要删除吗？')) {
    window.location.href="<?php echo U('del');?>?did="+id;
  };
  
}

//推荐设置
function pro_tj(id,type){
  if (!id) {
    return;
  }
  $.post("<?php echo U('set_grouptj');?>",{id:id},function(data){
    if (data.status==1) {
      if (type==1) {
        document.getElementById('spans_'+id).innerHTML='<a class="label succ" onclick="pro_tj('+id+',0);">已推荐</a>';
      }else{
        document.getElementById('spans_'+id).innerHTML='<a class="label err" onclick="pro_tj('+id+',1);">前台推荐</a>';
      }
    }else{
      alert(data.err);
      return false;
    }
  },'json');
}
</script>
</body>
</html>