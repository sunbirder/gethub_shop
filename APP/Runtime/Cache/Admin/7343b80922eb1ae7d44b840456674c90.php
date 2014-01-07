<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>ECSHOP 管理中心 - 订单列表 </title>
<meta name="robots" content="noindex, nofollow">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link href="__CSS__/general.css" rel="stylesheet" type="text/css" />
<link href="__CSS__/main.css" rel="stylesheet" type="text/css" />
<!-- <script type="text/javascript" src="__JS__/transport.js"></script> -->
<!-- <script type="text/javascript" src="__JS__/common.js"></script> -->
<script type="text/javascript" src="__JS__/jquery-1.5.1.min.js"></script>
<script language="JavaScript">
  $(function(){

     $("#btnRemove").click(function(){
       var num=0;
       var data=new Array();
       $("input:checkbox:checked").each(function(index){
           ++num;
           data[index]=$(this).val();
       })
       if(num>0){
          var result=confirm("你确定要删除吗");
          // alert(result);
          if(result){
             $.post("<?php echo U(GROUP_NAME.'/Order/delete_order');?>",{orderId:data},function(msg){
                 if(msg==1){
                  location.reload();
                  alert("删除成功");
                  
                 }else{
                  alert("删除失败");
                 }
                 // alert(msg);
             })
          //  alert("aa");
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
<!-- <span class="action-span"><a href="order.php?act=order_query">订单查询</a></span> -->
<span class="action-span1"><a href="index.php?act=main">ECSHOP 管理中心</a> </span>
<span id="search_id" class="action-span1"> - 订单列表 </span>
<div style="clear:both"></div>
</h1>
<div class="form-div">
  <form action="<?php echo U(GROUP_NAME.'/Order/order_select');?>" name="searchForm">
    <img src="__IMG__/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    订单号<input name="order_sn" type="text" id="order_sn" size="15">
    收货人<input name="consignee" type="text" id="consignee" size="15">
    订单状态
    <select name="status" id="status">
      <option value="0"selected>请选择...</option>
      <option value="1">待确认</option>
      <option value="2">已确认</option>
      <option value="3">无效</option>
      <option value="4">待付款</option>
      <option value="5">已付款</option>
      <option value="6">待发货</option>
      <option value="7">已发货</option>
      <option value="8">已完成</option>
      <option value="9">退货</option>
      <option value="10">已取消</option>
    </select>
    <input type="submit" value=" 搜索 " class="button" id="order_select"/>
  </form>
</div>

<!-- 订单列表 -->
<form method="post" action="" name="listForm" onsubmit="return check()">
  <div class="list-div" id="listDiv">

<table cellpadding="3" cellspacing="1">
  <tr>
    <th>
      <input type="checkbox" />
      <a >订单号</a>
    </th>
    <th>
      <a href="">下单时间</a>
      <img src="__IMG__/sort_desc.gif"></th>
    <th><a href="">收货人</a></th>
    <th><a href="">总金额</a></th>
    <th><a href="">应付金额</a></th>
    <th style="width:200px">订单状态</th>
    <th>操作</th>
  <tr>
    <?php if(is_array($list)): foreach($list as $key=>$v): ?><tr>
        <td valign="top" nowrap="nowrap">
          <input type="checkbox" name="checkboxes" class="order_checkboxes" value="<?php echo ($v["order_sn"]); ?>" />
          <a href="" id="order_0"><?php echo ($v["order_sn"]); ?></a>
        </td>
        <td><?php echo (date('Y m d H:i:s',$v["add_time"])); ?><br /></td>
        <td align="left" valign="top"><a href="mailto:"><?php echo ($v["consignee"]); ?></a> <br /></td>
        <td align="right" valign="top" nowrap="nowrap"><?php echo ($v["goods_amount"]); ?></td>
        <td align="right" valign="top" nowrap="nowrap"><?php echo ($v["order_amount"]); ?></td>
        <td align="center" valign="top" nowrap="nowrap">
            <?php if($v["order_status"] == 0): ?>待确定
                  <?php elseif($v["order_status"] == 1): ?>
                  已确认
                  <?php elseif($v["order_status"] == 2): ?>
                  已取消
                  <?php elseif($v["order_status"] == 3): ?>
                  无效
                  <?php elseif($v["order_status"] == 4): ?>
                  退货<?php endif; ?>,

            <?php if($v["pay_status"] == 0): ?>待付款
                  <?php elseif($v["pay_status"] == 1): ?>
                  付款中
                  <?php elseif($v["pay_status"] == 2): ?>
                  已付款<?php endif; ?>,

            <?php if($v["shipping_status"] == 0): ?>待发货
                  <?php elseif($v["shipping_status"] == 1): ?>
                  已发货
                  <?php elseif($v["shipping_status"] == 2): ?>
                  已完成
                  <?php elseif($v["shipping_status"] == 3): ?>
                  退货<?php endif; ?>

         </td>
        <td align="center" valign="top"  nowrap="nowrap">
         <a href="<?php echo U(GROUP_NAME.'/Order/alert_order',array('order_id'=>$v['order_sn']),'');?>">修改</a>
        </td>
      </tr><?php endforeach; endif; ?>
  </table>

<!-- 分页 -->
<table id="page-table" cellspacing="0">
  <tr>
    <td align="left" nowrap="true">
      <?php echo ($show); ?>
    </td>
  </tr>
</table>

  </div>
  <div>
   <!--  <input name="confirm" type="submit" id="btnSubmit" value="确认" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="invalid" type="submit" id="btnSubmit1" value="无效" class="button" disabled="true" onclick="this.form.target = '_self'" />
    <input name="cancel" type="submit" id="btnSubmit2" value="取消" class="button" disabled="true" onclick="this.form.target = '_self'" /> -->
    <input name="remove" type="button" id="btnRemove" value="删除订单" class="button"/>
    <input name="print" type="button" id="btnSubmit4" value="打印订单" class="button" />
    <input name="batch" type="hidden" value="1" />
    <input name="order_id" type="hidden" value="" />
  </div>
</form>
</body>
</html>