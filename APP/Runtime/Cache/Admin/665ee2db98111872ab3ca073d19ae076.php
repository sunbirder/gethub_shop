<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0048)http://localhost/ecshop/admin/index.php?act=menu -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>ECSHOP Menu</title>

<link href="__CSS__/general.css" rel="stylesheet" type="text/css">
<script language="JavaScript">
<!--
var noHelp   = "<p align='center' style='color: #666'>暂时还没有该部分内容</p>";
var helpLang = "zh_cn";
//-->
</script>

<style type="text/css">
body {
  background: #80BDCB;
}
#tabbar-div {
  background: #278296;
  padding-left: 10px;
  height: 21px;
  padding-top: 0px;
}
#tabbar-div p {
  margin: 1px 0 0 0;
}
.tab-front {
  background: #80BDCB;
  line-height: 20px;
  font-weight: bold;
  padding: 4px 15px 4px 18px;
  border-right: 2px solid #335b64;
  cursor: hand;
  cursor: pointer;
}
.tab-back {
  color: #F4FAFB;
  line-height: 20px;
  padding: 4px 15px 4px 18px;
  cursor: hand;
  cursor: pointer;
}
.tab-hover {
  color: #F4FAFB;
  line-height: 20px;
  padding: 4px 15px 4px 18px;
  cursor: hand;
  cursor: pointer;
  background: #2F9DB5;
}
#top-div
{
  padding: 3px 0 2px;
  background: #BBDDE5;
  margin: 5px;
  text-align: center;
}
#main-div {
  border: 1px solid #345C65;
  padding: 5px;
  margin: 5px;
  background: #FFF;
}
#menu-list {
  padding: 0;
  margin: 0;
}
#menu-list ul {
  padding: 0;
  margin: 0;
  list-style-type: none;
  color: #335B64;
}
#menu-list li {
  padding-left: 16px;
  line-height: 16px;
  cursor: hand;
  cursor: pointer;
}
#main-div a:visited, #menu-list a:link, #menu-list a:hover {
  color: #335B64
  text-decoration: none;
}
#menu-list a:active {
  color: #EB8A3D;
}
.explode {
  background: url(__IMG__/menu_minus.gif) no-repeat 0px 3px;
  font-weight: bold;
}
.collapse {
  background: url(__IMG__/menu_plus.gif) no-repeat 0px 3px;
  font-weight: bold;
}
.menu-item {
  background: url(__IMG__/menu_arrow.gif) no-repeat 0px 3px;
  font-weight: normal;
}
#help-title {
  font-size: 14px;
  color: #000080;
  margin: 5px 0;
  padding: 0px;
}
#help-content {
  margin: 0;
  padding: 0;
}
.tips {
  color: #CC0000;
}
.link {
  color: #000099;
}
</style>

</head>
<body>
<div id="tabbar-div">
<p><span style="float:right; padding: 3px 5px;"><a href="javascript:toggleCollapse();">
  <img id="toggleImg" src="__IMG__/menu_minus.gif" width="9" height="9" border="0" alt="闭合"></a></span>
  <span class="tab-front" id="menu-tab">菜单</span>
