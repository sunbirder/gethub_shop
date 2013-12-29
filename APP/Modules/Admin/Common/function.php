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


function p($value){
  echo "<pre>";
    print_r($value);
  echo "</pre>";
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

function table($table){
  return C('DB_NAME').'.'.C('DB_PREFIX').$table;
}
