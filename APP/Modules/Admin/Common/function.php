<?php
define('__IMG__', __ROOT__.'/Public/'.GROUP_NAME.'/images');
/**
 * 获得商品列表
 *
 * @access  public
 * @params  integer $isdelete
 * @params  integer $real_goods
 * @params  integer $conditions
 * @return  array
 */
      // $this->assign('PAGESIZE', $page_size);
      // $this->assign('COUNT', count($goods_list));
      // $this->assign('PAGECOUNT', ceil(count($goods_list)/$page_size));
      // $this->assign('goods_list', array_slice($goods_list, 0, $page_size));
function goods_list($goods_list)
{
    is_array($goods_list) ? @extract($goods_list) : die(json_encode(array('error' => '您查找的数据为空')));
    $str = "
         <table cellpadding='3' cellspacing='1'>
                                <tr>
                                  <th>
                                    <input onclick='listTable.selectAll(this, \"checkboxes\")' type='checkbox' />
                                    <a href=javascript:listTable.sort('goods_id'); >编号</a>
                                    <img src='".__IMG__."/sort_desc.gif'/>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('goods_name'); >商品名称</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('goods_sn'); >货号</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('shop_price'); >价格</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('is_on_sale'); >上架</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('is_best'); >精品</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('is_new'); >新品</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('is_hot'); >热销</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('sort_order'); >推荐排序</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('goods_number'); >库存</a>
                                  </th>
                                  <th>操作</th>
    ";
    foreach ($goods_list as $goods) {
        $goods[is_on_sale] = $goods[is_on_sale] ? 'yes' : 'no';
        $goods[is_best] = $goods[is_best] ? 'yes' : 'no';
        $goods[is_new] = $goods[is_new] ? 'yes' : 'no';
        $goods[is_hot] = $goods[is_hot] ? 'yes' : 'no';
        $is_promote_color = $goods['is_promote'] ? 'color:red' : '';
        $str .= "
            <tr>
                <td>
                  <input type='checkbox' name='checkboxes[]' value='$goods[goods_id]' />  
                  $goods[goods_id]
                </td>
                <td class='first-cell' style='$is_promote_color'>
                  <span onclick='listTable.edit(this, \"edit_goods_name\", $goods[goods_id])'>$goods[goods_name]</span>
                </td>
                <td>
                  <span onclick='listTable.edit(this, \"edit_goods_sn\", $goods[goods_id])'>$goods[goods_sn]</span>
                </td>
                <td align='right'>
                  <span onclick='listTable.edit(this, \"edit_goods_price\", $goods[goods_id])'>$goods[shop_price]</span>
                </td>
                <td align='center'>
                  <img src='".__IMG__."/".$goods[is_on_sale].".gif' onclick='listTable.toggle(this, \"toggle_on_sale\", $goods[goods_id])' />  
                </td>
                <td align='center'>
                  <img src='".__IMG__."/".$goods[is_best].".gif' onclick='listTable.toggle(this, \"toggle_best\", $goods[goods_id])' />  
                </td>
                <td align='center'>
                  <img src='".__IMG__."/".$goods[is_new].".gif' onclick='listTable.toggle(this, \"toggle_new\", $goods[goods_id])' />  
                </td>
                <td align='center'>
                  <img src='".__IMG__."/".$goods[is_hot].".gif' onclick='listTable.toggle(this, \"toggle_hot\", $goods[goods_id])' />  
                </td>
                <td align='center'>
                  <span onclick='listTable.edit(this, \"edit_sort_order\", $goods[goods_id])'>$goods[sort_order]</span>
                </td>
                <td align='right'>
                  <span onclick='listTable.edit(this, \"edit_goods_number\", $goods[goods_id])'>$goods[goods_number]</span>
                </td>
                <td align='center'>
                  <a href='../goods.php?id=$goods[goods_id]' target='_blank' title='查看'>
                    <img src='".__IMG__."/icon_view.gif' width='16' height='16' border='0' />    
                  </a>
                  <a href='goods.php?act=edit&goods_id=$goods[goods_id]' title='编辑'>
                    <img src='".__IMG__."/icon_edit.gif' width='16' height='16' border='0' />    
                  </a>
                  <a href='goods.php?act=copy&goods_id=$goods[goods_id]' title='复制'>
                    <img src='".__IMG__."/icon_copy.gif' width='16' height='16' border='0' />    
                  </a>
                  <a href='javascript:;' onclick='listTable.remove($goods[goods_id], \"您确实要把该商品放入回收站吗？\" )' title='回收站'>
                    <img src='".__IMG__."/icon_trash.gif' width='16' height='16' border='0' />    
                  </a>
                  <!--<if condition='$goods.goods_type neq null'>
                    <a href='goods.php?act=product_list&goods_id=$goods[goods_id]' title='货品列表'>
                      <img src='".__IMG__."/icon_docs.gif' width='16' height='16' border='0' />    
                    </a>
                   :     
                    <img src='".__IMG__."/empty.gif' width='16' height='16' border='0' />    
                  </if>-->
                </td>
              </tr>       
        ";
    }

    $option_str = "";
    for ($i=1; $i<$PAGECOUNT ; $i++)  {
        $option_str .= "<option value='$i'>$i</option>";
    }

    $str .= "</table>
        <!-- 分页 -->
          <table id='page-table' cellspacing='0'>
            <tr>
              <td align='right' nowrap='true'>
                <div id='turn-page'>
                  总计
                  <span id='totalRecords'>$COUNT</span>
                  个记录分为
                  <span id='totalPages'>$PAGECOUNT</span>
                  页当前第
                  <span id='pageCurrent'>$PAGE</span>
                  页，每页
                  <input type='text' size='3' id='pageSize' value='$PAGESIZE' onkeypress='return listTable.changePageSize(event)' />
                  <span id='page-link'>
                    <a href='javascript:listTable.gotoPageFirst()'>第一页</a>
                    <a href='javascript:listTable.gotoPagePrev()'>上一页</a>
                    <a href='javascript:listTable.gotoPageNext()'>下一页</a>
                    <a href='javascript:listTable.gotoPageLast()'>最末页</a>
                    <select id='gotoPage' onchange='listTable.gotoPage(this.value)'>".
                      $option_str
                    ."</select>
                  </span>
                </div>
              </td>
            </tr>
          </table>


    ";
    return $str;
}

