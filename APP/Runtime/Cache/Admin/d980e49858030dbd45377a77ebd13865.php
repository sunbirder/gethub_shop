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
	
<!-- $Id: goods_search.htm 16790 2009-11-10 08:56:15Z wangleisvn $ -->
  <!-- 商品搜索 -->
  <div class="form-div">
    <form action="javascript:searchGoods()" name="searchForm">
      <img src="__IMG__/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
      <!-- 分类 -->
      <select name="cat_id">
        <option value="0">所有分类</option>
        <option value="6" >手机配件</option>
        <option value="9" >&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
        <option value="11" >&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
        <option value="7" >&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
        <option value="8" >&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
        <option value="1" >手机类型</option>
        <option value="3" >&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
        <option value="4" >&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
        <option value="5" >&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
        <option value="2" >&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
        <option value="12" >充值卡</option>
        <option value="13" >&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
        <option value="14" >&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
        <option value="15" >&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
      </select>
      <!-- 品牌 -->
      <select name="brand_id">
        <option value="0">所有品牌</option>
        <option value="1">诺基亚</option>
        <option value="10">金立</option>
        <option value="9">联想</option>
        <option value="8">LG</option>
        <option value="7">索爱</option>
        <option value="6">三星</option>
        <option value="5">夏新</option>
        <option value="4">飞利浦</option>
        <option value="3">多普达</option>
        <option value="2">摩托罗拉</option>
        <option value="11">恒基伟业</option>
      </select>
      <!-- 推荐 -->
      <select name="intro_type">
        <option value="0">全部</option>
        <option value="is_best">精品</option>
        <option value="is_new">新品</option>
        <option value="is_hot">热销</option>
        <option value="is_promote">特价</option>
        <option value="all_type">全部推荐</option>
      </select>

      <!-- 供货商 -->
      <select name="suppliers_id">
        <option value="0">全部</option>
        <option value="1">北京供货商</option>
        <option value="2">上海供货商</option>
      </select>
      <!-- 上架 -->
      <select name="is_on_sale">
        <option value=''>全部</option>
        <option value="1">上架</option>
        <option value="0">下架</option>
      </select>
      <!-- 关键字 -->
      关键字
      <input type="text" name="keyword" size="15" />
      <input type="submit" value=" 搜索 " class="button" />
    </form>
  </div>

<script language="JavaScript">
    // 收索功能, 添加listTable.filter属性
    function searchGoods(){

        listTable.filter['cat_id'] = document.forms['searchForm'].elements['cat_id'].value;
        listTable.filter['brand_id'] = document.forms['searchForm'].elements['brand_id'].value;
        listTable.filter['intro_type'] = document.forms['searchForm'].elements['intro_type'].value;
        listTable.filter['suppliers_id'] = document.forms['searchForm'].elements['suppliers_id'].value;
        listTable.filter['is_on_sale'] = document.forms['searchForm'].elements['is_on_sale'].value;
        listTable.filter['keyword'] = Utils.trim(document.forms['searchForm'].elements['keyword'].value);
        listTable.filter['page'] = 1;

        listTable.loadList();
    }
</script>

  <!-- 商品列表 -->
  <form method="post" action="__GOODSURL__/goods_curd_bath" name="listForm" onsubmit="return confirmSubmit(this)">
    <!-- start goods list -->
    <div class="list-div" id="listDiv">
      <table cellpadding="3" cellspacing="1">
        <tr>
          <th>
            <input onclick="listTable.selectAll(this, 'checkboxes')" type="checkbox" />
            <a href="javascript:listTable.sort('goods_id'); ">编号</a>
            <img src="__IMG__/sort_desc.gif"/>
          </th>
          <th>
            <a href="javascript:listTable.sort('goods_name'); ">商品名称</a>
          </th>
          <th>
            <a href="javascript:listTable.sort('goods_sn'); ">货号</a>
          </th>
          <th>
            <a href="javascript:listTable.sort('shop_price'); ">价格</a>
          </th>
          <th>操作</th>
            <!-- 商品列表 $goods_list -->
  <?php if(is_array($goods_list)): foreach($goods_list as $key=>$goods): ?><tr>
    <td>
      <input type="checkbox" name="checkboxes[]" value="<?php echo ($goods["goods_id"]); ?>" />  
      <?php echo ($goods["goods_id"]); ?>
    </td>
    <td class="first-cell" style="<?php if($goods["is_promote"] == 1): ?>color:red;<?php endif; ?>">
      <span><?php echo ($goods["goods_name"]); ?></span>
    </td>
    <td>
      <span><?php echo ($goods["goods_sn"]); ?></span>
    </td>
    <td align="right">
      <span><?php echo ($goods["shop_price"]); ?></span>
    </td>
    <td align="center">
      <a href="javascript:;" onclick="listTable.remove(<?php echo ($goods["goods_id"]); ?>, '您确实要把该商品还原吗？', 'restore_goods')">还原</a> |
      <a href="javascript:;" onclick="listTable.remove(<?php echo ($goods["goods_id"]); ?>, '您确实要删除该商品吗？', 'drop_goods')">删除</a>
    </td>
  </tr><?php endforeach; endif; ?>
          </table>
          <!-- end goods list -->