</p>
</div>
<div id="main-div">
<div id="menu-list">
<ul>
  <li class="explode" key="02_cat_and_goods" name="menu">
    商品管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods.php?act=list" target="main-frame">商品列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods.php?act=add" target="main-frame">添加新商品</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/category.php?act=list" target="main-frame">商品分类</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/comment_manage.php?act=list" target="main-frame">用户评论</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/brand.php?act=list" target="main-frame">商品品牌</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_type.php?act=manage" target="main-frame">商品类型</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods.php?act=trash" target="main-frame">商品回收站</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/picture_batch.php" target="main-frame">图片批量处理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_batch.php?act=add" target="main-frame">商品批量上传</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_export.php?act=goods_export" target="main-frame">商品批量导出</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_batch.php?act=select" target="main-frame">商品批量修改</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/gen_goods_script.php?act=setup" target="main-frame">生成商品代码</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/tag_manage.php?act=list" target="main-frame">标签管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods.php?act=list&extension_code=virtual_card" target="main-frame">虚拟商品列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods.php?act=add&extension_code=virtual_card" target="main-frame">添加虚拟商品</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/virtual_card.php?act=change" target="main-frame">更改加密串</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_auto.php?act=list" target="main-frame">商品自动上下架</a></li>
        </ul>
      </li>
  <li class="explode" key="03_promotion" name="menu">
    促销管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/snatch.php?act=list" target="main-frame">夺宝奇兵</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/bonus.php?act=list" target="main-frame">红包类型</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/pack.php?act=list" target="main-frame">商品包装</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/card.php?act=list" target="main-frame">祝福贺卡</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/group_buy.php?act=list" target="main-frame">团购活动</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/topic.php?act=list" target="main-frame">专题管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/auction.php?act=list" target="main-frame">拍卖活动</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/favourable.php?act=list" target="main-frame">优惠活动</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/wholesale.php?act=list" target="main-frame">批发管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/package.php?act=list" target="main-frame">超值礼包</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/exchange_goods.php?act=list" target="main-frame">积分商城商品</a></li>
        </ul>
      </li>
  <li class="explode" key="04_order" name="menu">
    订单管理        <ul>
          <li class="menu-item"><a href="<?php echo U(GROUP_NAME.'/Order/order_list');?>" target="main-frame">订单列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=order_query" target="main-frame">订单查询</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=merge" target="main-frame">合并订单</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=templates" target="main-frame">订单打印</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/goods_booking.php?act=list_all" target="main-frame">缺货登记</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=add" target="main-frame">添加订单</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=delivery_list" target="main-frame">发货单列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order.php?act=back_list" target="main-frame">退货单列表</a></li>
        </ul>
      </li>
  <li class="explode" key="05_banner" name="menu">
    广告管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/ads.php?act=list" target="main-frame">广告列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/ad_position.php?act=list" target="main-frame">广告位置</a></li>
        </ul>
      </li>
  <li class="explode" key="06_stats" name="menu">
    报表统计        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/flow_stats.php?act=view" target="main-frame">流量分析</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/guest_stats.php?act=list" target="main-frame">客户统计</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/order_stats.php?act=list" target="main-frame">订单统计</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sale_general.php?act=list" target="main-frame">销售概况</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/users_order.php?act=order_num" target="main-frame">会员排行</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sale_list.php?act=list" target="main-frame">销售明细</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/searchengine_stats.php?act=view" target="main-frame">搜索引擎</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sale_order.php?act=goods_num" target="main-frame">销售排行</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/visit_sold.php?act=list" target="main-frame">访问购买率</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/adsense.php?act=list" target="main-frame">站外投放JS</a></li>
        </ul>
      </li>
  <li class="explode" key="07_content" name="menu">
    文章管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/articlecat.php?act=list" target="main-frame">文章分类</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/article.php?act=list" target="main-frame">文章列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/article_auto.php?act=list" target="main-frame">文章自动发布</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/vote.php?act=list" target="main-frame">在线调查</a></li>
        </ul>
      </li>
  <li class="explode" key="08_members" name="menu">
    会员管理        <ul>
          <li class="menu-item"><a href="<?php echo U(GROUP_NAME.'/User/user_list');?>" target="main-frame">会员列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/users.php?act=add" target="main-frame">添加会员</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/user_rank.php?act=list" target="main-frame">会员等级</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/integrate.php?act=list" target="main-frame">会员整合</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/user_msg.php?act=list_all" target="main-frame">会员留言</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/user_account.php?act=list" target="main-frame">充值和提现申请</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/user_account_manage.php?act=list" target="main-frame">资金管理</a></li>
        </ul>
      </li>
  <li class="explode" key="10_priv_admin" name="menu">
    权限管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/privilege.php?act=list" target="main-frame">管理员列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/admin_logs.php?act=list" target="main-frame">管理员日志</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/role.php?act=list" target="main-frame">角色管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/agency.php?act=list" target="main-frame">办事处列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/suppliers.php?act=list" target="main-frame">供货商列表</a></li>
        </ul>
      </li>
  <li class="explode" key="11_system" name="menu">
    系统设置        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/shop_config.php?act=list_edit" target="main-frame">商店设置</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/reg_fields.php?act=list" target="main-frame">会员注册项设置</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/payment.php?act=list" target="main-frame">支付方式</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/shipping.php?act=list" target="main-frame">配送方式</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/shop_config.php?act=mail_settings" target="main-frame">邮件服务器设置</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/area_manage.php?act=list" target="main-frame">地区列表</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/cron.php?act=list" target="main-frame">计划任务</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/friend_link.php?act=list" target="main-frame">友情链接</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/captcha_manage.php?act=main" target="main-frame">验证码管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/check_file_priv.php?act=check" target="main-frame">文件权限检测</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/filecheck.php" target="main-frame">文件校验</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/flashplay.php?act=list" target="main-frame">首页主广告管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/navigator.php?act=list" target="main-frame">自定义导航栏</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/license.php?act=list_edit" target="main-frame">授权证书</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/webcollect.php" target="main-frame">网罗天下</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sitemap.php" target="main-frame">站点地图</a></li>
        </ul>
      </li>
  <li class="explode" key="12_template" name="menu">
    模板管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/template.php?act=list" target="main-frame">模板选择</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/template.php?act=setup" target="main-frame">设置模板</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/template.php?act=library" target="main-frame">库项目管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/edit_languages.php?act=list" target="main-frame">语言项编辑</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/template.php?act=backup_setting" target="main-frame">模板设置备份</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/mail_template.php?act=list" target="main-frame">邮件模板</a></li>
        </ul>
      </li>
  <li class="explode" key="13_backup" name="menu">
    数据库管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/database.php?act=backup" target="main-frame">数据备份</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/database.php?act=optimize" target="main-frame">数据表优化</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sql.php?act=main" target="main-frame">SQL查询</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/convert.php?act=main" target="main-frame">转换数据</a></li>
        </ul>
      </li>
  <li class="explode" key="14_sms" name="menu">
    短信管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/sms.php?act=display_send_ui" target="main-frame">发送短信</a></li>
        </ul>
      </li>
  <li class="explode" key="15_rec" name="menu">
    推荐管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/affiliate.php?act=list" target="main-frame">推荐设置</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/affiliate_ck.php?act=list" target="main-frame">分成管理</a></li>
        </ul>
      </li>
  <li class="explode" key="16_email_manage" name="menu">
    邮件群发管理        <ul>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/attention_list.php?act=list" target="main-frame">关注管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/email_list.php?act=list" target="main-frame">邮件订阅管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/magazine_list.php?act=list" target="main-frame">杂志管理</a></li>
          <li class="menu-item"><a href="http://localhost/ecshop/admin/view_sendlist.php?act=list" target="main-frame">邮件队列管理</a></li>
        </ul>
      </li>
  <script language="JavaScript" src="menu_ext.php"></script>
