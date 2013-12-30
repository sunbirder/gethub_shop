<?php

	Class GoodsModel extends Model{

		private $model;

		function __construct(){
			// $this->prefix = C('DB_PREFIX');
			$this->model = M();
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
			$today = mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']) - 8*3600; // 当天凌晨时间戳 $timezone * 3600;
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

		    if($is_insert){
			    if ($code == '') {
			    	$sql = "INSERT INTO " . table('goods') . " (goods_name, goods_name_style, goods_sn, " .
			                    "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
			                    "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
			                    "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, " .
			                    "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, rank_integral, suppliers_id)" .
		                	"VALUES ('$goods_name',' '$goods_name_style', '$goods_sn', '$catgory_id', " .
			                    "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
			                    "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
			                    "'$keywords',' '$goods_brief',' '$seller_note',' '$goods_weight', '$goods_number',".
			                    " '$warn_number', '$integral',' '$give_integral', '$is_best', '$is_new', '$is_hot', '$is_on_sale', '$is_alone_sale', $is_shipping, ".
			                    " '$goods_desc',' '" . gmtime() . "', '". gmtime() ."', '$goods_type', '$rank_integral', '$suppliers_id')";
			    }else{
			    	$sql = "INSERT INTO " . table('goods') . " (goods_name, goods_name_style, goods_sn, " .
			                    "cat_id, brand_id, shop_price, market_price, is_promote, promote_price, " .
			                    "promote_start_date, promote_end_date, goods_img, goods_thumb, original_img, keywords, goods_brief, " .
			                    "seller_note, goods_weight, goods_number, warn_number, integral, give_integral, is_best, is_new, is_hot, is_real, " .
			                    "is_on_sale, is_alone_sale, is_shipping, goods_desc, add_time, last_update, goods_type, extension_code, rank_integral)" .
			                "VALUES ('$goods_name',' '$goods_name_style', '$goods_sn', '$catgory_id', " .
			                    "'$brand_id', '$shop_price', '$market_price', '$is_promote','$promote_price', ".
			                    "'$promote_start_date', '$promote_end_date', '$goods_img', '$goods_thumb', '$original_img', ".
			                    "'$keywords',' '$goods_brief',' '$seller_note',' '$goods_weight', '$goods_number',".
			                    " '$warn_number', '$integral',' '$give_integral', '$is_best', '$is_new', '$is_hot', 0, '$is_on_sale', '$is_alone_sale', $is_shipping, ".
			                    " '$goods_desc',' '" . gmtime() . "', '". gmtime() ."', '$goods_type', '$code', '$rank_integral')";
				}
			}else{
				$sql = "UPDATE " . table('goods') . " SET " .
			                "goods_name = '$goods_name', " .
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
			}
		}












	}
