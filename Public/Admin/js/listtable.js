
  /* *
  * 调用此方法发送HTTP请求。
  *
  * @public
  * @param   {string}    url             请求的URL地址
  * @param   {mix}       params          发送参数
  * @param   {Function}  callback        回调函数
  * @param   {string}    ransferMode     请求的方式，有"GET"和"POST"两种
  * @param   {string}    responseType    响应类型，有"JSON"、"XML"和"TEXT"三种
  * @param   {boolean}   asyn            是否异步请求的方式
  * @param   {boolean}   quiet           是否安静模式请求
  * run : function (url, params, callback, transferMode, responseType, asyn, quiet)
  */
  

/* $Id: listtable.js 14980 2008-10-22 05:01:19Z testyang $ */
if (typeof Ajax != 'object')
{
  alert('Ajax object doesn\'t exists.');
}

if (typeof Utils != 'object')
{
  alert('Utils object doesn\'t exists.');
}

var listTable = new Object;

listTable.query = "query";
listTable.filter = new Object;
// listTable.url = location.href.lastIndexOf("?") == -1 ? location.href.substring((location.href.lastIndexOf("/")) + 1) : location.href.substring((location.href.lastIndexOf("/")) + 1, location.href.lastIndexOf("?"));
// listTable.url = location.href.substring(0, (location.href.lastIndexOf("/")) + 1);
// listTable.url += 'goods_curd_json';
listTable.url = 'goods_curd_json';
var url = 'goods_list_json';
/**
 * 创建一个可编辑区
 */
listTable.edit = function(obj, act, id)
{
  var tag = obj.firstChild.tagName;

  if (typeof(tag) != "undefined" && tag.toLowerCase() == "input")
  {
    return;
  }

  /* 保存原始的内容 */
  var org = obj.innerHTML;
  var val = Browser.isIE ? obj.innerText : obj.textContent;

  /* 创建一个输入框 */
  var txt = document.createElement("INPUT");
  txt.value = (val == 'N/A') ? '' : val;
  txt.style.width = (obj.offsetWidth + 12) + "px" ;

  /* 隐藏对象中的内容，并将输入框加入到对象中 */
  obj.innerHTML = "";
  obj.appendChild(txt);
  txt.focus();

  /* 编辑区输入事件处理函数 */
  txt.onkeypress = function(e)
  {
    var evt = Utils.fixEvent(e);
    var obj = Utils.srcElement(e);

    if (evt.keyCode == 13)
    {
      obj.blur();

      return false;
    }

    if (evt.keyCode == 27)
    {
      obj.parentNode.innerHTML = org;
    }
  }

  /* 编辑区失去焦点的处理函数 */
  txt.onblur = function(e)
  {
    if (Utils.trim(txt.value).length > 0)
    {
      res = Ajax.call(listTable.url, "act="+act+"&val=" + encodeURIComponent(Utils.trim(txt.value)) + "&id=" +id, null, "POST", "JSON", false);

      if (res.message)
      {
        alert(res.message);
      }

      if(res.id && (res.act == 'goods_auto' || res.act == 'article_auto'))
      {
          document.getElementById('del'+res.id).innerHTML = "<a href=\""+ thisfile +"?goods_id="+ res.id +"&act=del\" onclick=\"return confirm('"+deleteck+"');\">"+deleteid+"</a>";
      }

      obj.innerHTML = (res.error == 0) ? res.content : org;
    }
    else
    {
      obj.innerHTML = org;
    }
  }
}

/**
 * 切换状态
 */
listTable.toggle = function(obj, act, id)
{
	// var img_url = "123";
  var val = (obj.src.match(/yes.gif/i)) ? 0 : 1;

  var res = Ajax.call(this.url, "act="+act+"&val=" + val + "&id=" +id, null, "POST", "JSON", false);

  if (res.message)
  {
    alert(res.message);
  }

  if (res.error == 0)
  {
    obj.src = (res.content > 0) ? img_url+'/yes.gif' : img_url+'/no.gif';
  }
}

/**
 * 切换排序方式
 */
listTable.sort = function(sortname, sortorder)
{
  var args = "act="+this.query+"&sortname="+sortname+"&sortorder=";
  args += this.filter.sortorder == "DESC" ? "ASC" : "DESC";
/*
  if (this.filter.sortname == sortname)
  {
    args += this.filter.sortorder == "DESC" ? "ASC" : "DESC";
  }
  else
  {
    args += "DESC";
  }
*/
  for (var i in this.filter)
  {
    if (typeof(this.filter[i]) != "function" &&
      i != "sortorder" && i != "sortname" && !Utils.isEmpty(this.filter[i]))
    {
      args += "&" + i + "=" + this.filter[i];
    }
  }

  this.filter['page_size'] = this.getPageSize();

  Ajax.call(url, args, this.listCallback, "POST", "JSON");
}

/**
 * 翻页
 */
listTable.gotoPage = function(page)
{
  if (page != null) this.filter['page'] = page;
	
  if (this.filter['page'] > this.pageCount) this.filter['page'] = 1;

  this.filter['page_size'] = this.getPageSize();

  this.loadList();
}

/**
 * 载入列表
 */
listTable.loadList = function()
{
  var args = "act="+this.query+"" + this.compileFilter();

  Ajax.call(url, args, this.listCallback, "POST", "JSON");
}