</ul>
</div>
<div id="help-div" style="display:none">
<h1 id="help-title"></h1>
<div id="help-content"></div>
</div>
</div>
<script type="text/javascript" src="__JS__/global.js"></script>
<script type="text/javascript" src="__JS__/utils.js"></script>
<script type="text/javascript" src="__JS__/transport.js"></script>
<script language="JavaScript">
<!--
var collapse_all = "闭合";
var expand_all = "展开";
var collapse = true;

function toggleCollapse()
{
  var items = document.getElementsByTagName('LI');
  for (i = 0; i < items.length; i++)
  {
    if (collapse)
    {
      if (items[i].className == "explode")
      {
        toggleCollapseExpand(items[i], "collapse");
      }
    }
    else
    {
      if ( items[i].className == "collapse")
      {
        toggleCollapseExpand(items[i], "explode");
        ToggleHanlder.Reset();
      }
    }
  }

  collapse = !collapse;
  document.getElementById('toggleImg').src = collapse ? '__IMG__/menu_minus.gif' : '__IMG__/menu_plus.gif';
  document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
}

function toggleCollapseExpand(obj, status)
{
  if (obj.tagName.toLowerCase() == 'li' && obj.className != 'menu-item')
  {
    for (i = 0; i < obj.childNodes.length; i++)
    {
      if (obj.childNodes[i].tagName == "UL")
      {
        if (status == null)
        {
          if (obj.childNodes[1].style.display != "none")
          {
            obj.childNodes[1].style.display = "none";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            obj.childNodes[1].style.display = "block";
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          break;
        }
        else
        {
          if( status == "collapse")
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "collapse");
            obj.className = "collapse";
          }
          else
          {
            ToggleHanlder.RecordState(obj.getAttribute("key"), "explode");
            obj.className = "explode";
          }
          obj.childNodes[1].style.display = (status == "explode") ? "block" : "none";
        }
      }
    }
  }
}
document.getElementById('menu-list').onclick = function(e)
{
  var obj = Utils.srcElement(e);
  toggleCollapseExpand(obj);
}