<!-- $Id: page.htm 14216 2008-03-10 02:27:21Z testyang $ -->
      		<!-- 分页 -->
          <table id="page-table" cellspacing="0">
            <tr>
              <td align="right" nowrap="true">
                <div id="turn-page">
                  总计
                  <span id="totalRecords"><?php echo ($COUNT); ?></span>
                  个记录分为
                  <span id="totalPages"><?php echo ($PAGECOUNT); ?></span>
                  页当前第
                  <span id="pageCurrent">1</span>
                  页，每页
                  <input type='text' size='3' id='pageSize' value="<?php echo ($PAGESIZE); ?>" onkeypress="return listTable.changePageSize(event)" />
                  <span id="page-link">
                    <a href="javascript:listTable.gotoPageFirst()">第一页</a>
                    <a href="javascript:listTable.gotoPagePrev()">上一页</a>
                    <a href="javascript:listTable.gotoPageNext()">下一页</a>
                    <a href="javascript:listTable.gotoPageLast()">最末页</a>
                    <select id="gotoPage" onchange="listTable.gotoPage(this.value)">
					 <?php for($i=1; $i<=$PAGECOUNT; $i++){ echo "<option value='$i'>$i</option>"; } ?>
                    </select>
                  </span>
                </div>
              </td>
            </tr>
          </table>

        </div>

        <div>
         <input type="hidden" name="act" value="batch" />
      <select name="type" id="selAction" onchange="changeAction()">
        <option value="">请选择...</option>
        <option value="restore">还原</option>
        <option value="drop">移除</option>
      </select>
      <select name="target_cat" style="display:none" onchange="checkIsLeaf(this)"><option value="0">请选择...</caption><option value="17" >asdsa</option><option value="1" >手机类型</option><option value="3" >&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option><option value="4" >&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option><option value="5" >&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option><option value="2" >&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option><option value="16" >&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法国色粉</option><option value="18" >dasdsad</option><option value="12" >充值卡</option><option value="14" >&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option><option value="15" >&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option><option value="13" >&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option><option value="6" >手机配件</option><option value="11" >&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option><option value="7" >&nbsp;&nbsp;&nbsp;&nbsp;充电器</option><option value="8" >&nbsp;&nbsp;&nbsp;&nbsp;耳机</option><option value="9" >&nbsp;&nbsp;&nbsp;&nbsp;电池</option></select>
      <input type="submit" value=" 确定 " id="btnSubmit" name="btnSubmit" class="button" disabled="true" />
        </div>
      </form>

      <script type="text/javascript">
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


    // listTable属性初始化
    // listTable.recordCount = 24;// <?php echo ($COUNT); ?>
    // listTable.filter.cat_id = '0';
    // listTable.filter.intro_type = '';
    // listTable.filter.is_promote = '0';
    // listTable.filter.stock_warning = '0';
    // listTable.filter.brand_id = '0';
    // listTable.filter.keyword = '';
    // listTable.filter.suppliers_id = '';
    // listTable.filter.is_on_sale = '';
    // listTable.filter.extension_code = '';
    // listTable.filter.real_goods = '1';
    // listTable.filter.record_count = '24';
    // listTable.filter.page_count = '1';
    // listTable.filter.start = '0';// <?php echo ($START); ?>

    var img_url = "__IMG__";
    // 翻页功能, 添加listTable.filter属性

    listTable.pageCount = <?php echo ($PAGECOUNT); ?>;
    listTable.filter.page_size = <?php echo ($PAGESIZE); ?>;
    listTable.filter.sortname = 'goods_id';
    listTable.filter.sortorder = 'DESC';
    listTable.filter.page = '1';
    listTable.filter.is_delete = '1';
  
  
  onload = function()
  {
    startCheckOrder(); // 开始检查订单
    document.forms['listForm'].reset();
  }

  function confirmSubmit(frm, ext)
  {
    if (frm.elements['type'].value == 'restore')
    {
      
      return confirm("您确实要把该商品还原吗？");
      
    }
    else if (frm.elements['type'].value == 'drop')
    {
      
      return confirm("彻底删除商品将删除与该商品有关的所有信息。\n您确实要删除选中的商品吗？");
      
    }
    else if (frm.elements['type'].value == '')
    {
        return false;
    }
    else
    {
        return true;
    }
  }

  function changeAction()
  {
      var frm = document.forms['listForm'];

      if (!document.getElementById('btnSubmit').disabled &&
          confirmSubmit(frm, false))
      {
          frm.submit();
      }
  }
  

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