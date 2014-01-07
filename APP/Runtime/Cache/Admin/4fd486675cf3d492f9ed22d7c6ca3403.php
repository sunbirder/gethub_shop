<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 会员列表 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__CSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__CSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery-1.5.1.min.js"></script>
<script language="JavaScript">
  $(function(){
     $("#btnSubmit").click(function(){
        var num=0;
        var data=new Array();
         $("input:checkbox:checked").each(function(index){
               ++num;
               data[index]=$(this).val();
         });
         if(num>0){
            var result=confirm("你确定要删除吗？");
            if(result){
              $.post("<?php echo U(GROUP_NAME.'/User/delete_user');?>",{userid:data},function(msg){
                  if(msg==1){
                    location.reload();
                    alert("删除成功");
                  }else{
                    alert("删除失败");
                  }
                  // alert(msg);
              })
            }
         }else{
            alert("请选择要移除的数据");
         }

     });
  })
</script>
</head>
<body>

<h1>
<span class="action-span"><a href="">添加会员</a></span>
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span>
<span id="search_id" class="action-span1"> - 会员列表 </span>
<div style="clear:both"></div>
</h1>
<div class="form-div">
  <form action="<?php echo U(GROUP_NAME.'/User/user_search');?>" name="searchForm" method="post">
   <!--  <img src="__IMG__/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    &nbsp;会员等级 <select name="user_rank"><option value="0">所有等级</option><option value="1">注册用户</option></select> -->
    &nbsp;会员积分大于&nbsp;<input type="text" name="pay_points_gt" size="8" />&nbsp;会员积分小于&nbsp;<input type="text" name="pay_points_lt" size="10" />
    &nbsp;会员姓名 &nbsp;<input type="text" name="keyword" /> <input type="submit" value=" 搜索 " />
  </form>
</div>

<form method="POST" action="" name="listForm">

<!-- start users list -->
<div class="list-div" id="listDiv">
<!--用户列表部分-->
<table cellpadding="3" cellspacing="1">
  <tr>
    <th style="width:100px">
      <a href="">会员账号</a><img src="__IMG__/sort_desc.gif">
    </th>
    <th style="width:120px"><a href="">会员姓名</a></th>
    <th style="width:120px"><a href="">email</a></th>
    <th><a href="">手机号码</a></th>
    <th  style="width:200px"><a href="">家庭住址</a></th>
    <th><a href="">可用资金</a></th>
    <th><a href="">消费积分</a></th>
    <th><a href="">操作</a></th>
  <tr>
  <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
      <td><input  type="checkbox" value="<?php echo ($v["user_id"]); ?>"/><?php echo ($v["user_name"]); ?></td>
      <td align="center"><?php echo ($v["consignee"]); ?></td>
      <td align="center" style="width:147px"><?php echo ($v["email"]); ?></td>
      <td align="center" style="width:165px"><?php echo ($v["mobile_phone"]); ?></td>
      <td><?php echo ($v["address"]); ?></td>
      <td align="center"><?php echo ($v["user_money"]); ?></td>
      <td align="center"><?php echo ($v["pay_points"]); ?></td>
      <td style="cursor:pointer;"align="center">
        <a href="<?php echo U(GROUP_NAME.'/User/alert_user',array('user_id'=>$v['user_id']),'');?>">修改</a>
      </td>
    </tr><?php endforeach; endif; ?>
  <tr>
      <td colspan="2">
        <input type="hidden" name="act" value="batch_remove" />
        <input type="button" id="btnSubmit" value="删除会员"  class="button" />
      </td>
      <td align="right" nowrap="true" colspan="8">
         <!--分页 -->
         <div id="turn-page">
          <?php echo ($show); ?>
         </div>
      </td>
  </tr>
</table>

</div>
</form>
</body>
</html>