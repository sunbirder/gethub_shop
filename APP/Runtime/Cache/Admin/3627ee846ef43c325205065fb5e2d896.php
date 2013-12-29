<?php if (!defined('THINK_PATH')) exit();?><!-- $Id: goods_list.htm 17126 2010-04-23 10:30:26Z liuhui $ -->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<!-- $Id: goods_search.htm 16790 2009-11-10 08:56:15Z wangleisvn $ -->
<div class="form-div">
  <form name="searchForm" action="javascript:search_brand()">
    <img width="26" height="22" border="0" alt="SEARCH" src="__IMG__/icon_search.gif">
     <input type="text" size="15" name="brand_name">
    <input type="submit" class="button" value=" 搜索 ">
  </form>
</div>

<script language="JavaScript">
    function search_brand()
    {
        listTable.filter['brand_name'] = Utils.trim(document.forms['searchForm'].elements['brand_name'].value);
        listTable.filter['page'] = 1;
        
        listTable.loadList();
    }

</script>
<form method="post" action="" name="listForm">
<!-- start brand list -->
<div class="list-div" id="listDiv">

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>品牌名称</th>
      <th>品牌网址</th>
      <th>品牌描述</th>
      <th>排序</th>
      <th>是否显示</th>
      <th>操作</th>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803062307572427.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 1)">诺基亚</span>
      </td>
      <td><a href="http://www.nokia.com.cn/" target="_brank">http://www.nokia.com.cn/</a></td>
      <td align="left">公司网站：http://www.nokia.com.cn/

客服电话：...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 1)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 1)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=1" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(1, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240802922410634065.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 2)">摩托罗拉</span>
      </td>
      <td><a href="http://www.motorola.com.cn" target="_brank">http://www.motorola.com.cn</a></td>
      <td align="left">官方咨询电话：4008105050
售后网点：http://www.mo...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 2)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 2)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=2" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(2, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803144788047486.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 3)">多普达</span>
      </td>
      <td><a href="http://www.dopod.com " target="_brank">http://www.dopod.com </a></td>
      <td align="left">官方咨询电话：4008201668
售后网点：http://www.do...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 3)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 3)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=3" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(3, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803247838195732.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 4)">飞利浦</span>
      </td>
      <td><a href="http://www.philips.com.cn " target="_brank">http://www.philips.com.cn </a></td>
      <td align="left">官方咨询电话：4008800008
售后网点：http://www.ph...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 4)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 4)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=4" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(4, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803352280856940.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 5)">夏新</span>
      </td>
      <td><a href="http://www.amobile.com.cn" target="_brank">http://www.amobile.com.cn</a></td>
      <td align="left">官方咨询电话：4008875777
售后网点：http://www.am...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 5)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 5)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=5" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(5, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803412367015368.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 6)">三星</span>
      </td>
      <td><a href="http://cn.samsungmobile.com" target="_brank">http://cn.samsungmobile.com</a></td>
      <td align="left">官方咨询电话：8008105858
售后网点：http://cn.sam...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 6)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 6)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=6" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(6, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803482283160654.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 7)">索爱</span>
      </td>
      <td><a href="http://www.sonyericsson.com.cn/" target="_brank">http://www.sonyericsson.com.cn/</a></td>
      <td align="left">官方咨询电话：4008100000
售后网点：http://www.so...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 7)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 7)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=7" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(7, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803526904622792.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 8)">LG</span>
      </td>
      <td><a href="http://cn.wowlg.com" target="_brank">http://cn.wowlg.com</a></td>
      <td align="left">官方咨询电话：4008199999
售后网点：http://www.lg...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 8)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 8)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=8" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(8, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803578417877983.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 9)">联想</span>
      </td>
      <td><a href="http://www.lenovomobile.com/" target="_brank">http://www.lenovomobile.com/</a></td>
      <td align="left">官方咨询电话：4008188818
售后网点：http://www.le...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 9)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 9)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=9" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(9, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 10)">金立</span>
      </td>
      <td><a href="http://www.gionee.net" target="_brank">http://www.gionee.net</a></td>
      <td align="left">官方咨询电话：4007796666
售后网点：http://www.gi...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 10)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 10)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=10" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(10, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td class="first-cell">
        <span style="float:right"><a href="../data/brandlogo/1240803736391383580.gif" target="_brank"><img src="__IMG__/picflag.gif" width="16" height="16" border="0" alt=品牌LOGO /></a></span>
        <span onclick="javascript:listTable.edit(this, 'edit_brand_name', 11)">  恒基伟业</span>
      </td>
      <td><a href="http://www.htwchina.com" target="_brank">http://www.htwchina.com</a></td>
      <td align="left">官方咨询电话：4008899126
售后网点：http://www.ht...</td>
      <td align="right"><span onclick="javascript:listTable.edit(this, 'edit_sort_order', 11)">50</span></td>
      <td align="center"><img src="__IMG__/yes.gif" onclick="listTable.toggle(this, 'toggle_show', 11)" /></td>
      <td align="center">
        <a href="brand.php?act=edit&id=11" title="编辑">编辑</a> |
        <a href="javascript:;" onclick="listTable.remove(11, '你确认要删除选定的商品品牌吗？')" title="编辑">移除</a> 
      </td>
    </tr>
        <tr>
      <td align="right" nowrap="true" colspan="6">
            <!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
            <div id="turn-page">
        总计  <span id="totalRecords">11</span>
        个记录分为 <span id="totalPages">1</span>
        页当前第 <span id="pageCurrent">1</span>
        页，每页 <input type='text' size='3' id='pageSize' value="15" onkeypress="return listTable.changePageSize(event)" />
        <span id="page-link">
          <a href="javascript:listTable.gotoPageFirst()">第一页</a>
          <a href="javascript:listTable.gotoPagePrev()">上一页</a>
          <a href="javascript:listTable.gotoPageNext()">下一页</a>
          <a href="javascript:listTable.gotoPageLast()">最末页</a>
          <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
            <option value='1'>1</option>          </select>
        </span>
      </div>
      </td>
    </tr>
  </table>

<!-- end brand list -->
</div>
</form>

<script type="text/javascript" language="javascript">
  <!--
  listTable.recordCount = 11;
  listTable.pageCount = 1;

    listTable.filter.record_count = '11';
    listTable.filter.page_size = '15';
    listTable.filter.page = '1';
    listTable.filter.page_count = '1';
    listTable.filter.start = '0';
  
  
  onload = function()
  {
      // 开始检查订单
      startCheckOrder();
  }
  
  //-->
</script>
 
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