function goods_recycle($goods_list){
    is_array($goods_list) ? @extract($goods_list) : die(json_encode(array('error' => '您查找的数据为空')));
    $str = "
         <table cellpadding='3' cellspacing='1'>
                                <tr>
                                  <th>
                                    <input onclick='listTable.selectAll(this, \"checkboxes\")' type='checkbox' />
                                    <a href=javascript:listTable.sort('goods_id'); >编号</a>
                                    <img src='".__IMG__."/sort_desc.gif'/>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('goods_name'); >商品名称</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('goods_sn'); >货号</a>
                                  </th>
                                  <th>
                                    <a href=javascript:listTable.sort('shop_price'); >价格</a>
                                  </th>
                                  <th>操作</th>
    ";
    foreach ($goods_list as $goods) {
        $goods[is_on_sale] = $goods[is_on_sale] ? 'yes' : 'no';
        $goods[is_best] = $goods[is_best] ? 'yes' : 'no';
        $goods[is_new] = $goods[is_new] ? 'yes' : 'no';
        $goods[is_hot] = $goods[is_hot] ? 'yes' : 'no';
        $is_promote_color = $goods['is_promote'] ? 'color:red' : '';
        $str .= "
            <tr>
                <td>
                  <input type='checkbox' name='checkboxes[]' value='$goods[goods_id]' />  
                  $goods[goods_id]
                </td>
                <td class='first-cell' style='$is_promote_color'>
                  <span onclick='listTable.edit(this, \"edit_goods_name\", $goods[goods_id])'>$goods[goods_name]</span>
                </td>
                <td>
                  <span onclick='listTable.edit(this, \"edit_goods_sn\", $goods[goods_id])'>$goods[goods_sn]</span>
                </td>
                <td align='right'>
                  <span onclick='listTable.edit(this, \"edit_goods_price\", $goods[goods_id])'>$goods[shop_price]</span>
                </td>
                 <td align='center'>
                  <a href='javascript:;' onclick='listTable.remove($goods[goods_id], \"您确实要把该商品还原吗？\", \"restore_goods\")'>还原</a>
                   |
                  <a href='javascript:;' onclick='listTable.remove($goods[goods_id], \"您确实要删除该商品吗？\", \"drop_goods\")'>删除</a>
                </td>
              </tr>       
        ";
    }

    $option_str = "";
    for ($i=1; $i<$PAGECOUNT ; $i++)  {
        $option_str .= "<option value='$i'>$i</option>";
    }

    $str .= "</table>
        <!-- 分页 -->
          <table id='page-table' cellspacing='0'>
            <tr>
              <td align='right' nowrap='true'>
                <div id='turn-page'>
                  总计
                  <span id='totalRecords'>$COUNT</span>
                  个记录分为
                  <span id='totalPages'>$PAGECOUNT</span>
                  页当前第
                  <span id='pageCurrent'>$PAGE</span>
                  页，每页
                  <input type='text' size='3' id='pageSize' value='$PAGESIZE' onkeypress='return listTable.changePageSize(event)' />
                  <span id='page-link'>
                    <a href='javascript:listTable.gotoPageFirst()'>第一页</a>
                    <a href='javascript:listTable.gotoPagePrev()'>上一页</a>
                    <a href='javascript:listTable.gotoPageNext()'>下一页</a>
                    <a href='javascript:listTable.gotoPageLast()'>最末页</a>
                    <select id='gotoPage' onchange='listTable.gotoPage(this.value)'>".
                      $option_str
                    ."</select>
                  </span>
                </div>
              </td>
            </tr>
          </table>


    ";
    return $str;
}