document.getElementById('tabbar-div').onmouseover=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-back")
  {
    obj.className = "tab-hover";
  }
}

document.getElementById('tabbar-div').onmouseout=function(e)
{
  var obj = Utils.srcElement(e);

  if (obj.className == "tab-hover")
  {
    obj.className = "tab-back";
  }
}

document.getElementById('tabbar-div').onclick=function(e)
{
  var obj = Utils.srcElement(e);

 // var mnuTab = document.getElementById('menu-tab');
  var hlpTab = document.getElementById('help-tab');
  var mnuDiv = document.getElementById('menu-list');
  var hlpDiv = document.getElementById('help-div');

  //if (obj.id == 'menu-tab')
//  {
//    mnuTab.className = 'tab-front';
//    hlpTab.className = 'tab-back';
//    mnuDiv.style.display = "block";
//    hlpDiv.style.display = "none";
//  }

  if (obj.id == 'help-tab')
  {
    mnuTab.className = 'tab-back';
    hlpTab.className = 'tab-front';
    mnuDiv.style.display = "none";
    hlpDiv.style.display = "block";

    loc = parent.frames['main-frame'].location.href;
    pos1 = loc.lastIndexOf("/");
    pos2 = loc.lastIndexOf("?");
    pos3 = loc.indexOf("act=");
    pos4 = loc.indexOf("&", pos3);

    filename = loc.substring(pos1 + 1, pos2 - 4);
    act = pos4 < 0 ? loc.substring(pos3 + 4) : loc.substring(pos3 + 4, pos4);
    loadHelp(filename, act);
  }
}

/**
 * 创建XML对象
 */
function createDocument()
{
  var xmlDoc;

  // create a DOM object
  if (window.ActiveXObject)
  {
    try
    {
      xmlDoc = new ActiveXObject("Msxml2.DOMDocument.6.0");
    }
    catch (e)
    {
      try
      {
        xmlDoc = new ActiveXObject("Msxml2.DOMDocument.5.0");
      }
      catch (e)
      {
        try
        {
          xmlDoc = new ActiveXObject("Msxml2.DOMDocument.4.0");
        }
        catch (e)
        {
          try
          {
            xmlDoc = new ActiveXObject("Msxml2.DOMDocument.3.0");
          }
          catch (e)
          {
            alert(e.message);
          }
        }
      }
    }
  }
  else
  {
    if (document.implementation && document.implementation.createDocument)
    {
      xmlDoc = document.implementation.createDocument("","doc",null);
    }
    else
    {
      alert("Create XML object is failed.");
    }
  }
  xmlDoc.async = false;

  return xmlDoc;
}

//菜单展合状态处理器
var ToggleHanlder = new Object();

Object.extend(ToggleHanlder ,{
  SourceObject : new Object(),
  CookieName   : 'Toggle_State',
  RecordState : function(name,state)
  {
    if(state == "collapse")
    {
      this.SourceObject[name] = state;
    }
    else
    {
      if(this.SourceObject[name])
      {
        delete(this.SourceObject[name]);
      }
    }
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, this.SourceObject.toJSONString(), date.toGMTString());
  },

  Reset :function()
  {
    var date = new Date();
    date.setTime(date.getTime() + 99999999);
    document.setCookie(this.CookieName, "{}" , date.toGMTString());
  },

  Load : function()
  {
    if (document.getCookie(this.CookieName) != null)
    {
      this.SourceObject = eval("("+ document.getCookie(this.CookieName) +")");
      var items = document.getElementsByTagName('LI');
      for (var i = 0; i < items.length; i++)
      {
        if ( items[0].getAttribute("name") == "menu")
        {
          for (var k in this.SourceObject)
          {
            if ( typeof(items[i]) == "object")
            {
              if (items[i].getAttribute('key') == k)
              {
                toggleCollapseExpand(items[i], this.SourceObject[k]);
                collapse = false;
              }
            }
          }
        }
     }
    }
    document.getElementById('toggleImg').src = collapse ? '__IMG__/menu_minus.gif' : '__IMG__/menu_plus.gif';
    document.getElementById('toggleImg').alt = collapse ? collapse_all : expand_all;
  }
});

ToggleHanlder.CookieName += "_1";
//初始化菜单状态
ToggleHanlder.Load();

//-->
</script>


</body></html>