<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
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

<script src="__JS__/utils.js" type="text/javascript"></script>
<script src="__JS__/listtable.js" type="text/javascript"></script>
<form name="listForm" action="" method="post">
<!-- start ad position list -->
<div id="listDiv" class="list-div">

<table width="100%" cellspacing="1" cellpadding="2" id="list-table">
  <tbody><tr>
    <th>分类名称</th>
    <th>商品数量</th>
    <th>数量单位</th>
    <th>导航栏</th>
    <th>是否显示</th>
    <th>价格分级</th>
    <th>排序</th>
    <th>操作</th>
  </tr>
    <tr align="center" id="0_1" class="0">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:0em" id="icon_0_1" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=1">手机类型</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">0</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 1)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 1)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 1)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 1)">5</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 1)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=1">转移商品</a> |
      <a href="category.php?act=edit&cat_id=1">编辑</a> |
      <a title="移除" onclick="listTable.remove(1, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_5" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_5" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=5">双模手机</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">2</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 5)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 5)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 5)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 5)">5</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 5)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=5">转移商品</a> |
      <a href="category.php?act=edit&cat_id=5">编辑</a> |
      <a title="移除" onclick="listTable.remove(5, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_2" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_2" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=2">CDMA手机</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">1</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 2)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 2)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 2)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 2)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 2)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=2">转移商品</a> |
      <a href="category.php?act=edit&cat_id=2">编辑</a> |
      <a title="移除" onclick="listTable.remove(2, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="2_16" class="2">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:2em" id="icon_2_16" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=16">法国色粉</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">0</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 16)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 16)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 16)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 16)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 16)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=16">转移商品</a> |
      <a href="category.php?act=edit&cat_id=16">编辑</a> |
      <a title="移除" onclick="listTable.remove(16, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_3" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_3" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=3">GSM手机</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">9</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 3)"><!--  -->台<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 3)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 3)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 3)">4</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 3)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=3">转移商品</a> |
      <a href="category.php?act=edit&cat_id=3">编辑</a> |
      <a title="移除" onclick="listTable.remove(3, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_4" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_4" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=4">3G手机</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">2</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 4)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 4)" src="__IMG__/yes.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 4)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 4)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 4)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=4">转移商品</a> |
      <a href="category.php?act=edit&cat_id=4">编辑</a> |
      <a title="移除" onclick="listTable.remove(4, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="0_12" class="0">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:0em" id="icon_0_12" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=12">充值卡</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">0</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 12)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 12)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 12)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 12)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 12)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=12">转移商品</a> |
      <a href="category.php?act=edit&cat_id=12">编辑</a> |
      <a title="移除" onclick="listTable.remove(12, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_15" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_15" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=15">联通手机充值卡</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">2</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 15)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 15)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 15)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 15)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 15)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=15">转移商品</a> |
      <a href="category.php?act=edit&cat_id=15">编辑</a> |
      <a title="移除" onclick="listTable.remove(15, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_13" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_13" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=13">小灵通/固话充值卡</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">2</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 13)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 13)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 13)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 13)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 13)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=13">转移商品</a> |
      <a href="category.php?act=edit&cat_id=13">编辑</a> |
      <a title="移除" onclick="listTable.remove(13, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_14" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_14" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=14">移动手机充值卡</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">2</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 14)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 14)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 14)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 14)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 14)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=14">转移商品</a> |
      <a href="category.php?act=edit&cat_id=14">编辑</a> |
      <a title="移除" onclick="listTable.remove(14, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="0_6" class="0">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:0em" id="icon_0_6" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=6">手机配件</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">0</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 6)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 6)" src="__IMG__/yes.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 6)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 6)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 6)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=6">转移商品</a> |
      <a href="category.php?act=edit&cat_id=6">编辑</a> |
      <a title="移除" onclick="listTable.remove(6, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_8" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_8" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=8">耳机</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">1</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 8)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 8)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 8)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 8)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 8)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=8">转移商品</a> |
      <a href="category.php?act=edit&cat_id=8">编辑</a> |
      <a title="移除" onclick="listTable.remove(8, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_9" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_9" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=9">电池</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">1</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 9)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 9)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 9)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 9)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 9)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=9">转移商品</a> |
      <a href="category.php?act=edit&cat_id=9">编辑</a> |
      <a title="移除" onclick="listTable.remove(9, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_11" class="1">
    <td align="left" class="first-cell" style="background-color: rgb(255, 255, 255);">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_11" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=11">读卡器和内存卡</a></span>
        </td>
    <td width="10%" style="background-color: rgb(255, 255, 255);">0</td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_measure_unit', 11)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 11)" src="__IMG__/no.gif"></td>
    <td width="10%" style="background-color: rgb(255, 255, 255);"><img onclick="listTable.toggle(this, 'toggle_is_show', 11)" src="__IMG__/yes.gif"></td>
    <td style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_grade', 11)">0</span></td>
    <td width="10%" align="right" style="background-color: rgb(255, 255, 255);"><span onclick="listTable.edit(this, 'edit_sort_order', 11)">50</span></td>
    <td width="24%" align="center" style="background-color: rgb(255, 255, 255);">
      <a href="category.php?act=move&cat_id=11">转移商品</a> |
      <a href="category.php?act=edit&cat_id=11">编辑</a> |
      <a title="移除" onclick="listTable.remove(11, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
    <tr align="center" id="1_7" class="1">
    <td align="left" class="first-cell">
            <img width="9" height="9" border="0" onclick="rowClicked(this)" style="margin-left:1em" id="icon_1_7" src="__IMG__/menu_minus.gif">
            <span><a href="goods.php?act=list&cat_id=7">充电器</a></span>
        </td>
    <td width="10%">0</td>
    <td width="10%"><span onclick="listTable.edit(this, 'edit_measure_unit', 7)"><!--  -->&nbsp;&nbsp;&nbsp;&nbsp;<!--  --></span></td>
    <td width="10%"><img onclick="listTable.toggle(this, 'toggle_show_in_nav', 7)" src="__IMG__/no.gif"></td>
    <td width="10%"><img onclick="listTable.toggle(this, 'toggle_is_show', 7)" src="__IMG__/yes.gif"></td>
    <td><span onclick="listTable.edit(this, 'edit_grade', 7)">0</span></td>
    <td width="10%" align="right"><span onclick="listTable.edit(this, 'edit_sort_order', 7)">50</span></td>
    <td width="24%" align="center">
      <a href="category.php?act=move&cat_id=7">转移商品</a> |
      <a href="category.php?act=edit&cat_id=7">编辑</a> |
      <a title="移除" onclick="listTable.remove(7, '您确认要删除这条记录吗?')" href="javascript:;">移除</a>
    </td>
  </tr>
  </tbody></table>
