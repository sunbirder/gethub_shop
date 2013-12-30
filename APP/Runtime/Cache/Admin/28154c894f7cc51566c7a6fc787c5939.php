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
	<script src="__JS__/utils.js" type="text/javascript"></script>
<script src="__JS__/selectzone.js" type="text/javascript"></script>
<script src="__JS__/colorselector.js" type="text/javascript"></script>
<script src="__JS__/calendar/calendar.js" type="text/javascript"></script>
<link type="text/css" rel="stylesheet" href="__JS__/calendar/calendar.css">
<div class="tab-div">
  <!-- tab bar -->
  <div id="tabbar-div">
    <p>
      <span id="general-tab" class="tab-front">通用信息</span>
      <span id="detail-tab" class="tab-back">详细描述</span>
      <span id="mix-tab" class="tab-back">其他信息</span>
      <span id="properties-tab" class="tab-back">商品属性</span>
      <span id="gallery-tab" class="tab-back">商品相册</span>
      <span id="linkgoods-tab" class="tab-back">关联商品</span>
      <span id="groupgoods-tab" class="tab-back">配件</span>
      <span id="article-tab" class="tab-back">关联文章</span>
    </p>
  </div>

  <!-- tab body -->
  <div id="tabbody-div">
    <form onsubmit="return validate();" name="theForm" method="post" action="__GOODSURL__/goods_operation" enctype="multipart/form-data">
      <!-- 最大文件限制 -->
      <input type="hidden" value="2097152" name="MAX_FILE_SIZE">
      <!-- 通用信息 -->
      <table width="90%" align="center" id="general-table" style="display: table;">
        <tbody>
          <tr>
            <td class="label">商品名称：</td>
            <td>
              <input type="text" size="30" style="float:left;color:;" value="" name="goods_name">
              <div onclick="ColorSelecter.Show(this);" id="font_color" style="background-color:;float:left;margin-left:2px;">
                <img style="margin-top:-1px;" src="__IMG__/color_selecter.gif"></div>
              <input type="hidden" value="" name="goods_name_color" id="goods_name_color">
              &nbsp;
              <select name="goods_name_style">
                <option value="">字体样式</option>
                <option value="strong">加粗</option>
                <option value="em">斜体</option>
                <option value="u">下划线</option>
                <option value="strike">删除线</option>
              </select>
              <span class="require-field">*</span>
            </td>
          </tr>
          <tr>
            <td class="label">
              <a title="点击此处查看提示信息" href="javascript:showNotice('noticeGoodsSN');">
                <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
              商品货号：
            </td>
            <td>
              <input type="text" onblur="checkGoodsSn(this.value,'0')" size="20" value="" name="goods_sn">
              <span id="goods_sn_notice"></span>
              <br>
              <span id="noticeGoodsSN" style="display:block" class="notice-span">如果您不输入商品货号，系统将自动生成一个唯一的货号。</span>
            </td>
          </tr>
          <tr>
            <td class="label">商品分类：</td>
            <td>
              <select onchange="hideCatDiv()" name="cat_id">
                <option value="0">请选择...</option>
                <option value="1">手机类型</option>
                <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
                <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
                <option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法国色粉</option>
                <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
                <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
                <option value="12">充值卡</option>
                <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
                <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
                <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
                <option value="6">手机配件</option>
                <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
                <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
                <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
                <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
              </select>
              <a class="special" title="添加分类" onclick="rapidCatAdd()" href="javascript:void(0)">添加分类</a>
              <span style="display:none;" id="category_add">
                <input name="addedCategoryName" size="10" class="text">
                <a class="special" title=" 确定 " onclick="addCategory()" href="javascript:void(0)">确定</a>
                <a class="special" title="分类管理" onclick="return goCatPage()" href="javascript:void(0)">分类管理</a>
                <a class="special" title="隐藏" onclick="hideCatDiv()" href="javascript:void(0)">
                  <<
                </a></span>
                  <span class="require-field">*</span>
                </td>
              </tr>
              <tr>
                <td class="label">扩展分类：</td>
                <td>
                  <input type="button" class="button" onclick="addOtherCat(this.parentNode)" value="添加">
                  <select name="other_cat[]">
                    <option value="0">请选择...</option>
                    <option value="1">手机类型</option>
                    <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
                    <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
                    <option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法国色粉</option>
                    <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
                    <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
                    <option value="12">充值卡</option>
                    <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
                    <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
                    <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
                    <option value="6">手机配件</option>
                    <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
                    <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
                    <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
                    <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
                  </select>
                </td>
              </tr>
              <tr>
                <td class="label">商品品牌：</td>
                <td>
                  <select onchange="hideBrandDiv()" name="brand_id">
                    <option value="0">请选择...</option>
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
                  <a class="special" onclick="rapidBrandAdd()" title="添加品牌" href="javascript:void(0)">添加品牌</a>
                  <span style="display:none;" id="brand_add">
                    <input name="addedBrandName" size="15" class="text">
                    <a class="special" onclick="addBrand()" href="javascript:void(0)">确定</a>
                    <a class="special" title="品牌管理" onclick="return goBrandPage()" href="javascript:void(0)">品牌管理</a>
                    <a class="special" title="隐藏" onclick="hideBrandDiv()" href="javascript:void(0)">
                      <<</a></span>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">选择供货商：</td>
                    <td>
                      <select id="suppliers_id" name="suppliers_id">
                        <option value="0">不指定供货商属于本店商品</option>
                        <option value="1">北京供货商</option>
                        <option value="2">上海供货商</option>
                      </select>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">本店售价：</td>
                    <td>
                      <input type="text" onblur="priceSetted()" size="20" value="0" name="shop_price">
                      <input type="button" onclick="marketPriceSetted()" value="按市场价计算">
                      <span class="require-field">*</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">
                      <a title="点击此处查看提示信息" href="javascript:showNotice('noticeUserPrice');">
                        <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                      会员价格：
                    </td>
                    <td>
                      注册用户
                      <span id="nrank_1"></span>
                      <input type="text" size="8" onkeyup="if(parseInt(this.value)<-1){this.value='-1';};set_price_note(1)" value="-1" name="user_price[]" id="rank_1">
                      <input type="hidden" value="1" name="user_rank[]">
                      代销用户
                      <span id="nrank_3"></span>
                      <input type="text" size="8" onkeyup="if(parseInt(this.value)<-1){this.value='-1';};set_price_note(3)" value="-1" name="user_price[]" id="rank_3">
                      <input type="hidden" value="3" name="user_rank[]">
                      vip
                      <span id="nrank_2"></span>
                      <input type="text" size="8" onkeyup="if(parseInt(this.value)<-1){this.value='-1';};set_price_note(2)" value="-1" name="user_price[]" id="rank_2">
                      <input type="hidden" value="2" name="user_rank[]">
                      <br>
                      <span id="noticeUserPrice" style="display:block" class="notice-span">会员价格为-1时表示会员价格按会员等级折扣率计算。你也可以为每个等级指定一个固定价格</span>
                    </td>
                  </tr>

                  <!--商品优惠价格-->
                  <tr>
                    <td class="label">
                      <a title="点击此处查看提示信息" href="javascript:showNotice('volumePrice');">
                        <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                      商品优惠价格：
                    </td>
                    <td>
                      <table width="100%" align="center" id="tbody-volume">
                        <tbody>
                          <tr>
                            <td>
                              <a onclick="addVolumePrice(this)" href="javascript:;">[+]</a>
                              优惠数量
                              <input type="text" value="" size="8" name="volume_number[]">
                              优惠价格
                              <input type="text" value="" size="8" name="volume_price[]"></td>
                          </tr>
                        </tbody>
                      </table>
                      <span id="volumePrice" style="display:block" class="notice-span">购买数量达到优惠数量时享受的优惠价格</span>
                    </td>
                  </tr>
                  <!--商品优惠价格 end -->

                  <tr>
                    <td class="label">市场售价：</td>
                    <td>
                      <input type="text" size="20" value="0" name="market_price">
                      <input type="button" onclick="integral_market_price()" value="取整数"></td>
                  </tr>
                  <tr>
                    <td class="label">
                      <a title="点击此处查看提示信息" href="javascript:showNotice('giveIntegral');">
                        <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                      赠送消费积分数：
                    </td>
                    <td>
                      <input type="text" size="20" value="-1" name="give_integral">
                      <br>
                      <span id="giveIntegral" style="display:block" class="notice-span">购买该商品时赠送消费积分数,-1表示按商品价格赠送</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">
                      <a title="点击此处查看提示信息" href="javascript:showNotice('rankIntegral');">
                        <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                      赠送等级积分数：
                    </td>
                    <td>
                      <input type="text" size="20" value="-1" name="rank_integral">
                      <br>
                      <span id="rankIntegral" style="display:block" class="notice-span">购买该商品时赠送等级积分数,-1表示按商品价格赠送</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">
                      <a title="点击此处查看提示信息" href="javascript:showNotice('noticPoints');">
                        <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                      积分购买金额：
                    </td>
                    <td>
                      <input type="text" ;="" onblur="parseint_integral()" size="20" value="0" name="integral">
                      <br>
                      <span id="noticPoints" style="display:block" class="notice-span">(此处需填写金额)购买该商品时最多可以使用积分的金额</span>
                    </td>
                  </tr>
                  <tr>
                    <td class="label">
                      <label for="is_promote">
                        <input type="checkbox" onclick="handlePromote(this.checked);" value="1" name="is_promote" id="is_promote">促销价：</label>
                    </td>
                    <td id="promote_3">
                      <input type="text" size="20" value="0" name="promote_price" id="promote_1" disabled=""></td>
                  </tr>
                  <tr id="promote_4">
                    <td id="promote_5" class="label">促销日期：</td>
                    <td id="promote_6">
                      <input type="text" readonly="readonly" value="2013-12-29" size="12" id="promote_start_date" name="promote_start_date">
                      <input type="button" class="button" value="选择" onclick="return showCalendar('promote_start_date', '%Y-%m-%d', false, false, 'selbtn1');" id="selbtn1" name="selbtn1" disabled="">
                      -
                      <input type="text" readonly="readonly" value="2014-01-29" size="12" id="promote_end_date" name="promote_end_date">
                      <input type="button" class="button" value="选择" onclick="return showCalendar('promote_end_date', '%Y-%m-%d', false, false, 'selbtn2');" id="selbtn2" name="selbtn2" disabled=""></td>
                  </tr>
                  <tr>
                    <td class="label">上传商品图片：</td>
                    <td>
                      <input type="file" size="35" name="goods_img">
                      <img src="__IMG__/no.gif">
                      <br>
                      <input type="text" name="goods_img_url" onfocus="if (this.value == '商品图片外部URL'){this.value='http://';this.style.color='#000';}" style="color:#aaa;" value="商品图片外部URL" size="40"></td>
                  </tr>
                  <tr id="auto_thumb_1">
                    <td class="label">上传商品缩略图：</td>
                    <td id="auto_thumb_3">
                      <input type="file" size="35" name="goods_thumb" disabled="">
                      <img src="__IMG__/no.gif">
                      <br>
                      <input type="text" name="goods_thumb_url" onfocus="if (this.value == '商品缩略图外部URL'){this.value='http://';this.style.color='#000';}" style="color:#aaa;" value="商品缩略图外部URL" size="40" disabled="">
                      <br>
                      <label for="auto_thumb">
                        <input type="checkbox" onclick="handleAutoThumb(this.checked)" value="1" checked="true" name="auto_thumb" id="auto_thumb">自动生成商品缩略图</label>
                    </td>
                  </tr>
                </tbody>
              </table>

              <!-- 详细描述 -->
              <table width="90%" style="display: none;" id="detail-table">
                <tbody>
                  <tr>
                    <td>
                      <input type="hidden" style="display:none" value="<p>撒旦法撒</p>
                    " name="goods_desc" id="goods_desc">
                    <input type="hidden" style="display:none" value="" id="goods_desc___Config">
                    <iframe width="100%" scrolling="no" height="320" frameborder="0" src="../includes/fckeditor/editor/fckeditor.html?InstanceName=goods_desc&Toolbar=Normal" id="goods_desc___Frame" style="margin: 0px; padding: 0px; border: 0px none; background-color: transparent; background-image: none; width: 100%; height: 320px;"></iframe>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- 其他信息 -->
            <table width="90%" align="center" style="display: none;" id="mix-table">
              <tbody>
                <tr>
                  <td class="label">商品重量：</td>
                  <td>
                    <input type="text" size="20" value="" name="goods_weight">
                    <select name="weight_unit">
                      <option selected="" value="1">千克</option>
                      <option value="0.001">克</option>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td class="label">
                    <a title="点击此处查看提示信息" href="javascript:showNotice('noticeStorage');">
                      <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                    商品库存数量：
                  </td>
                  <!--            <td>
                  <input type="text" name="goods_number" value="1" size="20"  />
                  <br />
                  -->
                  <td>
                    <input type="text" size="20" value="1" name="goods_number">
                    <br>
                    <span id="noticeStorage" style="display:block" class="notice-span">库存在商品为虚货或商品存在货品时为不可编辑状态，库存数值取决于其虚货数量或货品数量</span>
                  </td>
                </tr>
                <tr>
                  <td class="label">库存警告数量：</td>
                  <td>
                    <input type="text" size="20" value="1" name="warn_number"></td>
                </tr>
                <tr>
                  <td class="label">加入推荐：</td>
                  <td>
                    <input type="checkbox" value="1" name="is_best">
                    精品
                    <input type="checkbox" value="1" name="is_new">
                    新品
                    <input type="checkbox" value="1" name="is_hot">热销</td>
                </tr>
                <tr id="alone_sale_1">
                  <td id="alone_sale_2" class="label">上架：</td>
                  <td id="alone_sale_3">
                    <input type="checkbox" checked="checked" value="1" name="is_on_sale">打勾表示允许销售，否则不允许销售。</td>
                </tr>
                <tr>
                  <td class="label">能作为普通商品销售：</td>
                  <td>
                    <input type="checkbox" checked="checked" value="1" name="is_alone_sale">打勾表示能作为普通商品销售，否则只能作为配件或赠品销售。</td>
                </tr>
                <tr>
                  <td class="label">是否为免运费商品</td>
                  <td>
                    <input type="checkbox" value="1" name="is_shipping">打勾表示此商品不会产生运费花销，否则按照正常运费计算。</td>
                </tr>
                <tr>
                  <td class="label">商品关键词：</td>
                  <td>
                    <input type="text" size="40" value="" name="keywords">用空格分隔</td>
                </tr>
                <tr>
                  <td class="label">商品简单描述：</td>
                  <td>
                    <textarea rows="3" cols="40" name="goods_brief"></textarea>
                  </td>
                </tr>
                <tr>
                  <td class="label">
                    <a title="点击此处查看提示信息" href="javascript:showNotice('noticeSellerNote');">
                      <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                    商家备注：
                  </td>
                  <td>
                    <textarea rows="3" cols="40" name="seller_note"></textarea>
                    <br>
                    <span id="noticeSellerNote" style="display:block" class="notice-span">仅供商家自己看的信息</span>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- 属性与规格 -->
            <table width="90%" align="center" style="display: none;" id="properties-table">
              <tbody>
                <tr>
                  <td class="label">
                    <a title="点击此处查看提示信息" href="javascript:showNotice('noticeGoodsType');">
                      <img width="16" height="16" border="0" alt="点击此处查看提示信息" src="__IMG__/notice.gif"></a>
                    商品类型：
                  </td>
                  <td>
                    <select onchange="getAttrList(0)" name="goods_type">
                      <option value="0">请选择商品类型</option>
                      <option value="1">书</option>
                      <option value="2">音乐</option>
                      <option value="3">电影</option>
                      <option value="4">手机</option>
                      <option value="5">笔记本电脑</option>
                      <option value="6">数码相机</option>
                      <option value="7">数码摄像机</option>
                      <option value="8">化妆品</option>
                      <option value="9">精品手机</option>
                    </select>
                    <br>
                    <span id="noticeGoodsType" style="display:block" class="notice-span">请选择商品的所属类型，进而完善此商品的属性</span>
                  </td>
                </tr>
                <tr>
                  <td style="padding:0" colspan="2" id="tbody-goodsAttr">
                    <table width="100%" id="attrTable"></table>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- 商品相册 -->
            <table width="90%" align="center" style="display: none;" id="gallery-table">
              <!-- 图片列表 -->
              <tbody>
                <tr>
                  <td></td>
                </tr>
                <tr>
                  <td>&nbsp;</td>
                </tr>
                <!-- 上传图片 -->
                <tr>
                  <td>
                    <a onclick="addImg(this)" href="javascript:;">[+]</a>
                    图片描述
                    <input type="text" size="20" name="img_desc[]">
                    上传文件
                    <input type="file" name="img_url[]">
                    <input type="text" name="img_file[]" onfocus="if (this.value == '或者输入外部图片链接地址'){this.value='http://';this.style.color='#000';}" style="color:#aaa;" value="或者输入外部图片链接地址" size="40"></td>
                </tr>
              </tbody>
            </table>

            <!-- 关联商品 -->
            <table width="90%" align="center" style="display:none" id="linkgoods-table">
              <!-- 商品搜索 -->
              <tbody>
                <tr>
                  <td colspan="3">
                    <img width="26" height="22" border="0" alt="SEARCH" src="__IMG__/icon_search.gif">
                    <select name="cat_id1">
                      <option value="0">所有分类</option>
                      <option value="1">手机类型</option>
                      <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
                      <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
                      <option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法国色粉</option>
                      <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
                      <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
                      <option value="12">充值卡</option>
                      <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
                      <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
                      <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
                      <option value="6">手机配件</option>
                      <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
                      <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
                      <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
                      <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
                    </select>
                    <select name="brand_id1">
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
                    <input type="text" name="keyword1">
                    <input type="button" onclick="searchGoods(sz1, 'cat_id1','brand_id1','keyword1')" class="button" value=" 搜索 "></td>
                </tr>
                <!-- 商品列表 -->
                <tr>
                  <th>可选商品</th>
                  <th>操作</th>
                  <th>跟该商品关联的商品</th>
                </tr>
                <tr>
                  <td width="42%">
                    <select multiple="true" ondblclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" style="width:100%" size="20" name="source_select1"></select>
                  </td>
                  <td align="center">
                    <p>
                      <input type="radio" checked="checked" value="1" name="is_single">
                      单向关联
                      <br>
                      <input type="radio" value="0" name="is_single">双向关联</p>
                    <p>
                      <input type="button" class="button" onclick="sz1.addItem(true, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" value=">>"></p>
                    <p>
                      <input type="button" class="button" onclick="sz1.addItem(false, 'add_link_goods', goodsId, this.form.elements['is_single'][0].checked)" value=">"></p>
                    <p>
                      <input type="button" class="button" onclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" value="<"></p>
                    <p>
                      <input type="button" class="button" onclick="sz1.dropItem(true, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" value="<"></p>
                  </td>
                  <td width="42%">
                    <select ondblclick="sz1.dropItem(false, 'drop_link_goods', goodsId, elements['is_single'][0].checked)" multiple="" style="width:100%" size="20" name="target_select1"></select>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- 配件 -->
            <table width="90%" align="center" style="display:none" id="groupgoods-table">
              <!-- 商品搜索 -->
              <tbody>
                <tr>
                  <td colspan="3">
                    <img width="26" height="22" border="0" alt="SEARCH" src="__IMG__/icon_search.gif">
                    <select name="cat_id2">
                      <option value="0">所有分类</option>
                      <option value="1">手机类型</option>
                      <option value="5">&nbsp;&nbsp;&nbsp;&nbsp;双模手机</option>
                      <option value="2">&nbsp;&nbsp;&nbsp;&nbsp;CDMA手机</option>
                      <option value="16">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;法国色粉</option>
                      <option value="3">&nbsp;&nbsp;&nbsp;&nbsp;GSM手机</option>
                      <option value="4">&nbsp;&nbsp;&nbsp;&nbsp;3G手机</option>
                      <option value="12">充值卡</option>
                      <option value="15">&nbsp;&nbsp;&nbsp;&nbsp;联通手机充值卡</option>
                      <option value="13">&nbsp;&nbsp;&nbsp;&nbsp;小灵通/固话充值卡</option>
                      <option value="14">&nbsp;&nbsp;&nbsp;&nbsp;移动手机充值卡</option>
                      <option value="6">手机配件</option>
                      <option value="8">&nbsp;&nbsp;&nbsp;&nbsp;耳机</option>
                      <option value="9">&nbsp;&nbsp;&nbsp;&nbsp;电池</option>
                      <option value="11">&nbsp;&nbsp;&nbsp;&nbsp;读卡器和内存卡</option>
                      <option value="7">&nbsp;&nbsp;&nbsp;&nbsp;充电器</option>
                    </select>
                    <select name="brand_id2">
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
                    <input type="text" name="keyword2">
                    <input type="button" class="button" onclick="searchGoods(sz2, 'cat_id2', 'brand_id2', 'keyword2')" value=" 搜索 "></td>
                </tr>
                <!-- 商品列表 -->
                <tr>
                  <th>可选商品</th>
                  <th>操作</th>
                  <th>该商品的配件</th>
                </tr>
                <tr>
                  <td width="42%">
                    <select ondblclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)" onchange="sz2.priceObj.value = this.options[this.selectedIndex].id" style="width:100%" size="20" name="source_select2"></select>
                  </td>
                  <td align="center">
                    <p>
                      价格
                      <br>
                      <input type="text" size="6" name="price2"></p>
                    <p>
                      <input type="button" class="button" onclick="sz2.addItem(false, 'add_group_goods', goodsId, this.form.elements['price2'].value)" value=">"></p>
                    <p>
                      <input type="button" class="button" onclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" value="<"></p>
                    <p>
                      <input type="button" class="button" onclick="sz2.dropItem(true, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" value="<"></p>
                  </td>
                  <td width="42%">
                    <select ondblclick="sz2.dropItem(false, 'drop_group_goods', goodsId, elements['is_single'][0].checked)" multiple="" style="width:100%" size="20" name="target_select2"></select>
                  </td>
                </tr>
              </tbody>
            </table>

            <!-- 关联文章 -->
            <table width="90%" align="center" style="display:none" id="article-table">
              <!-- 文章搜索 -->
              <tbody>
                <tr>
                  <td colspan="3">
                    <img width="26" height="22" border="0" alt="SEARCH" src="__IMG__/icon_search.gif">
                    文章标题
                    <input type="text" name="article_title">
                    <input type="button" class="button" onclick="searchArticle()" value=" 搜索 "></td>
                </tr>
                <!-- 文章列表 -->
                <tr>
                  <th>可选文章</th>
                  <th>操作</th>
                  <th>跟该商品关联的文章</th>
                </tr>
                <tr>
                  <td width="45%">
                    <select ondblclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)" multiple="" style="width:100%" size="20" name="source_select3"></select>
                  </td>
                  <td align="center">
                    <p>
                      <input type="button" class="button" onclick="sz3.addItem(true, 'add_goods_article', goodsId, this.form.elements['price2'].value)" value=">>"></p>
                    <p>
                      <input type="button" class="button" onclick="sz3.addItem(false, 'add_goods_article', goodsId, this.form.elements['price2'].value)" value=">"></p>
                    <p>
                      <input type="button" class="button" onclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" value="<"></p>
                    <p>
                      <input type="button" class="button" onclick="sz3.dropItem(true, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" value="<"></p>
                  </td>
                  <td width="45%">
                    <select ondblclick="sz3.dropItem(false, 'drop_goods_article', goodsId, elements['is_single'][0].checked)" multiple="" style="width:100%" size="20" name="target_select3"></select>
                  </td>
                </tr>
              </tbody>
            </table>

            <div class="button-div">
              <input type="hidden" value="0" name="goods_id">
              <input type="submit" class="button" value=" 确定 ">
              <input type="reset" class="button" value=" 重置 "></div>
            <!-- <input type="hidden" value="insert" name="act"></form> -->
        </div>
      </div>
      <script src="__JS__/validator.js" type="text/javascript"></script>
      <script src="__JS__/tab.js" type="text/javascript"></script>
      <script language="JavaScript">
  var goodsId = '0';
  var elements = document.forms['theForm'].elements;
  var sz1 = new SelectZone(1, elements['source_select1'], elements['target_select1']);
  var sz2 = new SelectZone(2, elements['source_select2'], elements['target_select2'], elements['price2']);
  var sz3 = new SelectZone(1, elements['source_select3'], elements['target_select3']);
  var marketPriceRate = 1.2;
  var integralPercent = 1;

  
  onload = function()
  {
      handlePromote(document.forms['theForm'].elements['is_promote'].checked);

      if (document.forms['theForm'].elements['auto_thumb'])
      {
          handleAutoThumb(document.forms['theForm'].elements['auto_thumb'].checked);
      }

      // 检查新订单
      startCheckOrder();
      
            set_price_note(1);
            set_price_note(3);
            set_price_note(2);
            
      document.forms['theForm'].reset();
  }

  function validate()
  {
      var validator = new Validator('theForm');
      validator.required('goods_name', goods_name_not_null);
      if (document.forms['theForm'].elements['cat_id'].value == 0)
      {
          validator.addErrorMsg(goods_cat_not_null);
      }

      checkVolumeData("1",validator);

      validator.required('shop_price', shop_price_not_null);
      validator.isNumber('shop_price', shop_price_not_number, true);
      validator.isNumber('market_price', market_price_not_number, false);
      if (document.forms['theForm'].elements['is_promote'].checked)
      {
          validator.required('promote_start_date', promote_start_not_null);
          validator.required('promote_end_date', promote_end_not_null);
          validator.islt('promote_start_date', 'promote_end_date', promote_not_lt);
      }

      if (document.forms['theForm'].elements['goods_number'] != undefined)
      {
          validator.isInt('goods_number', goods_number_not_int, false);
          validator.isInt('warn_number', warn_number_not_int, false);
      }



      return validator.passed();
  }

  /**
   * 切换商品类型
   */
  function getAttrList(goodsId)
  {
      var selGoodsType = document.forms['theForm'].elements['goods_type'];

      if (selGoodsType != undefined)
      {
          var goodsType = selGoodsType.options[selGoodsType.selectedIndex].value;

          Ajax.call('goods.php?is_ajax=1&act=get_attr', 'goods_id=' + goodsId + "&goods_type=" + goodsType, setAttrList, "GET", "JSON");
      }
  }

  function setAttrList(result, text_result)
  {
    document.getElementById('tbody-goodsAttr').innerHTML = result.content;
  }

  /**
   * 按比例计算价格
   * @param   string  inputName   输入框名称
   * @param   float   rate        比例
   * @param   string  priceName   价格输入框名称（如果没有，取shop_price）
   */
  function computePrice(inputName, rate, priceName)
  {
      var shopPrice = priceName == undefined ? document.forms['theForm'].elements['shop_price'].value : document.forms['theForm'].elements[priceName].value;
      shopPrice = Utils.trim(shopPrice) != '' ? parseFloat(shopPrice)* rate : 0;
      if(inputName == 'integral')
      {
          shopPrice = parseInt(shopPrice);
      }
      shopPrice += "";

      n = shopPrice.lastIndexOf(".");
      if (n > -1)
      {
          shopPrice = shopPrice.substr(0, n + 3);
      }

      if (document.forms['theForm'].elements[inputName] != undefined)
      {
          document.forms['theForm'].elements[inputName].value = shopPrice;
      }
      else
      {
          document.getElementById(inputName).value = shopPrice;
      }
  }

  /**
   * 设置了一个商品价格，改变市场价格、积分以及会员价格
   */
  function priceSetted()
  {
    computePrice('market_price', marketPriceRate);
    computePrice('integral', integralPercent / 100);
    
        set_price_note(1);
        set_price_note(3);
        set_price_note(2);
        
  }

  /**
   * 设置会员价格注释
   */
  function set_price_note(rank_id)
  {
    var shop_price = parseFloat(document.forms['theForm'].elements['shop_price'].value);

    var rank = new Array();
    
        rank[1] = 100;
        rank[3] = 90;
        rank[2] = 95;
        
    if (shop_price >0 && rank[rank_id] && document.getElementById('rank_' + rank_id) && parseInt(document.getElementById('rank_' + rank_id).value) == -1)
    {
      var price = parseInt(shop_price * rank[rank_id] + 0.5) / 100;
      if (document.getElementById('nrank_' + rank_id))
      {
        document.getElementById('nrank_' + rank_id).innerHTML = '(' + price + ')';
      }
    }
    else
    {
      if (document.getElementById('nrank_' + rank_id))
      {
        document.getElementById('nrank_' + rank_id).innerHTML = '';
      }
    }
  }

  /**
   * 根据市场价格，计算并改变商店价格、积分以及会员价格
   */
  function marketPriceSetted()
  {
    computePrice('shop_price', 1/marketPriceRate, 'market_price');
    computePrice('integral', integralPercent / 100);
    
        set_price_note(1);
        set_price_note(3);
        set_price_note(2);
        
  }

  /**
   * 新增一个规格
   */
  function addSpec(obj)
  {
      var src   = obj.parentNode.parentNode;
      var idx   = rowindex(src);
      var tbl   = document.getElementById('attrTable');
      var row   = tbl.insertRow(idx + 1);
      var cell1 = row.insertCell(-1);
      var cell2 = row.insertCell(-1);
      var regx  = /<a([^>]+)<\/a>/i;

      cell1.className = 'label';
      cell1.innerHTML = src.childNodes[0].innerHTML.replace(/(.*)(addSpec)(.*)(\[)(\+)/i, "$1removeSpec$3$4-");
      cell2.innerHTML = src.childNodes[1].innerHTML.replace(/readOnly([^\s|>]*)/i, '');
  }

  /**
   * 删除规格值
   */
  function removeSpec(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('attrTable');

      tbl.deleteRow(row);
  }

  /**
   * 处理规格
   */
  function handleSpec()
  {
      var elementCount = document.forms['theForm'].elements.length;
      for (var i = 0; i < elementCount; i++)
      {
          var element = document.forms['theForm'].elements[i];
          if (element.id.substr(0, 5) == 'spec_')
          {
              var optCount = element.options.length;
              var value = new Array(optCount);
              for (var j = 0; j < optCount; j++)
              {
                  value[j] = element.options[j].value;
              }

              var hiddenSpec = document.getElementById('hidden_' + element.id);
              hiddenSpec.value = value.join(String.fromCharCode(13)); // 用回车键隔开每个规格
          }
      }
      return true;
  }

  function handlePromote(checked)
  {
      document.forms['theForm'].elements['promote_price'].disabled = !checked;
      document.forms['theForm'].elements['selbtn1'].disabled = !checked;
      document.forms['theForm'].elements['selbtn2'].disabled = !checked;
  }

  function handleAutoThumb(checked)
  {
      document.forms['theForm'].elements['goods_thumb'].disabled = checked;
      document.forms['theForm'].elements['goods_thumb_url'].disabled = checked;
  }

  /**
   * 快速添加品牌
   */
  function rapidBrandAdd(conObj)
  {
      var brand_div = document.getElementById("brand_add");

      if(brand_div.style.display != '')
      {
          var brand =document.forms['theForm'].elements['addedBrandName'];
          brand.value = '';
          brand_div.style.display = '';
      }
  }

  function hideBrandDiv()
  {
      var brand_add_div = document.getElementById("brand_add");
      if(brand_add_div.style.display != 'none')
      {
          brand_add_div.style.display = 'none';
      }
  }

  function goBrandPage()
  {
      if(confirm(go_brand_page))
      {
          window.location.href='brand.php?act=add';
      }
      else
      {
          return;
      }
  }

  function rapidCatAdd()
  {
      var cat_div = document.getElementById("category_add");

      if(cat_div.style.display != '')
      {
          var cat =document.forms['theForm'].elements['addedCategoryName'];
          cat.value = '';
          cat_div.style.display = '';
      }
  }

  function addBrand()
  {
      var brand = document.forms['theForm'].elements['addedBrandName'];
      if(brand.value.replace(/^\s+|\s+$/g, '') == '')
      {
          alert(brand_cat_not_null);
          return;
      }

      var params = 'brand=' + brand.value;
      Ajax.call('brand.php?is_ajax=1&act=add_brand', params, addBrandResponse, 'GET', 'JSON');
  }

  function addBrandResponse(result)
  {
      if (result.error == '1' && result.message != '')
      {
          alert(result.message);
          return;
      }

      var brand_div = document.getElementById("brand_add");
      brand_div.style.display = 'none';

      var response = result.content;

      var selCat = document.forms['theForm'].elements['brand_id'];
      var opt = document.createElement("OPTION");
      opt.value = response.id;
      opt.selected = true;
      opt.text = response.brand;

      if (Browser.isIE)
      {
          selCat.add(opt);
      }
      else
      {
          selCat.appendChild(opt);
      }

      return;
  }

  function addCategory()
  {
      var parent_id = document.forms['theForm'].elements['cat_id'];
      var cat = document.forms['theForm'].elements['addedCategoryName'];
      if(cat.value.replace(/^\s+|\s+$/g, '') == '')
      {
          alert(category_cat_not_null);
          return;
      }

      var params = 'parent_id=' + parent_id.value;
      params += '&cat=' + cat.value;
      Ajax.call('category.php?is_ajax=1&act=add_category', params, addCatResponse, 'GET', 'JSON');
  }

  function hideCatDiv()
  {
      var category_add_div = document.getElementById("category_add");
      if(category_add_div.style.display != null)
      {
          category_add_div.style.display = 'none';
      }
  }

  function addCatResponse(result)
  {
      if (result.error == '1' && result.message != '')
      {
          alert(result.message);
          return;
      }

      var category_add_div = document.getElementById("category_add");
      category_add_div.style.display = 'none';

      var response = result.content;

      var selCat = document.forms['theForm'].elements['cat_id'];
      var opt = document.createElement("OPTION");
      opt.value = response.id;
      opt.selected = true;
      opt.innerHTML = response.cat;

      //获取子分类的空格数
      var str = selCat.options[selCat.selectedIndex].text;
      var temp = str.replace(/^\s+/g, '');
      var lengOfSpace = str.length - temp.length;
      if(response.parent_id != 0)
      {
          lengOfSpace += 4;
      }
      for (i = 0; i < lengOfSpace; i++)
      {
          opt.innerHTML = '&nbsp;' + opt.innerHTML;
      }

      for (i = 0; i < selCat.length; i++)
      {
          if(selCat.options[i].value == response.parent_id)
          {
              if(i == selCat.length)
              {
                  if (Browser.isIE)
                  {
                      selCat.add(opt);
                  }
                  else
                  {
                      selCat.appendChild(opt);
                  }
              }
              else
              {
                  selCat.insertBefore(opt, selCat.options[i + 1]);
              }
              //opt.selected = true;
              break;
          }

      }

      return;
  }

    function goCatPage()
    {
        if(confirm(go_category_page))
        {
            window.location.href='category.php?act=add';
        }
        else
        {
            return;
        }
    }


  /**
   * 删除快速分类
   */
  function removeCat()
  {
      if(!document.forms['theForm'].elements['parent_cat'] || !document.forms['theForm'].elements['new_cat_name'])
      {
          return;
      }

      var cat_select = document.forms['theForm'].elements['parent_cat'];
      var cat = document.forms['theForm'].elements['new_cat_name'];

      cat.parentNode.removeChild(cat);
      cat_select.parentNode.removeChild(cat_select);
  }

  /**
   * 删除快速品牌
   */
  function removeBrand()
  {
      if (!document.forms['theForm'].elements['new_brand_name'])
      {
          return;
      }

      var brand = document.theForm.new_brand_name;
      brand.parentNode.removeChild(brand);
  }

  /**
   * 添加扩展分类
   */
  function addOtherCat(conObj)
  {
      var sel = document.createElement("SELECT");
      var selCat = document.forms['theForm'].elements['cat_id'];

      for (i = 0; i < selCat.length; i++)
      {
          var opt = document.createElement("OPTION");
          opt.text = selCat.options[i].text;
          opt.value = selCat.options[i].value;
          if (Browser.isIE)
          {
              sel.add(opt);
          }
          else
          {
              sel.appendChild(opt);
          }
      }
      conObj.appendChild(sel);
      sel.name = "other_cat[]";
      sel.onChange = function() {checkIsLeaf(this);};
  }

  /* 关联商品函数 */
  function searchGoods(szObject, catId, brandId, keyword)
  {
      var filters = new Object;

      filters.cat_id = elements[catId].value;
      filters.brand_id = elements[brandId].value;
      filters.keyword = Utils.trim(elements[keyword].value);
      filters.exclude = document.forms['theForm'].elements['goods_id'].value;

      szObject.loadOptions('get_goods_list', filters);
  }

  /**
   * 关联文章函数
   */
  function searchArticle()
  {
    var filters = new Object;

    filters.title = Utils.trim(elements['article_title'].value);

    sz3.loadOptions('get_article_list', filters);
  }

  /**
   * 新增一个图片
   */
  function addImg(obj)
  {
      var src  = obj.parentNode.parentNode;
      var idx  = rowindex(src);
      var tbl  = document.getElementById('gallery-table');
      var row  = tbl.insertRow(idx + 1);
      var cell = row.insertCell(-1);
      cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addImg)(.*)(\[)(\+)/i, "$1removeImg$3$4-");
  }

  /**
   * 删除图片上传
   */
  function removeImg(obj)
  {
      var row = rowindex(obj.parentNode.parentNode);
      var tbl = document.getElementById('gallery-table');

      tbl.deleteRow(row);
  }

  /**
   * 删除图片
   */
  function dropImg(imgId)
  {
    Ajax.call('goods.php?is_ajax=1&act=drop_image', "img_id="+imgId, dropImgResponse, "GET", "JSON");
  }

  function dropImgResponse(result)
  {
      if (result.error == 0)
      {
          document.getElementById('gallery_' + result.content).style.display = 'none';
      }
  }

  /**
   * 将市场价格取整
   */
  function integral_market_price()
  {
    document.forms['theForm'].elements['market_price'].value = parseInt(document.forms['theForm'].elements['market_price'].value);
  }

   /**
   * 将积分购买额度取整
   */
  function parseint_integral()
  {
    document.forms['theForm'].elements['integral'].value = parseInt(document.forms['theForm'].elements['integral'].value);
  }


  /**
  * 检查货号是否存在
  */
  function checkGoodsSn(goods_sn, goods_id)
  {
    if (goods_sn == '')
    {
        document.getElementById('goods_sn_notice').innerHTML = "";
        return;
    }

    var callback = function(res)
    {
      if (res.error > 0)
      {
        document.getElementById('goods_sn_notice').innerHTML = res.message;
        document.getElementById('goods_sn_notice').style.color = "red";
      }
      else
      {
        document.getElementById('goods_sn_notice').innerHTML = "";
      }
    }
    Ajax.call('goods.php?is_ajax=1&act=check_goods_sn', "goods_sn=" + goods_sn + "&goods_id=" + goods_id, callback, "GET", "JSON");
  }

  /**
   * 新增一个优惠价格
   */
  function addVolumePrice(obj)
  {
    var src      = obj.parentNode.parentNode;
    var tbl      = document.getElementById('tbody-volume');

    var validator  = new Validator('theForm');
    checkVolumeData("0",validator);
    if (!validator.passed())
    {
      return false;
    }

    var row  = tbl.insertRow(tbl.rows.length);
    var cell = row.insertCell(-1);
    cell.innerHTML = src.cells[0].innerHTML.replace(/(.*)(addVolumePrice)(.*)(\[)(\+)/i, "$1removeVolumePrice$3$4-");

    var number_list = document.getElementsByName("volume_number[]");
    var price_list  = document.getElementsByName("volume_price[]");

    number_list[number_list.length-1].value = "";
    price_list[price_list.length-1].value   = "";
  }

  /**
   * 删除优惠价格
   */
  function removeVolumePrice(obj)
  {
    var row = rowindex(obj.parentNode.parentNode);
    var tbl = document.getElementById('tbody-volume');

    tbl.deleteRow(row);
  }

  /**
   * 校验优惠数据是否正确
   */
  function checkVolumeData(isSubmit,validator)
  {
    var volumeNum = document.getElementsByName("volume_number[]");
    var volumePri = document.getElementsByName("volume_price[]");
    var numErrNum = 0;
    var priErrNum = 0;

    for (i = 0 ; i < volumePri.length ; i ++)
    {
      if ((isSubmit != 1 || volumeNum.length > 1) && numErrNum <= 0 && volumeNum.item(i).value == "")
      {
        validator.addErrorMsg(volume_num_not_null);
        numErrNum++;
      }

      if (numErrNum <= 0 && Utils.trim(volumeNum.item(i).value) != "" && ! Utils.isNumber(Utils.trim(volumeNum.item(i).value)))
      {
        validator.addErrorMsg(volume_num_not_number);
        numErrNum++;
      }

      if ((isSubmit != 1 || volumePri.length > 1) && priErrNum <= 0 && volumePri.item(i).value == "")
      {
        validator.addErrorMsg(volume_price_not_null);
        priErrNum++;
      }

      if (priErrNum <= 0 && Utils.trim(volumePri.item(i).value) != "" && ! Utils.isNumber(Utils.trim(volumePri.item(i).value)))
      {
        validator.addErrorMsg(volume_price_not_number);
        priErrNum++;
      }
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