function GetCategoryTreeChild($spec_cat_id){
  //SELECT c.cat_id, c.cat_name, c.measure_unit, c.parent_id, c.is_show, 
    //c.show_in_nav, c.grade, c.sort_order, COUNT(s.cat_id) AS has_children 
    //FROM `category` AS c LEFT JOIN `category` AS s ON s.parent_id=c.cat_id 
    //GROUP BY c.cat_id ORDER BY c.parent_id, c.sort_order ASC
    $sql = "SELECT c.cat_id, c.cat_name, c.measure_unit, c.parent_id, c.is_show, c.show_in_nav, c.grade, c.sort_order, COUNT(s.cat_id) AS has_children 
            FROM `shop`.`ecs_category` AS c LEFT JOIN `shop`.`ecs_category` AS s ON s.parent_id=c.cat_id 
            GROUP BY c.cat_id ORDER BY c.parent_id, c.sort_order ASC";
    $arr =M()->query($sql);
      // var_dump($cat_res);exit;
    static $cat_options = array();

    if (isset($cat_options[$spec_cat_id]))
    {
        return $cat_options[$spec_cat_id];
    }

    // if (!isset($cat_options[0]))
    // {
        $level = $last_cat_id = 0;
        $options = $cat_id_array = $level_array = array();
        // if ($data === false)
        // {
            while (!empty($arr))
            {
                foreach ($arr AS $key => $value)
                {
                    $cat_id = $value['cat_id'];
                    if ($level == 0 && $last_cat_id == 0)
                    {
                        if ($value['parent_id'] > 0)
                        {
                            break;
                        }

                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] == 0)
                        {
                            continue;
                        }
                        $last_cat_id  = $cat_id;
                        $cat_id_array = array($cat_id);
                        $level_array[$last_cat_id] = ++$level;
                        continue;
                    }

                    if ($value['parent_id'] == $last_cat_id)
                    {
                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] > 0)
                        {
                            if (end($cat_id_array) != $last_cat_id)
                            {
                                $cat_id_array[] = $last_cat_id;
                            }
                            $last_cat_id    = $cat_id;
                            $cat_id_array[] = $cat_id;
                            $level_array[$last_cat_id] = ++$level;
                        }
                    }
                    elseif ($value['parent_id'] > $last_cat_id)
                    {
                        break;
                    }
                }

                $count = count($cat_id_array);
                if ($count > 1)
                {
                    $last_cat_id = array_pop($cat_id_array);
                }
                elseif ($count == 1)
                {
                    if ($last_cat_id != end($cat_id_array))
                    {
                        $last_cat_id = end($cat_id_array);
                    }
                    else
                    {
                        $level = 0;
                        $last_cat_id = 0;
                        $cat_id_array = array();
                        continue;
                    }
                }

                if ($last_cat_id && isset($level_array[$last_cat_id]))
                {
                    $level = $level_array[$last_cat_id];
                }
                else
                {
                    $level = 0;
                }
            }
        // }
        // else
        // {
        //     $options = $data;
        // }
        $cat_options[0] = $options;
    // }
    // else
    // {
    //     $options = $cat_options[0];
    // }

    if (!$spec_cat_id)
    {
        return $options;
    }
    else
    {    
      // var_dump($options);exit;
        if (empty($options[$spec_cat_id]))
        {
            return array();
        }

        $spec_cat_id_level = $options[$spec_cat_id]['level'];
        foreach ($options AS $key => $value)
        {
            if ($key != $spec_cat_id)
            {
                unset($options[$key]);
            }
            else
            {
                break;
            }
        }
        $spec_cat_id_array = array();
        foreach ($options AS $key => $value)
        {
            if (($spec_cat_id_level == $value['level'] && $value['cat_id'] != $spec_cat_id) || ($spec_cat_id_level > $value['level']))
            {
                break;
            }
            else
            {
                $spec_cat_id_array[$key] = $value;
            }
        }
        $cat_options[$spec_cat_id] = $spec_cat_id_array;
        // var_dump($spec_cat_id_array);exit;
        return $spec_cat_id_array;
    }
}


