<?php if (!defined('THINK_PATH')) exit();?>	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <title>ECSHOP 管理中心 - 商品列表</title>
  <meta name="robots" content="noindex, nofollow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="__CSS__/general.css" rel="stylesheet" type="text/css" />
  <link href="__CSS__/main.css" rel="stylesheet" type="text/css" />
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
var goods_name_not_null = "商品名称不能为空。";
var goods_cat_not_null = "商品分类必须选择。";
var category_cat_not_null = "分类名称不能为空";
var brand_cat_not_null = "品牌名称不能为空";
var goods_cat_not_leaf = "您选择的商品分类不是底级分类，请选择底级分类。";
var shop_price_not_null = "本店售价不能为空。";
var shop_price_not_number = "本店售价不是数值。";
var select_please = "请选择...";
var button_add = "添加";
var button_del = "删除";
var spec_value_not_null = "规格不能为空";
var spec_price_not_number = "加价不是数字";
var market_price_not_number = "市场价格不是数字";
var goods_number_not_int = "商品库存不是整数";
var warn_number_not_int = "库存警告不是整数";
var promote_not_lt = "促销开始日期不能大于结束日期";
var promote_start_not_null = "促销开始时间不能为空";
var promote_end_not_null = "促销结束时间不能为空";
var drop_img_confirm = "您确实要删除该图片吗？";
var batch_no_on_sale = "您确实要将选定的商品下架吗？";
var batch_trash_confirm = "您确实要把选中的商品放入回收站吗？";
var go_category_page = "本页数据将丢失，确认要去商品分类页添加分类吗？";
var go_brand_page = "本页数据将丢失，确认要去商品品牌页添加品牌吗？";
var volume_num_not_null = "请输入优惠数量";
var volume_num_not_number = "优惠数量不是数字";
var volume_price_not_null = "请输入优惠价格";
var volume_price_not_number = "优惠价格不是数字";
var cancel_color = "无样式";
//-->
</script>
</head>
<body>

  <h1>
    <span class="action-span">
      <a href="goods.php?act=add">添加新商品</a>
    </span>
    <span class="action-span1">
      <a href="index.php?act=main">ECSHOP 管理中心</a>
    </span>
    <span id="search_id" class="action-span1">- 商品列表</span>
    <div style="clear:both"></div>
  </h1>
  <script type="text/javascript" src="__JS__/utils.js"></script>
  <script type="text/javascript" src="__JS__/listtable.js"></script>
	<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 16px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 100px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 36px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
