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
<span class="action-span"><a href="<?php echo U(GROUP_NAME.'/Order/order_list');?>">订单列表</a></span>
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"> - 订单修改 </span>
<div style="clear:both"></div>
</h1>
<!-- <script type="text/javascript" src="../js/calendar.php"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" /> -->
<div class="main-div">
<form action="<?php echo U(GROUP_NAME.'/Order/alert_submit');?>" method="post" enctype="multipart/form-data" name="searchForm">
  <table cellspacing="1" cellpadding="3" width="100%">
    <tr>
      <td><div align="right"><strong>订单号：</strong></div></td>
      <td colspan="3">
        <input onfocus="this.blur()" style="background-color:#ebebe4" name="order_sn" type="text" id="order_sn" size="30" value="<?php echo ($data[0][order_sn]); ?>"/>
      </td>
    </tr>
    <tr>
      <td><div align="right"><strong>下单时间：</strong></div></td>
      <td><input onfocus="this.blur()" style="background-color:#ebebe4" name="order_time" type="text" id="order_time" size="20" value="<?php echo (date('Y-m-d H:i:s',$data[0][add_time])); ?>" ></td>
      <td><div align="right"><strong>收货人：</strong></div></td>
      <td><input name="consignee" type="text" id="consignee" size="20" value="<?php echo ($data[0][consignee]); ?>"></td>
    </tr>
    <tr>
      <td><div align="right"><strong>总金额：</strong></div></td>
      <td>
        <input name="goods_amount" type="text" id="goods_amount" size="20" value="<?php echo ($data[0][goods_amount]); ?>">
      </td>
      <td><div align="right"><strong>应付金额：</strong></div></td>
      <td>
        <input name="order_amount" type="text" id="order_amount" size="20" value="<?php echo ($data[0][order_amount]); ?>">
      </td>
    </tr>
    <tr>
      <td><div align="right"><strong>订单状态：</strong></div></td>
      <td style="width:150px">
        <select name="order_status" type="text" id="order_status" style="width:146px">
          <option value="0" id="aa">待确认</option>
          <option value="1">已确认</option>
          <option value="2">已取消</option>
          <option value="3">无效</option>
          <option value="4">退货</option>
        </select>
      </td>
     
      <td><div align="right"><strong>支付状态：</strong></div></td>
      <td style="width:150px">
        <select name="pay_status" type="text" id="pay_status" style="width:146px">
          <option value="0">待付款</option>
          <option value="2">已付款</option>    
        </select>
      </td>

      <td><div align="right"><strong>配送情况：</strong></div></td>
      <td style="width:150px">
        <select name="shipping_status" type="text" id="shipping_status" style="width:146px">
          <option value="0">待发货</option>
          <option value="1">已发货</option>
          <option value="2">已完成</option>
          <option value="3">退货</option>
        </select>
      </td>
    </tr>
    <tr>
      <td colspan="6"><div align="center">
        <input name="query" type="submit" class="button" id="alter" value=" 修改订单 " />
        <a href="<?php echo U(GROUP_NAME.'/Order/order_list');?>"><input name="reset" type="button" class='button' id="return" value=' 返回订单列表 ' /></a>
      </div></td>
      </tr>
  </table>
</form>
</div>
</body>
</html>