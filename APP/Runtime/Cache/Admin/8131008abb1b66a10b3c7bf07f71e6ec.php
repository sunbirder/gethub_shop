<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0048)http://localhost/ecshop/admin/index.php?act=main -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ECSHOP 管理中心</title>
<meta name="robots" content="noindex, nofollow">

<link href="__CSS__/general.css" rel="stylesheet" type="text/css">
<link href="__CSS__/main.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="__JS__/transport.js"></script>
<script type="text/javascript" src="__JS__/common.js"></script>
<script language="JavaScript">
<!--
// 这里把JS用到的所有语言都赋值到这里
var process_request = "正在处理您的请求...";
var todolist_caption = "记事本";
var todolist_autosave = "自动保存";
var todolist_save = "保存";
var todolist_clear = "清除";
var todolist_confirm_save = "是否将更改保存到记事本？";
var todolist_confirm_clear = "是否清空内容？";
var expand_all = "展开";
var collapse_all = "闭合";
var shop_name_not_null = "商店名称不能为空";
var good_name_not_null = "商品名称不能为空";
var good_category_not_null = "商品分类不能为空";
var good_number_not_number = "商品数量不是数值";
var good_price_not_number = "商品价格不是数值";
//-->
</script>
</head>
<body style="cursor: auto;">

<h1>
<span class="action-span1"><a href="right.htm">ECSHOP 管理中心</a> </span><span id="search_id" class="action-span1"></span>
<div style="clear:both"></div>
</h1>
<!-- directory install start -->
<ul id="lilist" style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
    <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;">您还没有删除 install 文件夹，出于安全的考虑，我们建议您删除 install 文件夹。</li>
    <li style="border: 1px solid #CC0000; background: #FFFFCC; padding: 10px; margin-bottom: 5px;">您还没有删除 demo 文件夹，出于安全的考虑，我们建议您删除 demo 文件夹。</li>
  </ul>
<ul style="padding:0; margin: 0; list-style-type:none; color: #CC0000;">
 <!-- <script type="text/javascript" src="http://bbs.ecshop.com/notice.php?v=1&n=8&f=ul"></script>-->
</ul>
<!-- directory install end -->
<!-- start personal message -->
<!-- end personal message -->
<!-- start order statistics -->
<div class="list-div">
<table cellspacing="1" cellpadding="3">
  <tbody><tr>
    <th colspan="4" class="group-title">订单统计信息</th>
  </tr>
  <tr>
    <td width="20%"><a href="http://localhost/ecshop/admin/order.php?act=list&composite_status=101">待发货订单:</a></td>
    <td width="30%"><strong style="color: red">4</strong></td>
    <td width="20%"><a href="http://localhost/ecshop/admin/order.php?act=list&composite_status=0">未确认订单:</a></td>
    <td width="30%"><strong>2</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/order.php?act=list&composite_status=100">待支付订单:</a></td>
    <td><strong>3</strong></td>
    <td><a href="http://localhost/ecshop/admin/order.php?act=list&composite_status=102">已成交订单数:</a></td>
    <td><strong>3</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/goods_booking.php?act=list_all">新缺货登记:</a></td>
    <td><strong>2</strong></td>
    <td><a href="http://localhost/ecshop/admin/user_account.php?act=list&process_type=1&is_paid=0">退款申请:</a></td>
    <td><strong>0</strong></td>
  </tr>
</tbody></table>
</div>
<!-- end order statistics -->
<br>
<!-- start goods statistics -->
<div class="list-div">
<table cellspacing="1" cellpadding="3">
  <tbody><tr>
    <th colspan="4" class="group-title">实体商品统计信息</th>
  </tr>
  <tr>
    <td width="20%">商品总数:</td>
    <td width="30%"><strong>21</strong></td>
    <td width="20%"><a href="http://localhost/ecshop/admin/goods.php?act=list&stock_warning=1">库存警告商品数:</a></td>
    <td width="30%"><strong style="color: red">8</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_new">新品推荐数:</a></td>
    <td><strong>11</strong></td>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_best">精品推荐数:</a></td>
    <td><strong>10</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_hot">热销商品数:</a></td>
    <td><strong>11</strong></td>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_promote">促销商品数:</a></td>
    <td><strong>0</strong></td>
  </tr>
</tbody></table>
</div>
<br>
<!-- Virtual Card -->
<div class="list-div">
<table cellspacing="1" cellpadding="3">
  <tbody><tr>
    <th colspan="4" class="group-title">虚拟卡商品统计</th>
  </tr>
  <tr>
    <td width="20%">商品总数:</td>
    <td width="30%"><strong>6</strong></td>
    <td width="20%"><a href="http://localhost/ecshop/admin/goods.php?act=list&stock_warning=1&extension_code=virtual_card">库存警告商品数:</a></td>
    <td width="30%"><strong style="color: red">2</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_new&extension_code=virtual_card">新品推荐数:</a></td>
    <td><strong>1</strong></td>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_best&extension_code=virtual_card">精品推荐数:</a></td>
    <td><strong>4</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_hot&extension_code=virtual_card">热销商品数:</a></td>
    <td><strong>6</strong></td>
    <td><a href="http://localhost/ecshop/admin/goods.php?act=list&intro_type=is_promote&extension_code=virtual_card">促销商品数:</a></td>
    <td><strong>0</strong></td>
  </tr>