</style>
</head>
<body>
<div class="system-message">
<?php if(isset($message)): ?><h1>:)</h1>
<p class="success"><?php echo($message); ?></p>
<?php else: ?>
<h1>:(</h1>
<p class="error"><?php echo($error); ?></p><?php endif; ?>
<p class="detail"></p>
<p class="jump">
页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
</p>
</div>
<script type="text/javascript">
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
</script>
</body>
</html>
	 <div id="footer">
  <!--       共执行 7 个查询，用时 0.011362 秒，Gzip 已禁用，内存占用 4.157 MB
        <br />-->
        版权所有 &copy; 2005-2010 上海商派网络科技有限公司，并保留所有权利。
      </div> 
      <!-- 新订单提示信息 
      <div id="popMsg">
        <table cellspacing="0" cellpadding="0" width="100%" bgcolor="#cfdef4" border="0">
          <tr>
            <td style="color: #0f2c8c" width="30" height="24"></td>
            <td style="font-weight: normal; color: #1f336b; padding-top: 4px;padding-left: 4px" valign="center" width="100%">新订单通知</td>
            <td style="padding-top: 2px;padding-right:2px" valign="center" align="right" width="19">
              <span title="关闭" style="cursor: hand;cursor:pointer;color:red;font-size:12px;font-weight:bold;margin-right:4px;" onclick="Message.close()" >×</span>
              <!-- <img title=关闭 style="cursor: hand" onclick=closediv() hspace=3 src="msgclose.jpg"></td>
          </tr>
          <tr>
            <td style="padding-right: 1px; padding-bottom: 1px" colspan="3" height="70">
              <div id="popMsgContent">
                <p>
                  您有 <strong style="color:#ff0000" id="spanNewOrder">1</strong>
                  个新订单以及 <strong style="color:#ff0000" id="spanNewPaid">0</strong>
                  个新付款的订单
                </p>
                <p align="center" style="word-break:break-all">
                  <a href="order.php?act=list">
                    <span style="color:#ff0000">点击查看新订单</span>
                  </a>
                </p>
              </div>
            </td>
          </tr>
        </table>
      </div>
-->
      <!--
<embed src="__IMG__/online.wav" width="0" height="0" autostart="false" name="msgBeep" id="msgBeep" enablejavascript="true"/>
      -->
    <!--   <object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0" id="msgBeep" width="1" height="1">
        <param name="movie" value="__IMG__/online.swf">
        <param name="quality" value="high">
        <embed src="__IMG__/online.swf" name="msgBeep" id="msgBeep" quality="high" width="0" height="0" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/shockwave/download/index.cgi?p1_prod_version=shockwaveflash">
        </embed>
    </object> -->

    <script language="JavaScript">
// 鼠标指向, 修改对应元素的属性
document.onmousemove=function(e)
{
  var obj = Utils.srcElement(e);
  // 所有符合条件元素事件: obj.onclick绑定函数, 这个函数是listTable.edit();
  if (typeof(obj.onclick) == 'function' && obj.onclick.toString().indexOf('listTable.edit') != -1)
  {
    obj.title = '点击修改内容';
    obj.style.cssText = 'background: #278296;';
    obj.onmouseout = function(e)
    {
      this.style.cssText = '';
    }
  }
  // 所有符合条件元素事件: obj.href非空, obj.href绑定函数listTable.sort();
  else if (typeof(obj.href) != 'undefined' && obj.href.indexOf('listTable.sort') != -1)
  {
    obj.title = '点击对列表排序';
  }
}
<!--

/*
var MyTodolist;
function showTodoList(adminid)
{
  if(!MyTodolist)
  {
    var global = $import("__JS__/global.js","js");
    global.onload = global.onreadystatechange= function()
    {
      if(this.readyState && this.readyState=="loading")return;
      var md5 = $import("__JS__/md5.js","js");
      md5.onload = md5.onreadystatechange= function()
      {
        if(this.readyState && this.readyState=="loading")return;
        var todolist = $import("__JS__/todolist.js","js");
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
*/
if (Browser.isIE)
{
  onscroll = function()
  {
    //document.getElementById('calculator').style.top = document.body.scrollTop;
    document.getElementById('popMsg').style.top = (document.body.scrollTop + document.body.clientHeight - document.getElementById('popMsg').offsetHeight) + "px";
  }
}
// 元素listDiv的鼠标移动事件
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
// 元素listDiv的鼠标离开事件
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
// 元素listDiv的点击事件
  document.getElementById("listDiv").onclick = function(e)
  {
    var obj = Utils.srcElement(e);
	
    if (obj.tagName == "INPUT" && obj.type == "checkbox")	// 复选框类型
    {
      if (!document.forms['listForm'])	// 表单不存在返回false
      {
        return;
      }
      var nodes = document.forms['listForm'].elements;
      var checked = false;

      for (i = 0; i < nodes.length; i++)	// 全选效果
      {
        if (nodes[i].checked)
        {
           checked = true;
           break;
         }
      }

      if(document.getElementById("btnSubmit"))
      {
        document.getElementById("btnSubmit").disabled = !checked; // 开关元素btnSubmit属性disabled, 是否支持点击效果
      }
      for (i = 1; i <= 10; i++)	// ???
      {
        if (document.getElementById("btnSubmit" + i))
        {
          document.getElementById("btnSubmit" + i).disabled = !checked;
        }
      }
    }
  }

}

//--></script>
</body>
  </html>