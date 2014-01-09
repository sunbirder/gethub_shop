<?php

	Class GoodsModel extends Model{

		private $model;

		function __construct(){
			// $this->prefix = C('DB_PREFIX');
			$this->model = M();
			define('_UPLOAD_', reset(explode('index', __APP__)).'/Upload/');
		}

		// public function goods_list($sortname, $sortorder, $page, $page_size, $cat_id, $brand_id, $intro_type, $suppliers_id, $is_on_sale, $keyword){
		public function goods_list($var_arr){
			// var_dump($var_arr);
			extract($var_arr);
			$sortname = empty($sortname) ? " goods_id" : trim($sortname);	// 排序字段
			$sortorder = empty($sortorder) ? " desc" : trim($sortorder);	// 排序方式
			$page = empty($page) ? 1 : intval($page);						// 当前页
			$page_size	  = empty($page_size) ? 15 : intval($page_size);    // 页长

			$cat_id    = empty($cat_id) ? 0 : intval($cat_id);				// 商品分类
        	$intro_type = empty($intro_type) ? '' : trim($intro_type);		// 特殊推荐, 精品, 热门, 最新, 特价等
        	// $is_promote = empty($is_promote) ? 0 : intval($is_promote);		// 促销
        	// $stock_warning = empty($stock_warning) ? 0 : intval($stock_warning);
        	$brand_id  = empty($brand_id) ? 0 : intval($brand_id);			// 品牌
        	$keyword   = empty($keyword) ? '' : trim($keyword);				// 关键字
        	$suppliers_id = empty($suppliers_id) ? 0 : intval($suppliers_id);	// 供应商号
        	// $is_on_sale = $is_on_sale === '' ? '' : intval($is_on_sale);
			$is_on_sale = $is_on_sale === 1 || $is_on_sale === 0 ? $is_on_sale : '';
			$day = getdate();
			$today = mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']) - date('Z'); // 当天凌晨时间戳 $timezone * 3600;
		// 条件语句
        	$where = '';
		/* 推荐类型 */
        switch ($intro_type)
        {
            case 'is_best':
                $where .= " AND is_best=1";
                break;
            case 'is_hot':
                $where .= ' AND is_hot=1';
                break;
            case 'is_new':
                $where .= ' AND is_new=1';
                break;
            case 'is_promote':
                $where .= " AND is_promote = 1 AND promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today'";
                break;
            case 'all_type';
                $where .= " AND (is_best=1 OR is_hot=1 OR is_new=1 OR (is_promote = 1 AND promote_price > 0 AND promote_start_date <= '" . $today . "' AND promote_end_date >= '" . $today . "'))";
        }
        	$where .= $cat_id > 0 ? " AND g.cat_id ".ArrToStrIn(array_keys(GetCategoryTreeChild($cat_id))) : '';
        /* 库存警告 */
            // $where .=  $stock_warning ? ' AND goods_number <= warn_number ' ? '';
        /* 品牌 */
            $where .= $brand_id ? " AND brand_id='$brand_id'" : '';
        /* 扩展 */
            // $where .= $extension_code ? " AND extension_code='$filter[extension_code]'" : '';
        /* 关键字 */
            $where .= $keyword ? " AND (goods_sn LIKE '%".$keyword."%' OR goods_name LIKE '%".$keyword."%')" : '';
		/* 实体商品 */
            $where .= $real_goods > -1 ? " AND is_real='$real_goods'" : '';
        /* 上架 */
            $where .= $is_on_sale !== '' ? " AND (is_on_sale = '".$is_on_sale."')" : '';
        /* 供货商 */
            $where .= $suppliers_id ? " AND (suppliers_id = '".$suppliers_id."')" : '';

            $where .= empty($is_delete) ? ' AND is_delete = 0' : ' AND is_delete = 1';
            // 查询总商品数量语句
			$sql_count = "SELECT COUNT(*) 
							FROM ".table('goods')." AS g 
							WHERE is_real=1";
			$sql_count .= $where;
			$count = $this->model->query($sql_count);
			// var_dump($count);exit;
			$date['COUNT'] = $count[0]['COUNT(*)'];
			// 查询分页商品总数
			$sql = "SELECT goods_id, goods_name, goods_type, goods_sn, shop_price,
						   is_on_sale, is_best, is_new, is_hot, is_promote, 
						   sort_order, goods_number, integral 
					FROM ".table('goods')." AS g 
					WHERE is_real=1";
			$sql .= $where;
			$start = ( $page - 1 ) * $page_size;                                     // 起始记录号
			$sort = " ORDER BY ".$sortname." {$sortorder}";
			$limit = " LIMIT ".$start.", {$page_size}";
			$sql .= $sort.$limit;

			$date['PAGESIZE'] = $page_size;
			$date['PAGE'] = $page;
			$date['PAGECOUNT'] = ceil($date['COUNT']/$page_size);
			$date['goods_list'] = $this->model->query($sql);
			// die($sql);
			return $date;
		}

		function goods_operation($var_arr, $is_insert = true){
			array_map(addslashes, $var_arr);
			// dump($var_arr);
			extract($var_arr);
			$code = empty($extension_code) ? '' : trim($extension_code);
			$shop_price = !empty($shop_price) ? $shop_price : 0;
		    $market_price = !empty($market_price) ? $market_price : 0;
		    $promote_price = !empty($promote_price) ? floatval($promote_price ) : 0;
		    $is_promote = empty($promote_price) ? 0 : 1;
		    $promote_start_date = ($is_promote && !empty($promote_start_date)) ? local_strtotime($promote_start_date) : 0;
		    $promote_end_date = ($is_promote && !empty($promote_end_date)) ? local_strtotime($promote_end_date) : 0;
		    $goods_weight = !empty($goods_weight) ? $goods_weight * $weight_unit : 0;
		    $is_best = isset($is_best) ? 1 : 0;
		    $is_new = isset($is_new) ? 1 : 0;
		    $is_hot = isset($is_hot) ? 1 : 0;
		    $is_on_sale = isset($is_on_sale) ? 1 : 0;
		    $is_alone_sale = isset($is_alone_sale) ? 1 : 0;
		    $is_shipping = isset($is_shipping) ? 1 : 0;
		    $goods_number = isset($goods_number) ? $goods_number : 0;
		    $warn_number = isset($warn_number) ? $warn_number : 0;
		    $goods_type = isset($goods_type) ? $goods_type : 0;
		    $give_integral = isset($give_integral) ? intval($give_integral) : '-1';
		    $rank_integral = isset($rank_integral) ? intval($rank_integral) : '-1';
		    $suppliers_id = isset($suppliers_id) ? intval($suppliers_id) : '0';

		    $goods_name_style = $goods_name_color . '+' . $goods_name_style;

		    $catgory_id = empty($cat_id) ? '' : intval($cat_id);
		    $brand_id = empty($brand_id) ? '' : intval($brand_id);

		    $goods_thumb = (empty($goods_thumb) && !empty($goods_thumb_url) && goods_parse_url($goods_thumb_url)) ? htmlspecialchars(trim($goods_thumb_url)) : $goods_thumb;
		    $goods_thumb = (empty($goods_thumb) && isset($auto_thumb))? $goods_img : $goods_thumb;
		    // 插入
		    if($is_insert){
			    if ($code == '') {
			    	$sql = "INSERT INTO " . table('goods') . " (goods_name, goods_name_style, goods_sn, " .
			                    "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
			                    "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
			                    "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, " .
			                    "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, rank_integral, suppliers_id)" .
		                	"VALUES ('$goods_name','$goods_name_style', '$goods_sn', '$catgory_id', " .
			                    "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
			                    "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
			                    "'$keywords','$goods_brief','$seller_note','$goods_weight', '$goods_number',".
			                    " '$warn_number', '$integral','$give_integral', '$is_best', '$is_new', '$is_hot', '$is_on_sale', '$is_alone_sale', $is_shipping, ".
			                    " '$goods_desc','" . gmtime() . "', '". gmtime() ."', '$goods_type', '$rank_integral', '$suppliers_id')";
			    }else{
			    	$sql = "INSERT INTO " . table('goods') . " (goods_name, goods_name_style, goods_sn, " .
			                    "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
			                    "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
			                    "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, is_real, " .
			                    "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, extension_code, rank_integral)" .
			                "VALUES ('$goods_name','$goods_name_style', '$goods_sn', '$catgory_id', " .
			                    "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
			                    "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
			                    "'$keywords','$goods_brief','$seller_note','$goods_weight', '$goods_number',".
			                    " '$warn_number', '$integral','$give_integral', '$is_best', '$is_new', '$is_hot', 0, '$is_on_sale', '$is_alone_sale', $is_shipping, ".
			                    " '$goods_desc','" . gmtime() . "', '". gmtime() ."', '$goods_type', '$code', '$rank_integral')";
				}
			// 更新
			}else{
				/* 如果有上传图片，删除原来的商品图 */
		        $sql = "SELECT goods_thumb, goods_img, original_img " .
		                    " FROM " . table('goods') .
		                    " WHERE goods_id = '$goods_id'";
		        $row = M()->query($sql);
		        if ($proc_thumb && $goods_img && $row['goods_img'] )
		        {
		            @unlink(_UPLOAD_ . $row['goods_img']);
		            @unlink(_UPLOAD_ . $row['original_img']);
		        }

		        if ($proc_thumb && $goods_thumb && $row['goods_thumb'] )
		        {
		            @unlink(_UPLOAD_ . $row['goods_thumb']);
		        }
				//  goods表更新操作 
		        $sql = "UPDATE " . table('goods') . " SET " .
		                "goods_name = '$_POST[goods_name]', " .
		                "goods_name_style = '$goods_name_style', " .
		                "goods_sn = '$goods_sn', " .
		                "cat_id = '$catgory_id', " .
		                "brand_id = '$brand_id', " .
		                "shop_price = '$shop_price', " .
		                "market_price = '$market_price', " .
		                "is_promote = '$is_promote', " .
		                "promote_price = '$promote_price', " .
		                "promote_start_date = '$promote_start_date', " .
		                "suppliers_id = '$suppliers_id', " .
		                "promote_end_date = '$promote_end_date', ";

		        /* 如果有上传图片，需要更新数据库 */
		        if ($goods_img)
		        {
		            $sql .= "goods_img = '$goods_img', original_img = '$original_img', ";
		        }
		        if ($goods_thumb)
		        {
		            $sql .= "goods_thumb = '$goods_thumb', ";
		        }
		        if ($code != '')
		        {
		            $sql .= "is_real=0, extension_code='$code', ";
		        }
		        $sql .= "keywords = '$_POST[keywords]', " .
		                "goods_brief = '$_POST[goods_brief]', " .
		                "seller_note = '$_POST[seller_note]', " .
		                "goods_weight = '$goods_weight'," .
		                "goods_number = '$goods_number', " .
		                "warn_number = '$warn_number', " .
		                "integral = '$_POST[integral]', " .
		                "give_integral = '$give_integral', " .
		                "rank_integral = '$rank_integral', " .
		                "is_best = '$is_best', " .
		                "is_new = '$is_new', " .
		                "is_hot = '$is_hot', " .
		                "is_on_sale = '$is_on_sale', " .
		                "is_alone_sale = '$is_alone_sale', " .
		                "is_shipping = '$is_shipping', " .
		                "goods_desc = '$_POST[goods_desc]', " .
		                "last_update = '". gmtime() ."', ".
		                "goods_type = '$goods_type' " .
		                "WHERE goods_id = '$goods_id' LIMIT 1";
			}
			// die($sql);
			return $this->model->execute($sql);

		/* 商品编号 */
		    $goods_id = $is_insert ? $this->model->getLastInsID() : $goods_id;

		    /* 记录日志 */
		    // if ($is_insert)
		    // {
		    //     admin_log($goods_name, 'add', 'goods');
		    // }
		    // else
		    // {
		    //     admin_log($goods_name, 'edit', 'goods');
		    // }

		    /* 处理属性 */
		    if ((isset($attr_id_list) && isset($attr_value_list)) || (empty($attr_id_list) && empty($attr_value_list)))
		    {
		        // 取得原有的属性值
		        $goods_attr_list = array();

		        $keywords_arr = explode(" ", $keywords);

		        $keywords_arr = array_flip($keywords_arr);
		        if (isset($keywords_arr['']))
		        {
		            unset($keywords_arr['']);
		        }

		        $sql = "SELECT attr_id, attr_index FROM " . table('attribute') . " WHERE cat_id = '$goods_type'";

		        $attr_res = $this->model->query($sql);

		        $attr_list = array();

		        while ($row = $this->model->fetchRow($attr_res))
		        {
		            $attr_list[$row['attr_id']] = $row['attr_index'];
		        }

		        $sql = "SELECT g.*, a.attr_type
		                FROM " . table('goods_attr') . " AS g
		                    LEFT JOIN " . table('attribute') . " AS a
		                        ON a.attr_id = g.attr_id
		                WHERE g.goods_id = '$goods_id'";

		        $res = $this->model->query($sql);

		        while ($row)
		        {
		            $goods_attr_list[$row['attr_id']][$row['attr_value']] = array('sign' => 'delete', 'goods_attr_id' => $row['goods_attr_id']);
		        }
		        // 循环现有的，根据原有的做相应处理
		        if(isset($attr_id_list))
		        {
		            foreach ($attr_id_list AS $key => $attr_id)
		            {
		                $attr_value = $attr_value_list[$key];
		                $attr_price = $attr_price_list[$key];
		                if (!empty($attr_value))
		                {
		                    if (isset($goods_attr_list[$attr_id][$attr_value]))
		                    {
		                        // 如果原来有，标记为更新
		                        $goods_attr_list[$attr_id][$attr_value]['sign'] = 'update';
		                        $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
		                    }
		                    else
		                    {
		                        // 如果原来没有，标记为新增
		                        $goods_attr_list[$attr_id][$attr_value]['sign'] = 'insert';
		                        $goods_attr_list[$attr_id][$attr_value]['attr_price'] = $attr_price;
		                    }
		                    $val_arr = explode(' ', $attr_value);
		                    foreach ($val_arr AS $k => $v)
		                    {
		                        if (!isset($keywords_arr[$v]) && $attr_list[$attr_id] == "1")
		                        {
		                            $keywords_arr[$v] = $v;
		                        }
		                    }
		                }
		            }
		        }
		        $keywords = join(' ', array_flip($keywords_arr));

		        $sql = "UPDATE " .table('goods'). " SET keywords = '$keywords' WHERE goods_id = '$goods_id' LIMIT 1";

		        $this->model->query($sql);

		        /* 插入、更新、删除数据 */
		        foreach ($goods_attr_list as $attr_id => $attr_value_list)
		        {
		            foreach ($attr_value_list as $attr_value => $info)
		            {
		                if ($info['sign'] == 'insert')
		                {
		                    $sql = "INSERT INTO " .table('goods_attr'). " (attr_id, goods_id, attr_value, attr_price)".
		                            "VALUES ('$attr_id', '$goods_id', '$attr_value', '$info[attr_price]')";
		                }
		                elseif ($info['sign'] == 'update')
		                {
		                    $sql = "UPDATE " .table('goods_attr'). " SET attr_price = '$info[attr_price]' WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
		                }
		                else
		                {
		                    $sql = "DELETE FROM " .table('goods_attr'). " WHERE goods_attr_id = '$info[goods_attr_id]' LIMIT 1";
		                }
		                $this->model->execute($sql);
		            }
		        }
		    }

		    // /* 处理会员价格 */
		    // if (isset($user_rank) && isset($user_price))
		    // {
		    //     handle_member_price($goods_id, $user_rank, $user_price);
		    // }

		    // /* 处理优惠价格 */
		    // if (isset($volume_number) && isset($volume_price))
		    // {
		    //     $temp_num = array_count_values($volume_number);
		    //     foreach($temp_num as $v)
		    //     {
		    //         if ($v > 1)
		    //         {
		    //             sys_msg($_LANG['volume_number_continuous'], 1, array(), false);
		    //             break;
		    //         }
		    //     }
		    //     handle_volume_price($goods_id, $volume_number, $volume_price);
		    // }

		    // /* 处理扩展分类 */
		    // if (isset($other_cat))
		    // {
		    //     handle_other_cat($goods_id, array_unique($other_cat));
		    // }

		    // if ($is_insert)
		    // {
		    //     /* 处理关联商品 */
		    //     handle_link_goods($goods_id);

		    //     /* 处理组合商品 */
		    //     handle_group_goods($goods_id);

		    //     /* 处理关联文章 */
		    //     handle_goods_article($goods_id);
		    // }

		    // /* 重新格式化图片名称 */
		    // $original_img = reformat_image_name('goods', $goods_id, $original_img, 'source');
		    // $goods_img = reformat_image_name('goods', $goods_id, $goods_img, 'goods');
		    // $goods_thumb = reformat_image_name('goods_thumb', $goods_id, $goods_thumb, 'thumb');
		    // if ($goods_img !== false)
		    // {
		    //     $this->model->query("UPDATE " . table('goods') . " SET goods_img = '$goods_img' WHERE goods_id='$goods_id'");
		    // }

		    // if ($original_img !== false)
		    // {
		    //     $this->model->query("UPDATE " . table('goods') . " SET original_img = '$original_img' WHERE goods_id='$goods_id'");
		    // }

		    // if ($goods_thumb !== false)
		    // {
		    //     $this->model->query("UPDATE " . table('goods') . " SET goods_thumb = '$goods_thumb' WHERE goods_id='$goods_id'");
		    // }

		    // /* 如果有图片，把商品图片加入图片相册 */
		    // if (isset($img))
		    // {
		    //     /* 重新格式化图片名称 */
		    //     if (empty($is_url_goods_img))
		    //     {
		    //         $img = reformat_image_name('gallery', $goods_id, $img, 'source');
		    //         $gallery_img = reformat_image_name('gallery', $goods_id, $gallery_img, 'goods');
		    //     }
		    //     else
		    //     {
		    //         $img = $url_goods_img;
		    //         $gallery_img = $url_goods_img;
		    //     }

		    //     $gallery_thumb = reformat_image_name('gallery_thumb', $goods_id, $gallery_thumb, 'thumb');
		    //     $sql = "INSERT INTO " . table('goods_gallery') . " (goods_id, img_url, img_desc, thumb_url, img_original) " .
		    //             "VALUES ('$goods_id', '$gallery_img', '', '$gallery_thumb', '$img')";
		    //     $this->model->query($sql);
		    // }

		    // /* 处理相册图片 */
		    // handle_gallery_image($goods_id, $_FILES['img_url'], $img_desc, $img_file);

		    // /* 编辑时处理相册图片描述 */
		    // if (!$is_insert && isset($old_img_desc))
		    // {
		    //     foreach ($old_img_desc AS $img_id => $img_desc)
		    //     {
		    //         $sql = "UPDATE " . table('goods_gallery') . " SET img_desc = '$img_desc' WHERE img_id = '$img_id' LIMIT 1";
		    //         $this->model->query($sql);
		    //     }
		    // }

		    // /* 不保留商品原图的时候删除原图 */
		    // if ($proc_thumb && !$_CFG['retain_original_img'] && !empty($original_img))
		    // {
		    //     $this->model->query("UPDATE " . table('goods') . " SET original_img='' WHERE `goods_id`='{$goods_id}'");
		    //     $this->model->query("UPDATE " . table('goods_gallery') . " SET img_original='' WHERE `goods_id`='{$goods_id}'");
		    //     @unlink('../' . $original_img);
		    //     @unlink('../' . $img);
		    // }

		    // /* 记录上一次选择的分类和品牌 */
		    // setcookie('ECSCP[last_choose]', $catgory_id . '|' . $brand_id, gmtime() + 86400);
		    // /* 清空缓存 */
		    // clear_cache_files();

		    // /* 提示页面 */
		    // $link = array();
		    // if (check_goods_specifications_exist($goods_id))
		    // {
		    //     $link[0] = array('href' => 'goods.php?act=product_list&goods_id=' . $goods_id, 'text' => $_LANG['product']);
		    // }
		    // if ($code == 'virtual_card')
		    // {
		    //     $link[1] = array('href' => 'virtual_card.php?act=replenish&goods_id=' . $goods_id, 'text' => $_LANG['add_replenish']);
		    // }
		    // if ($is_insert)
		    // {
		    //     $link[2] = add_link($code);
		    // }
		    // $link[3] = list_link($is_insert, $code);

		    // if (empty($is_insert))
		    // {
		    //     $key_array = array_keys($link);
		    //     krsort($link);
		    //     $link = array_combine($key_array, $link);
		    // }

		    // sys_msg($is_insert ? $_LANG['add_goods_ok'] : $_LANG['edit_goods_ok'], 0, $link);


		}



	/**
	 * 获得所有商品类型
	 *
	 * @access  public
	 * @return  array
	 */
	function get_goodstype()
	{
	    // $result = get_filter();
	    // if ($result === false)
	    // {
	        /* 分页大小 */
	        $filter = array();

	        /* 记录总数以及页数 */
	        $filter['record_count'] = M('goods_type')->Count();

	        // $filter = page_and_size($filter);

	        /* 查询记录 */
	        $sql = "SELECT t.*, COUNT(a.cat_id) AS attr_count ".
	               "FROM ". table('goods_type'). " AS t ".
	               "LEFT JOIN ". table('attribute'). " AS a ON a.cat_id=t.cat_id ".
	               "GROUP BY t.cat_id " ;
	        echo $sql;
	        // set_filter($filter, $sql);
	    // }
	    // else
	    // {
	    //     $sql    = $result['sql'];
	    //     $filter = $result['filter'];
	    // }

	    $all = $this->model->query($sql);

	    foreach ($all AS $key=>$val)
	    {
	        $all[$key]['attr_group'] = strtr($val['attr_group'], array("\r" => '', "\n" => ", "));
	    }

	    return array('type' => $all, 'record_count' => $filter['record_count']);
	}

}