</tbody></table>
</div>
<!-- end order statistics -->
<br>
<!-- start access statistics -->
<div class="list-div">
<table cellspacing="1" cellpadding="3">
  <tbody><tr>
    <th colspan="4" class="group-title">访问统计</th>
  </tr>
  <tr>
    <td width="20%">今日访问:</td>
    <td width="30%"><strong>0</strong></td>
    <td width="20%">在线人数:</td>
    <td width="30%"><strong>2</strong></td>
  </tr>
  <tr>
    <td><a href="http://localhost/ecshop/admin/user_msg.php?act=list_all">最新留言:</a></td>
    <td><strong>1</strong></td>
    <td><a href="http://localhost/ecshop/admin/comment_manage.php?act=list">未审核评论:</a></td>
    <td><strong>1</strong></td>
  </tr>
</tbody></table>
</div>
<!-- end access statistics -->
<br>
<!-- start system information -->
<div class="list-div">
<table cellspacing="1" cellpadding="3">
  <tbody><tr>
    <th colspan="4" class="group-title">系统信息</th>
  </tr>
  <tr>
    <td width="20%">服务器操作系统:</td>
    <td width="30%">WINNT (127.0.0.1)</td>
    <td width="20%">Web 服务器:</td>
    <td width="30%">Apache/2.2.22 (Win32) PHP/5.3.13</td>
  </tr>
  <tr>
    <td>PHP 版本:</td>
    <td>5.3.13</td>
    <td>MySQL 版本:</td>
    <td>5.5.24-log</td>
  </tr>
  <tr>
    <td>安全模式:</td>
    <td>否</td>
    <td>安全模式GID:</td>
    <td>否</td>
  </tr>
  <tr>
    <td>Socket 支持:</td>
    <td>是</td>
    <td>时区设置:</td>
    <td>Asia/Shanghai</td>
  </tr>
  <tr>
    <td>GD 版本:</td>
    <td>GD2 ( JPEG GIF PNG)</td>
    <td>Zlib 支持:</td>
    <td>是</td>
  </tr>
  <tr>
    <td>IP 库版本:</td>
    <td>20071024</td>
    <td>文件上传的最大大小:</td>
    <td>2M</td>
  </tr>
  <tr>
    <td>ECShop 版本:</td>
    <td>v2.7.2 RELEASE 20100505</td>
    <td>安装日期:</td>
    <td>2013-11-16</td>
  </tr>
  <tr>
    <td>编码:</td>
    <td>UTF-8</td>
    <td></td>
    <td></td>
  </tr>
</tbody></table>
</div>

<script type="text/javascript" src="__JS__/utils.js"></script>
<script type="Text/Javascript" language="JavaScript">
<!--
onload = function()
{
  /* 检查订单 */
  startCheckOrder();
}
  //Ajax.call('index.php?is_ajax=1&act=main_api','', start_api, 'GET', 'TEXT','FLASE');

   function start_api(result)
    {
      apilist = document.getElementById("lilist").innerHTML;
      document.getElementById("lilist").innerHTML =result+apilist;
      if(document.getElementById("mar") != null)
      {
        var Mar = document.getElementById("mar");
        lis = Mar.getElementsByTagName('div');
        //alert(lis.length); //显示li元素的个数
        if(lis.length>3)
        {
          api_styel();
        }      
      }


    }
      function api_styel()
      {
        if(document.getElementById("mar") != null)
        {
            var Mar = document.getElementById("mar");
            if (Browser.isIE)
            {
              Mar.style.height = "52px";
            }
            else
            {
              Mar.style.height = "36px";
            }
            
            var child_div=Mar.getElementsByTagName("div");

        var picH = 16;//移动高度
        var scrollstep=2;//移动步幅,越大越快
        var scrolltime=30;//移动频度(毫秒)越大越慢
        var stoptime=4000;//间断时间(毫秒)
        var tmpH = 0;
        
        function start()
        {
          if(tmpH < picH)
          {
            tmpH += scrollstep;
            if(tmpH > picH )tmpH = picH ;
            Mar.scrollTop = tmpH;
            setTimeout(start,scrolltime);
          }
          else
          {
            tmpH = 0;
            Mar.appendChild(child_div[0]);
            Mar.scrollTop = 0;
            setTimeout(start,stoptime);
          }
        }
        setTimeout(start,stoptime);
        }
      }
//-->
</script>