</div>
</form>
<script language="JavaScript">
<!--

onload = function()
{
  // 开始检查订单
  startCheckOrder();
}

var imgPlus = new Image();
imgPlus.src = "__IMG__/menu_plus.gif";

/**
 * 折叠分类列表
 */
function rowClicked(obj)
{
  // 当前图像
  img = obj;
  // 取得上二级tr>td>img对象
  obj = obj.parentNode.parentNode;
  // 整个分类列表表格
  var tbl = document.getElementById("list-table");
  // 当前分类级别
  var lvl = parseInt(obj.className);
  // 是否找到元素
  var fnd = false;
  var sub_display = img.src.indexOf('menu_minus.gif') > 0 ? 'none' : (Browser.isIE) ? 'block' : 'table-row' ;
  // 遍历所有的分类
  for (i = 0; i < tbl.rows.length; i++)
  {
      var row = tbl.rows[i];
      if (row == obj)
      {
          // 找到当前行
          fnd = true;
          //document.getElementById('result').innerHTML += 'Find row at ' + i +"<br/>";
      }
      else
      {
          if (fnd == true)
          {
              var cur = parseInt(row.className);
              var icon = 'icon_' + row.id;
              if (cur > lvl)
              {
                  row.style.display = sub_display;
                  if (sub_display != 'none')
                  {
                      var iconimg = document.getElementById(icon);
                      iconimg.src = iconimg.src.replace('plus.gif', 'minus.gif');
                  }
              }
              else
              {
                  fnd = false;
                  break;
              }
          }
      }
  }

  for (i = 0; i < obj.cells[0].childNodes.length; i++)
  {
      var imgObj = obj.cells[0].childNodes[i];
      if (imgObj.tagName == "IMG" && imgObj.src != '__IMG__/menu_arrow.gif')
      {
          imgObj.src = (imgObj.src == imgPlus.src) ? '__IMG__/menu_minus.gif' : imgPlus.src;
      }
  }
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