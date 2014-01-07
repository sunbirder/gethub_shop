<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 订单查询 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__CSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__CSS__/main.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="__JS__/jquery-1.5.1.min.js"></script>
<script language="JavaScript">
   $(function(){
      $("#order_status").val("<?php echo ($data[0][order_status]); ?>");
      $("#pay_status").val("<?php echo ($data[0][pay_status]); ?>");
      $("#shipping_status").val("<?php echo ($data[0][shipping_status]); ?>");
   })
</script>
</head>
<body>

<h1>
<span class="action-span"><a href="<?php echo U(GROUP_NAME.'/User/user_list');?>">会员列表</a></span>
<span class="action-span1"><a href="">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 用户信息修改 </span>
<div style="clear:both"></div>
</h1>
<!-- <script type="text/javascript" src="../js/calendar.php"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" /> -->
<div class="main-div">
<form action="<?php echo U(GROUP_NAME.'/User/alert_user_submit');?>" method="post" enctype="multipart/form-data" name="searchForm">
  <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td><div align="right"><strong>会员账号：</strong></div></td>
      <td colspan="3">
        <input onfocus="this.blur()" style="background-color:#ebebe4" name="user_sn" type="text" id="user_sn" value="<?php echo ($data[0][user_name]); ?>"/>
      </td>
     <td><input type="hidden" name="user_id" value="<?php echo ($data[0][user_id]); ?>"/></td>
    </tr>
    <tr>
      <td><div align="right"><strong>会员姓名：</strong></div></td>
      <td><input name="user_name" type="text" id="user_name" size="20" value="<?php echo ($data[0][consignee]); ?>"></td>
      <td><div ><strong>email：</strong></div></td>
      <td><input  name="user_email" type="text" id="user_email" size="20" value="<?php echo ($data[0][email]); ?>" ></td>
      <td><div align="right"><strong>手机号码：</strong></div></td>
      <td><input name="user_phone" type="text" id="user_phone" size="20" value="<?php echo ($data[0][mobile_phone]); ?>"></td>
    </tr>

    <tr>
      <td><div align="right"><strong>家庭住址：</strong></div></td>
      <td colspan="4"><input name="user_address" type="text" id="user_address" size="72" value="<?php echo ($data[0][address]); ?>"></td>
    </tr>

    <tr>
      <td><div align="right"><strong>可用资金：</strong></div></td>
      <td><input name="user_money" type="text" id="user_money" size="20" value="<?php echo ($data[0][user_money]); ?>" ></td>
      <td><div align="right"><strong>会员积分：</strong></div></td>
      <td><input name="user_point" type="text" id="user_point" size="20" value="<?php echo ($data[0][pay_points]); ?>"></td>
    </tr>

    <tr>
      <td colspan="6"><div align="center">
        <input name="query" type="submit" class="button" id="alter" value=" 修改信息 " />
        <a href="<?php echo U(GROUP_NAME.'/User/user_list');?>"><input name="reset" type="button" class='button' id="return" value=' 返回用户列表 ' /></a>
      </div></td>
      </tr>
  </table>
</form>
</div>
</body>
</html>