<div id="footer">
共执行 28 个查询，用时 0.100870 秒，Gzip 已禁用，内存占用 4.404 MB<br>
版权所有 © 2005-2010 上海商派网络科技有限公司，并保留所有权利。</div>
<!-- 新订单提示信息 -->
<div id="popMsg">
  <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#cfdef4" border="0">
  <tbody><tr>
    <td style="color: #0f2c8c" width="30" height="24"></td>
    <td style="font-weight: normal; color: #1f336b; padding-top: 4px;padding-left: 4px" valign="center" width="100%"> 新订单通知</td>
    <td style="padding-top: 2px;padding-right:2px" valign="center" align="right" width="19"><span title="关闭" style="cursor: hand;cursor:pointer;color:red;font-size:12px;font-weight:bold;margin-right:4px;" onclick="Message.close()">×</span><!-- <img title=关闭 style="cursor: hand" onclick=closediv() hspace=3 src="msgclose.jpg"> --></td>
  </tr>
  <tr>
    <td style="padding-right: 1px; padding-bottom: 1px" colspan="3" height="70">
    <div id="popMsgContent">
      <p>您有 <strong style="color:#ff0000" id="spanNewOrder">1</strong> 个新订单以及       <strong style="color:#ff0000" id="spanNewPaid">0</strong> 个新付款的订单</p>
      <p align="center" style="word-break:break-all"><a href="http://localhost/ecshop/admin/order.php?act=list"><span style="color:#ff0000">点击查看新订单</span></a></p>
    </div>
    </td>
  </tr>
  </tbody></table>
</div>

<!--
<embed src="__IMG__/online.wav" width="0" height="0" autostart="false" name="msgBeep" id="msgBeep" enablejavascript="true"/>
-->
<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" id="msgBeep" width="1" height="1">
  <param name="movie" value="__IMG__/online.swf">
  <param name="quality" value="high">
  <embed src="__IMG__/online.swf" name="msgBeep" id="msgBeep" quality="high" width="0" height="0" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash">
  
</object>

<script language="JavaScript">
document.onmousemove=function(e)
{
  var obj = Utils.srcElement(e);
  if (typeof(obj.onclick) == 'function' && obj.onclick.toString().indexOf('listTable.edit') != -1)
  {
    obj.title = '点击修改内容';
    obj.style.cssText = 'background: #278296;';
    obj.onmouseout = function(e)
    {
      this.style.cssText = '';
    }
  }
  else if (typeof(obj.href) != 'undefined' && obj.href.indexOf('listTable.sort') != -1)
  {
    obj.title = '点击对列表排序';
  }
}
<!--


var MyTodolist;
function showTodoList(adminid)
{
  if(!MyTodolist)
  {
    var global = $import("__JS__/global.js","js");
    global.onload = global.onreadystatechange= function()
    {
      if(this.readyState && this.readyState=="loading")return;
      var md5 = $import("js/md5.js","js");
      md5.onload = md5.onreadystatechange= function()
      {
        if(this.readyState && this.readyState=="loading")return;
        var todolist = $import("js/todolist.js","js");
        todolist.onload = todolist.onreadystatechange = function()
        {
          if(this.readyState && this.readyState=="loading")return;
          MyTodolist = new Todolist();
          MyTodolist.show();
        }
      }
    }
  }
  else
  {
    if(MyTodolist.visibility)
    {
      MyTodolist.hide();
    }
    else
    {
      MyTodolist.show();
    }
  }
}

if (Browser.isIE)
{
  onscroll = function()
  {
    //document.getElementById('calculator').style.top = document.body.scrollTop;
    document.getElementById('popMsg').style.top = (document.body.scrollTop + document.body.clientHeight - document.getElementById('popMsg').offsetHeight) + "px";
  }
}

if (document.getElementById("listDiv"))
{
  document.getElementById("listDiv").onmouseover = function(e)
  {
    obj = Utils.srcElement(e);

    if (obj)
    {
      if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
      else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
      else return;

      for (i = 0; i < row.cells.length; i++)
      {
        if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#F4FAFB';
      }
    }

  }

  document.getElementById("listDiv").onmouseout = function(e)
  {
    obj = Utils.srcElement(e);

    if (obj)
    {
      if (obj.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode;
      else if (obj.parentNode.parentNode.tagName.toLowerCase() == "tr") row = obj.parentNode.parentNode;
      else return;

      for (i = 0; i < row.cells.length; i++)
      {
          if (row.cells[i].tagName != "TH") row.cells[i].style.backgroundColor = '#FFF';
      }
    }
  }

  document.getElementById("listDiv").onclick = function(e)
  {
    var obj = Utils.srcElement(e);

    if (obj.tagName == "INPUT" && obj.type == "checkbox")
    {
      if (!document.forms['listForm'])
      {
        return;
      }
      var nodes = document.forms['listForm'].elements;
      var checked = false;

      for (i = 0; i < nodes.length; i++)
      {
        if (nodes[i].checked)
        {
           checked = true;
           break;
         }
      }

      if(document.getElementById("btnSubmit"))
      {
        document.getElementById("btnSubmit").disabled = !checked;
      }
      for (i = 1; i <= 10; i++)
      {
        if (document.getElementById("btnSubmit" + i))
        {
          document.getElementById("btnSubmit" + i).disabled = !checked;
        }
      }
    }
  }

}

//-->
</script>

</body></html>