/**
 * 删除列表中的一个记录
 */
listTable.remove = function(id, cfm, opt)
{
  if (opt == null)
  {
    opt = "remove";
  }

  if (confirm(cfm))
  {
    var args = "act=" + opt + "&id=" + id + this.compileFilter();

    Ajax.call(this.url, args, this.listCallback, "GET", "JSON");
  }
}
// 第一页
listTable.gotoPageFirst = function()
{
  if (this.filter.page > 1)
  {
    listTable.gotoPage(1);
  }
}
// 上一页
listTable.gotoPagePrev = function()
{
  if (this.filter.page > 1)
  {
    listTable.gotoPage(this.filter.page - 1);
  }
}
// 下一页
listTable.gotoPageNext = function()
{
 
  if (this.filter.page < listTable.pageCount)
  {
    listTable.gotoPage(parseInt(this.filter.page) + 1);
  }
}
// 最后一页
listTable.gotoPageLast = function()
{
  if (this.filter.page < listTable.pageCount)
  {
    listTable.gotoPage(listTable.pageCount);
  }
}
// 改变分页数量
listTable.changePageSize = function(e)
{
    var evt = Utils.fixEvent(e);
    if (evt.keyCode == 13)
    {
        listTable.gotoPage();
        return false;
    };
}
// 用于ajax的回调函数
listTable.listCallback = function(result, txt)
{
  if (result.error > 0)
  {
    alert(result.message);
  }
  else
  {
    try
    {
      document.getElementById('listDiv').innerHTML = typeof result.content !== 'undefined' ? result.content : result.error;
	
      if (typeof result.filter == "object")
      {
        listTable.filter = result.filter;	// listTable.filter修改属性值
      }

      listTable.pageCount = result.page_count;
    }
    catch (e)
    {
      alert(e.message);
    }
  }
}
// 复选框全选功能
listTable.selectAll = function(obj, chk)
{
  if (chk == null)
  {
    chk = 'checkboxes';
  }

  var elems = obj.form.getElementsByTagName("INPUT");

  for (var i=0; i < elems.length; i++)
  {
    if (elems[i].name == chk || elems[i].name == chk + "[]")
    {
      elems[i].checked = obj.checked;
    }
  }
}

listTable.compileFilter = function()
{
  var args = '';
  for (var i in this.filter)
  {
    // if (typeof(this.filter[i]) != "function" && typeof(this.filter[i]) != "undefined")
    if (typeof(this.filter[i]) != "function" && !Utils.isEmpty(this.filter[i]))
	{
      args += "&" + i + "=" + encodeURIComponent(this.filter[i]);
    }
  }

  return args;
}

listTable.getPageSize = function()
{
 /*
  var ps = 15;

  pageSize = document.getElementById("pageSize");

  if (pageSize)
  {
    ps = Utils.isInt(pageSize.value) ? pageSize.value : 15;
    document.cookie = "ECSCP[page_size]=" + ps + ";";
  }
 */
 var ps = document.getElementById("pageSize").value;
 return ps ? ps : 15;
}

listTable.addRow = function(checkFunc)
{
  cleanWhitespace(document.getElementById("listDiv"));
  var table = document.getElementById("listDiv").childNodes[0];
  var firstRow = table.rows[0];
  var newRow = table.insertRow(-1);
  newRow.align = "center";
  var items = new Object();
  for(var i=0; i < firstRow.cells.length;i++) {
    var cel = firstRow.cells[i];
    var celName = cel.getAttribute("name");
    var newCel = newRow.insertCell(-1);
    if (!cel.getAttribute("ReadOnly") && cel.getAttribute("Type")=="TextBox")
    {
      items[celName] = document.createElement("input");
      items[celName].type  = "text";
      items[celName].style.width = "50px";
      items[celName].onkeypress = function(e)
      {
        var evt = Utils.fixEvent(e);
        var obj = Utils.srcElement(e);

        if (evt.keyCode == 13)
        {
          listTable.saveFunc();
        }
      }
      newCel.appendChild(items[celName]);
    }
    if (cel.getAttribute("Type") == "Button")
    {
      var saveBtn   = document.createElement("input");
      saveBtn.type  = "image";
      saveBtn.src = "./images/icon_add.gif";
      saveBtn.value = save;
      newCel.appendChild(saveBtn);
      this.saveFunc = function()
      {
        if (checkFunc)
        {
          if (!checkFunc(items))
          {
            return false;
          }
        }
        var str = "act=add";
        for(var key in items)
        {
          if (typeof(items[key]) != "function")
          {
            str += "&" + key + "=" + items[key].value;
          }
        }
        res = Ajax.call(listTable.url, str, null, "POST", "JSON", false);
        if (res.error)
        {
          alert(res.message);
          table.deleteRow(table.rows.length-1);
          items = null;
        }
        else
        {
          document.getElementById("listDiv").innerHTML = res.content;
          if (document.getElementById("listDiv").childNodes[0].rows.length < 6)
          {
             listTable.addRow(checkFunc);
          }
          items = null;
        }
      }
      saveBtn.onclick = this.saveFunc;

      //var delBtn   = document.createElement("input");
      //delBtn.type  = "image";
      //delBtn.src = "./images/no.gif";
      //delBtn.value = cancel;
      //newCel.appendChild(delBtn);
    }
  }

}