function ArrToStrIn($item_list){

    // var_dump($item_list);exit;
          // 重组为sql字符串
          $item_list_tmp = '';
          foreach ($item_list AS $item)
          {
              if ($item !== '')
              {
                  $item_list_tmp .= $item_list_tmp ? ",'$item'" : "'$item'";
              }
          }
          if (empty($item_list_tmp))
          {
              return " IN ('') ";
          }
          else
          {
              return ' IN (' . $item_list_tmp . ') ';
          }
}

/**
 * 根据属性数组创建属性的表单
 *
 * @access  public
 * @param   int     $cat_id     分类编号
 * @param   int     $goods_id   商品编号
 * @return  string
 */
function build_attr_html($cat_id, $goods_id = 0)
{
    $attr = get_attr_list($cat_id, $goods_id);
    $html = '<table width="100%" id="attrTable">';
    $spec = 0;

    foreach ($attr AS $key => $val)
    {
        $html .= "<tr><td class='label'>";
        if ($val['attr_type'] == 1 || $val['attr_type'] == 2)
        {
            $html .= ($spec != $val['attr_id']) ?
                "<a href='javascript:;' onclick='addSpec(this)'>[+]</a>" :
                "<a href='javascript:;' onclick='removeSpec(this)'>[-]</a>";
            $spec = $val['attr_id'];
        }

        $html .= "$val[attr_name]</td><td><input type='hidden' name='attr_id_list[]' value='$val[attr_id]' />";

        if ($val['attr_input_type'] == 0)
        {
            $html .= '<input name="attr_value_list[]" type="text" value="' .htmlspecialchars($val['attr_value']). '" size="40" /> ';
        }
        elseif ($val['attr_input_type'] == 2)
        {
            $html .= '<textarea name="attr_value_list[]" rows="3" cols="40">' .htmlspecialchars($val['attr_value']). '</textarea>';
        }
        else
        {
            $html .= '<select name="attr_value_list[]">';
            $html .= '<option value="">' .$GLOBALS['_LANG']['select_please']. '</option>';

            $attr_values = explode("\n", $val['attr_values']);

            foreach ($attr_values AS $opt)
            {
                $opt    = trim(htmlspecialchars($opt));

                $html   .= ($val['attr_value'] != $opt) ?
                    '<option value="' . $opt . '">' . $opt . '</option>' :
                    '<option value="' . $opt . '" selected="selected">' . $opt . '</option>';
            }
            $html .= '</select> ';
        }

        $html .= ($val['attr_type'] == 1 || $val['attr_type'] == 2) ?
            $GLOBALS['_LANG']['spec_price'].' <input type="text" name="attr_price_list[]" value="' . $val['attr_price'] . '" size="5" maxlength="10" />' :
            ' <input type="hidden" name="attr_price_list[]" value="0" />';

        $html .= '</td></tr>';
    }

    $html .= '</table>';

    return $html;
}

/**
 * 取得通用属性和某分类的属性，以及某商品的属性值
 * @param   int     $cat_id     分类编号
 * @param   int     $goods_id   商品编号
 * @return  array   规格与属性列表
 */
function get_attr_list($cat_id, $goods_id = 0)
{
    if (empty($cat_id))
    {
        return array();
    }

    // 查询属性值及商品的属性值
    $sql = "SELECT a.attr_id, a.attr_name, a.attr_input_type, a.attr_type, a.attr_values, v.attr_value, v.attr_price ".
            "FROM " .table('attribute'). " AS a ".
            "LEFT JOIN " .table('goods_attr'). " AS v ".
            "ON v.attr_id = a.attr_id AND v.goods_id = '$goods_id' ".
            "WHERE a.cat_id = " . intval($cat_id) ." OR a.cat_id = 0 ".
            "ORDER BY a.sort_order, a.attr_type, a.attr_id, v.attr_price, v.goods_attr_id";

    $row = M()->query($sql);

    return $row;
}
/**
 * 供货商列表信息
 * @param       string      $conditions
 * @return      array
 */
function suppliers_list_info($conditions = '')
{
    $where = '';
    if (!empty($conditions))
    {
        $where .= 'WHERE ';
        $where .= $conditions;
    }

    /* 查询 */
    $sql = "SELECT suppliers_id, suppliers_name, suppliers_desc
            FROM " . table("suppliers") . "
            $where";

    return M()->query($sql);
}
/**
 * 获得商品类型的列表
 *
 * @access  public
 * @param   integer     $selected   选定的类型编号
 * @return  string
 */
function goods_type_list($selected)
{
    $sql = 'SELECT cat_id, cat_name FROM ' . table('goods_type') . ' WHERE enabled = 1';
    // die($sql);
    $row = M()->query($sql);
    // dump($row);exit;
    $lst = '';
    foreach ($row as $value)
    {
        $lst .= "<option value='$value[cat_id]'";
        $lst .= ($selected == $value['cat_id']) ? ' selected="true"' : '';
        $lst .= '>' . htmlspecialchars($value['cat_name']). '</option>';
    }

    return $lst;
}
/**
 * 供货商名
 * @return  array
 */
function suppliers_list_name()
{
    /* 查询 */
    $suppliers_list = suppliers_list_info(' is_check = 1 ');

    /* 供货商名字 */
    $suppliers_name = array();
    if (count($suppliers_list) > 0)
    {
        foreach ($suppliers_list as $suppliers)
        {
            $suppliers_name[$suppliers['suppliers_id']] = $suppliers['suppliers_name'];
        }
    }
    return $suppliers_name;
}
function table($table){
  return C('DB_NAME').'.'.C('DB_PREFIX').$table;
}

function gmtime(){
  return time() - date('Z');
}
function time_to_date($time, $format='Y-m-d H:i:s'){
  return is_int($time) ? date($format, $time+date('Z')) : date($format, time());
}
/**
 *  将一个用户自定义时区的日期转为GMT时间戳
 *
 * @access  public
 * @param   string      $str
 * @return  integer
 */
function local_strtotime($str)
{
    return strtotime($str) - date('Z');
}

/**
 * 获得指定分类下的子分类的数组
 *
 * @access  public
 * @param   int     $cat_id     分类的ID
 * @param   int     $selected   当前选中分类的ID
 * @param   boolean $re_type    返回的类型: 值为真时返回下拉列表,否则返回数组
 * @param   int     $level      限定返回的级数。为0时返回所有级数
 * @param   int     $is_show_all 如果为true显示所有分类，如果为false隐藏不可见分类。
 * @return  mix
 */
function cat_list($cat_id = 0, $selected = 0, $re_type = true, $level = 0, $is_show_all = true)
{
    static $res = NULL;

    if ($res === NULL)
    {
        $data = false;//read_static_cache('cat_pid_releate');
        if ($data === false)
        {
            $sql = "SELECT c.cat_id, c.cat_name, c.measure_unit, c.parent_id, c.is_show, c.show_in_nav, c.grade, c.sort_order, COUNT(s.cat_id) AS has_children ".
                'FROM ' . table('category') . " AS c ".
                "LEFT JOIN " . table('category') . " AS s ON s.parent_id=c.cat_id ".
                "GROUP BY c.cat_id ".
                'ORDER BY c.parent_id, c.sort_order ASC';
            $res = M()->query($sql);
//             die($sql);
//          var_dump($res);exit;
            $sql = "SELECT cat_id, COUNT(*) AS goods_num " .
                    " FROM " . table('goods') .
                    " WHERE is_delete = 0 AND is_on_sale = 1 " .
                    " GROUP BY cat_id";
            $res2 = M()->query($sql);

            $sql = "SELECT gc.cat_id, COUNT(*) AS goods_num " .
                    " FROM " . table('goods_cat') . " AS gc , " . table('goods') . " AS g " .
                    " WHERE g.goods_id = gc.goods_id AND g.is_delete = 0 AND g.is_on_sale = 1 " .
                    " GROUP BY gc.cat_id";
            $res3 = M()->query($sql);

            $newres = array();
            foreach($res2 as $k=>$v)
            {
                $newres[$v['cat_id']] = $v['goods_num'];
                foreach($res3 as $ks=>$vs)
                {
                    if($v['cat_id'] == $vs['cat_id'])
                    {
                    $newres[$v['cat_id']] = $v['goods_num'] + $vs['goods_num'];
                    }
                }
            }

            foreach($res as $k=>$v)
            {
                $res[$k]['goods_num'] = !empty($newres[$v['cat_id']]) ? $newres[$v['cat_id']] : 0;
            }
            // //如果数组过大，不采用静态缓存方式
            // if (count($res) <= 1000)
            // {
            //     write_static_cache('cat_pid_releate', $res);
            // }
        }
        else
        {
            $res = $data;
        }
    }

    if (empty($res) == true)
    {
        return $re_type ? '' : array();
    }

    $options = cat_options($cat_id, $res); // 获得指定分类下的子分类的数组

    $children_level = 99999; //大于这个分类的将被删除
    if ($is_show_all == false)
    {
        foreach ($options as $key => $val)
        {
            if ($val['level'] > $children_level)
            {
                unset($options[$key]);
            }
            else
            {
                if ($val['is_show'] == 0)
                {
                    unset($options[$key]);
                    if ($children_level > $val['level'])
                    {
                        $children_level = $val['level']; //标记一下，这样子分类也能删除
                    }
                }
                else
                {
                    $children_level = 99999; //恢复初始值
                }
            }
        }
    }

    /* 截取到指定的缩减级别 */
    if ($level > 0)
    {
        if ($cat_id == 0)
        {
            $end_level = $level;
        }
        else
        {
            $first_item = reset($options); // 获取第一个元素
            $end_level  = $first_item['level'] + $level;
        }

        /* 保留level小于end_level的部分 */
        foreach ($options AS $key => $val)
        {
            if ($val['level'] >= $end_level)
            {
                unset($options[$key]);
            }
        }
    }

    if ($re_type == true)
    {
        $select = '';
        foreach ($options AS $var)
        {
            $select .= '<option value="' . $var['cat_id'] . '" ';
            $select .= ($selected == $var['cat_id']) ? "selected='ture'" : '';
            $select .= '>';
            if ($var['level'] > 0)
            {
                $select .= str_repeat('&nbsp;', $var['level'] * 4);
            }
            $select .= htmlspecialchars(addslashes($var['cat_name']), ENT_QUOTES) . '</option>';
        }

        return $select;
    }
    else
    {
        foreach ($options AS $key => $value)
        {
            // $options[$key]['url'] = build_uri('category', array('cid' => $value['cat_id']), $value['cat_name']);
        }

        return $options;
    }
}

/**
 * 过滤和排序所有分类，返回一个带有缩进级别的数组
 *
 * @access  private
 * @param   int     $cat_id     上级分类ID
 * @param   array   $arr        含有所有分类的数组
 * @param   int     $level      级别
 * @return  void
 */
function cat_options($spec_cat_id, $arr) 
{
    static $cat_options = array();

    if (isset($cat_options[$spec_cat_id]))
    {
        return $cat_options[$spec_cat_id];
    }

    if (!isset($cat_options[0]))
    {
        $level = $last_cat_id = 0;
        $options = $cat_id_array = $level_array = array();
        // $data = read_static_cache('cat_option_static');
        // if ($data === false)
        // {
            while (!empty($arr))
            {
                foreach ($arr AS $key => $value)
                {
                    $cat_id = $value['cat_id'];
                    if ($level == 0 && $last_cat_id == 0)
                    {
                        if ($value['parent_id'] > 0)
                        {
                            break;
                        }

                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] == 0)
                        {
                            continue;
                        }
                        $last_cat_id  = $cat_id;
                        $cat_id_array = array($cat_id);
                        $level_array[$last_cat_id] = ++$level;
                        continue;
                    }

                    if ($value['parent_id'] == $last_cat_id)
                    {
                        $options[$cat_id]          = $value;
                        $options[$cat_id]['level'] = $level;
                        $options[$cat_id]['id']    = $cat_id;
                        $options[$cat_id]['name']  = $value['cat_name'];
                        unset($arr[$key]);

                        if ($value['has_children'] > 0)
                        {
                            if (end($cat_id_array) != $last_cat_id)
                            {
                                $cat_id_array[] = $last_cat_id;
                            }
                            $last_cat_id    = $cat_id;
                            $cat_id_array[] = $cat_id;
                            $level_array[$last_cat_id] = ++$level;
                        }
                    }
                    elseif ($value['parent_id'] > $last_cat_id)
                    {
                        break;
                    }
                }

                $count = count($cat_id_array);
                if ($count > 1)
                {
                    $last_cat_id = array_pop($cat_id_array);
                }
                elseif ($count == 1)
                {
                    if ($last_cat_id != end($cat_id_array))
                    {
                        $last_cat_id = end($cat_id_array);
                    }
                    else
                    {
                        $level = 0;
                        $last_cat_id = 0;
                        $cat_id_array = array();
                        continue;
                    }
                }

                if ($last_cat_id && isset($level_array[$last_cat_id]))
                {
                    $level = $level_array[$last_cat_id];
                }
                else
                {
                    $level = 0;
                }
            }
            // //如果数组过大，不采用静态缓存方式
            // if (count($options) <= 2000)
            // {
            //     write_static_cache('cat_option_static', $options);
            // }
        // }
        // else
        // {
        //     $options = $data;
        // }
        $cat_options[0] = $options;
    }
    else
    {
        $options = $cat_options[0];
    }

    if (!$spec_cat_id)
    {
        return $options;
    }
    else
    {
        if (empty($options[$spec_cat_id]))
        {
            return array();
        }

        $spec_cat_id_level = $options[$spec_cat_id]['level'];
        foreach ($options AS $key => $value)
        {
            if ($key != $spec_cat_id)
            {
                unset($options[$key]);
            }
            else
            {
                break;
            }
        }
        $spec_cat_id_array = array();
        foreach ($options AS $key => $value)
        {
            if (($spec_cat_id_level == $value['level'] && $value['cat_id'] != $spec_cat_id) || ($spec_cat_id_level > $value['level']))
            { 
                break;
            }
            else
            { 
                $spec_cat_id_array[$key] = $value;
            }
        }
        $cat_options[$spec_cat_id] = $spec_cat_id_array;
        return $spec_cat_id_array;
    }
}


/**
 * 取得品牌列表
 * @return array 品牌列表 id => name
 */
function get_brand_list()
{
    $sql = 'SELECT brand_id, brand_name FROM ' . table('brand') . ' ORDER BY sort_order';
    $res = M()->query($sql);

    $brand_list = array();
    foreach ($res AS $row)
    {
        $brand_list[$row['brand_id']] = addslashes($row['brand_name']);
    }

    return $brand_list;
}