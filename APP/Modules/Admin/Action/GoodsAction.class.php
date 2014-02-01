<?php

	Class GoodsAction extends Action{

		// private $cache;													// 自定义cache对象
		private $upload;

		function __construct(){
			parent::__construct();
			$this->waitSecond = 1;
			$this->upload = reset(explode('index', __APP__)).'Upload/';
		}

			// VIEW.1.  商品列表
		/**
		 * 商品列表 页面
		 * [goods_list_view description]
		 * @return [type]
		 */
		public function goods_list_view(){
			$table = 'goods';
			$page_size = 15;													// 页长
			$field = 'goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, is_promote, sort_order, goods_number, integral';
			$where = 'is_delete=0 AND is_real=1';
			$order = 'goods_id ASC';
			// $limit = '0,'.$page_size;
			$goods_list = M($table)->field($field)->where($where)->order($order)->limit()->select();
			// 普通方式获取数据
			// var_dump($goods_list);exit;
			$this->assign('PAGESIZE', $page_size);
			$this->assign('COUNT', count($goods_list));
			$this->assign('PAGECOUNT', ceil(count($goods_list)/$page_size));
			$this->assign('goods_list', array_slice($goods_list, 0, $page_size));

			$this->assign('page_name', '商品列表');
			$this->assign('button_name', '添加商品');
			$this->assign('button_url', 'goods_operation_view');
			$this->display();
		}
		/**
		 * 商品分页 ajax
		 * [goods_list_json description] 
		 * @return [type]
		 */
		public function goods_list_json(){
			if(IS_POST){
				// 显示列表, 排序操作, 分页操作, 页面跳转, 搜索操作
				if (I('post.act')=='query') {
					// dump(I('post.is_delete'));exit;
					$sortname = I('post.sortname');
					$sortorder = I('post.sortorder');
					$page = I('post.page');
					$page_size = I('post.page_size');
					$is_delete = I('post.is_delete') ? 1 : 0;
     		// 		$cat_id = I('post.cat_id');
			  		// $brand_id = I('post.brand_id');
			  		// $intro_type = I('post.intro_type');
			  		// $suppliers_id = I('post.suppliers_id');
			  		// $is_on_sale = I('post.is_on_sale');
			  		// $keyword = I('post.keyword');
			        $goods_model = D('Goods');
					// $goods_list = $goods_model->goods_list($sortname, $sortorder, $page, $page_size, $cat_id, $brand_id, $intro_type, $suppliers_id, $is_on_sale, $keyword);
					$goods_list = $goods_model->goods_list($_POST);
					// $date['error'] = 0;
					// $date['message'] = "";
					$date['content'] = empty($_POST['is_delete']) ? goods_list($goods_list) : goods_recycle($goods_list);
					$date['filter']	= array('sortname'=>$sortname, 'sortorder'=>$sortorder, 'page'=>$page, 'page_size'=>$page_size, 'is_delete'=>$is_delete);
					$date['page_count'] = $goods_list['PAGECOUNT'];
					$date['sortname'] = $sortname;
					$date['sortorder'] = $sortorder;
					die(json_encode($date));
				}
			}else{
				// 非ajax操作,页面跳转
			}
		}
		/**
		 * 商品 ajax更新操作
		 * [goods_curd_json description]
		 * @return [type]
		 */
		public function goods_curd_json(){
			if(IS_POST )
			{
				// 修改操作
				if (substr(I('post.act'), 0, 5)=='edit_' || substr(I('post.act'), 0, 7)=='toggle_' || I('get.act')=='remove') 
				{	
					$table = 'goods';
					$goods_id = 'goods_id='.I('post.id');
					$value = I('post.val');
					switch (I('post.act')) {
						case 'edit_goods_name':
							$data['goods_name'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'edit_goods_sn':
							$data['goods_sn'] = $value;
							$boolean = M($table)->where($goods_id)->save($data);
							break;
						case 'edit_goods_price':
							$data['shop_price'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'toggle_on_sale':
							$data['is_on_sale'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'toggle_best':
							$data['is_best'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'toggle_new':
							$data['is_new'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'toggle_hot':
							$data['is_hot'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'edit_sort_order':
							$data['sort_order'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						case 'edit_goods_number':
							$data['goods_number'] = $value;
							$boolean = M($table)->where($goods_id)->save($data); 
							break;
						default:
							$boolean = FALSE;
							break;
					}
					$boolean !== FALSE ? die(json_encode(array('error'=>0, 'content'=>$value))) : die(json_encode(array('message'=>'修改数据失败'))); 
				}
			}
			else
			{
				// 非ajax操作,页面跳转
			}
		}
		/**
		 * 商品批量 更新操作{部分简单操作, 如删除}
		 * [goods_curd_bath description]p
		 * @return [type]
		 */
		public function goods_curd_bath(){
			/* 取得要操作的商品编号 */
			$goods_id = !empty($_POST['checkboxes']) ? implode(',', $_POST['checkboxes']) : $_GET['goods_id'];
			$type = isset($_POST['type']) ? $_POST['type'] : I('get.act');
			$table = 'goods';
			$date['last_update'] = time() - date('Z');
			$title = '';
			if (!empty($type))
			{
			    switch($type){
/* 放入回收站 */	case 'trash':
			            //admin_priv('remove_back');
			            $date['is_delete'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = isset($_GET['goods_id']) ? '删除' :  '批量删除';
			            // update_goods($goods_id, 'is_delete', '1');
			 			/* 记录日志 */
			            // admin_log('', 'batch_trash', 'goods');
			            break;
/* 上架 */	        case 'on_sale':
			            //admin_priv('goods_manage');
			       		$date['is_on_sale'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量上架';
			            // update_goods($goods_id, 'is_on_sale', '1');
			            break;
/* 下架 */	        case 'not_on_sale':
			            //admin_priv('goods_manage');
			       		$date['is_on_sale'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量下架';
			            // update_goods($goods_id, 'is_on_sale', '0');
			            break;
/* 设为精品 */      case 'best':
			            //admin_priv('goods_manage');
			       		$date['is_best'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量设为精品';
			            // update_goods($goods_id, 'is_best', '1');
			            break;
/* 取消精品 */      case 'not_best':
			            //admin_priv('goods_manage');
			       		$date['is_best'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量取消精品';
			            // update_goods($goods_id, 'is_best', '0');
			            break;
/* 设为新品 */      case 'new':
			            //admin_priv('goods_manage');
			       		$date['is_new'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量设为新品';
			            // update_goods($goods_id, 'is_new', '1');
			            break;
/* 取消新品 */      case 'not_new':
			            //admin_priv('goods_manage');
			       		$date['is_new'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量取消新品';
			            // update_goods($goods_id, 'is_new', '0');
			            break;
/* 设为热销 */       case 'hot':
			            //admin_priv('goods_manage');
			       		$date['is_hot'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量设为热销';
			            // update_goods($goods_id, 'is_hot', '1');
			            break;
/* 取消热销 */       case 'not_hot':
			            //admin_priv('goods_manage');
			       		$date['is_hot'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量取消热销';
			            // update_goods($goods_id, 'is_hot', '0');
			            break;
/* 转移到分类 */     case 'move_to':
			            //admin_priv('goods_manage');
			       		$date['suppliers_id'] = $_POST['target_cat'];
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '批量转移到分类';
			            // update_goods($goods_id, 'cat_id', $_POST['target_cat']);
			            break;
/* 转移到供货商 */   case 'suppliers_move_to':
			            //admin_priv('goods_manage');
			       		$date['suppliers_id'] = $_POST['suppliers_id'];
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = '转移到供货商';
			            // update_goods($goods_id, 'suppliers_id', $_POST['suppliers_id']);
			            break;
/* 还原 */	        case 'restore':
			            //admin_priv('remove_back');
			       		$date['is_delete'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            $title = isset($_GET['goods_id']) ? '还原' : '批量还原';
			            // update_goods($goods_id, 'is_delete', '0');
			 /* 记录日志 */
			            // admin_log('', 'batch_restore', 'goods');
			            break;
/* 删除 */	        case 'drop':
			            // admin_priv('remove_back');
			            // delete_goods($goods_id);
						$boolean = M($table)->where('goods_id in ('.$goods_id.')')->delete();
						$title = isset($_GET['goods_id']) ? '删除' : '批量删除';
			            /* 记录日志 */
			            // admin_log('', 'batch_remove', 'goods');
			            break;
			        default:
			        	$boolean = FALSE;
			    }
			}
			    $boolean ? $this->success($title.'成功') : $this->error($title.'失败');
			    /* 清除缓存 */
			    // clear_cache_files();

			    // if ($_POST['type'] == 'drop' || $_POST['type'] == 'restore')
			    // {
			    //     $link[] = array('href' => 'goods.php?act=trash', 'text' => $_LANG['11_goods_trash']);
			    // }
			    // else
			    // {
			    //     $link[] = list_link(true, $code);
			    // }
			    // // 页面跳转
			    // sys_msg($_LANG['batch_handle_ok'], 0, $link);
		}

			// VIEW.2.  商品添加
		/**
		 * 商品添加 页面
		 * [goods_insert_view description] 显示添加, 修改页面
		 * @return [type] [description]
		 */
		public function goods_operation_view(){
			// $this->assign('PAGESIZE', $page_size);
			// IS_GET && intval($_GET['goods_id']) > 0 ? '' : $this->error('非法操作');
			$goods_id = empty($_GET['goods_id']) ? 0 : intval($_GET['goods_id']);
			       /* 商品信息 */
	        $goods = M('goods')->where("goods_id = '$goods_id'")->find();
	        $goods['promote_start_date'] = date('Y-m-d', $goods['promote_start_date']);
	        $goods['promote_end_date'] = date('Y-m-d', $goods['promote_end_date']);
	        // dump($goods);
	        $this->assign('goods', $goods);
	        // echo M()->getLastSql();
	        vendor("FCKeditor.fckeditor");
		    $editor = new FCKeditor('goods_desc');
		    $editor->BasePath   = reset(explode('index', __APP__)).'ThinkPHP/Extend/Vendor/fckeditor/';
		    $editor->ToolbarSet = 'Normal';
		    $editor->Width      = '100%';
		    $editor->Height     = '320';
		    $editor->Value      = $goods['goods_desc'];
		    $FCKeditor = $editor->CreateHtml();
		    $this->assign('FCKeditor', $FCKeditor);
	  //       /* 虚拟卡商品复制时, 将其库存置为0*/
	  //       if ($is_copy && $code != '')
	  //       {
	  //           $goods['goods_number'] = 0;
	  //       }

			// $goods = array(
			//                 'goods_id'      => 0,
			//                 'goods_desc'    => '',
			//                 'cat_id'        => 0,
			//                 'is_on_sale'    => '1',
			//                 'is_alone_sale' => '1',
			//                 'is_shipping' => '0',
			//                 'other_cat'     => array(), // 扩展分类
			//                 'goods_type'    => 0,       // 商品类型
			//                 'shop_price'    => 0,
			//                 'promote_price' => 0,
			//                 'market_price'  => 0,
			//                 'integral'      => 0,
			//                 'goods_number'  => 1,
			//                 'warn_number'   => 1,
			//                 'promote_start_date' => local_date('Y-m-d'),
			//                 'promote_end_date'   => local_date('Y-m-d', gmstr2tome('+1 month')),
			//                 'goods_weight'  => 0,
			//                 'give_integral' => -1,
			//                 'rank_integral' => -1
			//             );
			//         }

			        /* 获取商品类型存在规格的类型 */
			        // $specifications = get_goods_type_specifications();
			        // $goods['specifications_id'] = $specifications[$goods['goods_type']];
			        // $_attribute = get_goods_specifications_list($goods['goods_id']);
			        // $goods['_attribute'] = empty($_attribute) ? '' : 1;

			        /* 根据商品重量的单位重新计算 */
			    //     if ($goods['goods_weight'] > 0)
			    //     {
			    //         $goods['goods_weight_by_unit'] = ($goods['goods_weight'] >= 1) ? $goods['goods_weight'] : ($goods['goods_weight'] / 0.001);
			    //     }

			    //     if (!empty($goods['goods_brief']))
			    //     {
			    //         //$goods['goods_brief'] = trim_right($goods['goods_brief']);
			    //         $goods['goods_brief'] = $goods['goods_brief'];
			    //     }
			    //     if (!empty($goods['keywords']))
			    //     {
			    //         //$goods['keywords']    = trim_right($goods['keywords']);
			    //         $goods['keywords']    = $goods['keywords'];
			    //     }

			    //     /* 如果不是促销，处理促销日期 */
			    //     if (isset($goods['is_promote']) && $goods['is_promote'] == '0')
			    //     {
			    //         unset($goods['promote_start_date']);
			    //         unset($goods['promote_end_date']);
			    //     }
			    //     else
			    //     {
			    //         $goods['promote_start_date'] = local_date('Y-m-d', $goods['promote_start_date']);
			    //         $goods['promote_end_date'] = local_date('Y-m-d', $goods['promote_end_date']);
			    //     }

			    //     /* 如果是复制商品，处理 */
			    //     if ($_REQUEST['act'] == 'copy')
			    //     {
			    //         // 商品信息
			    //         $goods['goods_id'] = 0;
			    //         $goods['goods_sn'] = '';
			    //         $goods['goods_name'] = '';
			    //         $goods['goods_img'] = '';
			    //         $goods['goods_thumb'] = '';
			    //         $goods['original_img'] = '';

			    //         // 扩展分类不变

			    //         // 关联商品
			    //         $sql = "DELETE FROM " . $ecs->table('link_goods') .
			    //                 " WHERE (goods_id = 0 OR link_goods_id = 0)" .
			    //                 " AND admin_id = '$_SESSION[admin_id]'";
			    //         $db->query($sql);

			    //         $sql = "SELECT '0' AS goods_id, link_goods_id, is_double, '$_SESSION[admin_id]' AS admin_id" .
			    //                 " FROM " . $ecs->table('link_goods') .
			    //                 " WHERE goods_id = '$_REQUEST[goods_id]' ";
			    //         $res = $db->query($sql);
			    //         while ($row = $db->fetchRow($res))
			    //         {
			    //             $db->autoExecute($ecs->table('link_goods'), $row, 'INSERT');
			    //         }

			    //         $sql = "SELECT goods_id, '0' AS link_goods_id, is_double, '$_SESSION[admin_id]' AS admin_id" .
			    //                 " FROM " . $ecs->table('link_goods') .
			    //                 " WHERE link_goods_id = '$_REQUEST[goods_id]' ";
			    //         $res = $db->query($sql);
			    //         while ($row = $db->fetchRow($res))
			    //         {
			    //             $db->autoExecute($ecs->table('link_goods'), $row, 'INSERT');
			    //         }

			    //         // 配件
			    //         $sql = "DELETE FROM " . $ecs->table('group_goods') .
			    //                 " WHERE parent_id = 0 AND admin_id = '$_SESSION[admin_id]'";
			    //         $db->query($sql);

			    //         $sql = "SELECT 0 AS parent_id, goods_id, goods_price, '$_SESSION[admin_id]' AS admin_id " .
			    //                 "FROM " . $ecs->table('group_goods') .
			    //                 " WHERE parent_id = '$_REQUEST[goods_id]' ";
			    //         $res = $db->query($sql);
			    //         while ($row = $db->fetchRow($res))
			    //         {
			    //             $db->autoExecute($ecs->table('group_goods'), $row, 'INSERT');
			    //         }

			    //         // 关联文章
			    //         $sql = "DELETE FROM " . $ecs->table('goods_article') .
			    //                 " WHERE goods_id = 0 AND admin_id = '$_SESSION[admin_id]'";
			    //         $db->query($sql);

			    //         $sql = "SELECT 0 AS goods_id, article_id, '$_SESSION[admin_id]' AS admin_id " .
			    //                 "FROM " . $ecs->table('goods_article') .
			    //                 " WHERE goods_id = '$_REQUEST[goods_id]' ";
			    //         $res = $db->query($sql);
			    //         while ($row = $db->fetchRow($res))
			    //         {
			    //             $db->autoExecute($ecs->table('goods_article'), $row, 'INSERT');
			    //         }

			    //         // 图片不变

			    //         // 商品属性
			    //         $sql = "DELETE FROM " . $ecs->table('goods_attr') . " WHERE goods_id = 0";
			    //         $db->query($sql);

			    //         $sql = "SELECT 0 AS goods_id, attr_id, attr_value, attr_price " .
			    //                 "FROM " . $ecs->table('goods_attr') .
			    //                 " WHERE goods_id = '$_REQUEST[goods_id]' ";
			    //         $res = $db->query($sql);
			    //         while ($row = $db->fetchRow($res))
			    //         {
			    //             $db->autoExecute($ecs->table('goods_attr'), addslashes_deep($row), 'INSERT');
			    //         }
			    //     }

			    //     // 扩展分类
			    //     $other_cat_list = array();
			    //     $sql = "SELECT cat_id FROM " . $ecs->table('goods_cat') . " WHERE goods_id = '$_REQUEST[goods_id]'";
			    //     $goods['other_cat'] = $db->getCol($sql);
			    //     foreach ($goods['other_cat'] AS $cat_id)
			    //     {
			    //         $other_cat_list[$cat_id] = cat_list(0, $cat_id);
			    //     }
			    //     $this->assign('other_cat_list', $other_cat_list);

			    //     $link_goods_list    = get_linked_goods($goods['goods_id']); // 关联商品
			    //     $group_goods_list   = get_group_goods($goods['goods_id']); // 配件
			    //     $goods_article_list = get_goods_articles($goods['goods_id']);   // 关联文章

			    //     /* 商品图片路径 */
			    //     if (isset($GLOBALS['shop_id']) && ($GLOBALS['shop_id'] > 10) && !empty($goods['original_img']))
			    //     {
			    //         $goods['goods_img'] = get_image_path($_REQUEST['goods_id'], $goods['goods_img']);
			    //         $goods['goods_thumb'] = get_image_path($_REQUEST['goods_id'], $goods['goods_thumb'], true);
			    //     }
// 			    echo $this->upload;
// echo dump(explode('index', $this->upload)).'1111';exit;
			        /* 图片列表 */
			        $img_list = M('goods_gallery')->where("goods_id = '$goods_id'")->select();
			        // foreach ($img_list as $key => $value) {
			        // 	$img_list[$key]['img_url'] = $this->upload.$value['img_url'];
			        // 	$img_list[$key]['thumb_url'] = $this->upload.$value['thumb_url'];
			        // 	$img_list[$key]['img_original'] = $this->upload.$value['img_original'];
			        // }
			        // dump($img_list);
			    //     /* 格式化相册图片路径 */
			    //     if (isset($GLOBALS['shop_id']) && ($GLOBALS['shop_id'] > 0))
			    //     {
			    //         foreach ($img_list as $key => $gallery_img)
			    //         {
			    //             $gallery_img[$key]['img_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], false, 'gallery');
			    //             $gallery_img[$key]['thumb_url'] = get_image_path($gallery_img['goods_id'], $gallery_img['img_original'], true, 'gallery');
			    //         }
			    //     }
			    //     else
			    //     {
			    //         foreach ($img_list as $key => $gallery_img)
			    //         {
			    //             $gallery_img[$key]['thumb_url'] = '../' . (empty($gallery_img['thumb_url']) ? $gallery_img['img_url'] : $gallery_img['thumb_url']);
			    //         }
			    //     }
			    // }

			    // /* 拆分商品名称样式 */
			    // $goods_name_style = explode('+', empty($goods['goods_name_style']) ? '+' : $goods['goods_name_style']);

			    // /* 创建 html editor */
			    // create_html_editor('goods_desc', $goods['goods_desc']);

			    // /* 模板赋值 */
			    // $this->assign('code',    $code);
			    // $this->assign('ur_here', $is_add ? (empty($code) ? $_LANG['02_goods_add'] : $_LANG['51_virtual_card_add']) : ($_REQUEST['act'] == 'edit' ? $_LANG['edit_goods'] : $_LANG['copy_goods']));
			    // $this->assign('action_link', list_link($is_add, $code));
			    // $this->assign('goods', $goods);
			    // $this->assign('goods_name_color', $goods_name_style[0]);
			    // $this->assign('goods_name_style', $goods_name_style[1]);
			    // dump(get_brand_list());
			    $this->assign('cat_list', cat_list(0, $goods['cat_id']));
			    $this->assign('brand_list', get_brand_list());
			    // $this->assign('unit_list', get_unit_list());
			    // $this->assign('user_rank_list', get_user_rank_list());
			    // $this->assign('weight_unit', $is_add ? '1' : ($goods['goods_weight'] >= 1 ? '1' : '0.001'));
			    // $this->assign('cfg', $_CFG);
			    // $this->assign('form_act', $is_add ? 'insert' : ($_REQUEST['act'] == 'edit' ? 'update' : 'insert'));
			    // if ($_REQUEST['act'] == 'add' || $_REQUEST['act'] == 'edit')
			    // {
			    //     $this->assign('is_add', true);
			    // }
			    // if(!$is_add)
			    // {
			    //     $this->assign('member_price_list', get_member_price_list($_REQUEST['goods_id']));
			    // }
			    // $this->assign('link_goods_list', $link_goods_list);
			    // $this->assign('group_goods_list', $group_goods_list);
			    // $this->assign('goods_article_list', $goods_article_list);
			    $this->assign('img_list', $img_list);
			    $this->assign('goods_type_list', goods_type_list($goods['goods_type']));
			    // $this->assign('gd', gd_version());
			    // $this->assign('thumb_width', $_CFG['thumb_width']);
			    // $this->assign('thumb_height', $_CFG['thumb_height']);
			    $this->assign('goods_attr_html', build_attr_html($goods['goods_type'], $goods['goods_id']));
			    // $volume_price_list = '';
			    // if(isset($_REQUEST['goods_id']))
			    // {
			    // $volume_price_list = get_volume_price_list($_REQUEST['goods_id']);
			    // }
			    // if (empty($volume_price_list))
			    // {
			    //     $volume_price_list = array('0'=>array('number'=>'','price'=>''));
			    // }
			    // $this->assign('volume_price_list', $volume_price_list);
			$this->assign('page_name', '添加商品');
			$this->assign('button_name', '商品列表');
			$this->assign('button_url', 'goods_list_view');
			$this->display();
		}
		/**
		 * 商品添加 页面
		 * [goods_operation description]
		 * @return [type]
		 */
		public function goods_operation()
		{
			// dump($_POST);
			// dump($_FILES);exit;
			// die($this->upload);
			IS_POST ? '' : $this->error('非法操作');
			// die($_POST['goods_id']);
			$is_insert = $_POST['goods_id'] > 0 ? FALSE : TRUE;			// 插入true, 更新false
			// echo $is_insert.'123';
			// 判断商品货号是否重复
			$table = "goods_sn = $_POST[goods_sn] AND is_delete = 0 AND goods_id <> $_POST[goods_id]";
			M('goods')->where($table)->count() > 0 ? $this->error('商品货号重复') : '';
			// 图片上传检查
			if($_FILES['goods_img']['tmp_name'] != '' && $_FILES['goods_img']['tmp_name'] != 'none' or ($_POST['goods_img_url'] != 'http://' && $is_url_goods_img = 1))
			{
				foreach ($_FILES as $key => $value) 
				{
					switch ($key) 
					{
/* 商品图片 */			case 'goods_img':
							$value['error'] > 0 && $value['error'] != 4 ? $this->error('商品图片上传失败, 请检查图片是否符合要求') : '';
							break;
/* 商品缩略图 */		case 'goods_thumb':
							$value['error'] > 0 && $value['error'] != 4 ? $this->error('商品微缩图上传失败 请检查图片是否符合要求') : '';
							break;
/* 相册图片 */			case 'img_url':
							 foreach ($value['error'] AS $error)
							 {
										$error > 0 && $error != 4 ? $this->error('商品相册图片上传失败 请检查图片是否符合要求') : '';
							 }
							break;
						default:
							break;
					}
				}
				$upload_images = $this->upload.'/images/';
				if (!$is_insert)
        		{
		            /* 删除原来的图片文件 */
		            $sql = "SELECT goods_thumb, goods_img, original_img " .
		                    " FROM " . table('goods') .
		                    " WHERE goods_id = '$_POST[goods_id]'";
		            $row = M()->query($sql);
		            // die($this->upload. '/Upload/' . $row['goods_thumb']);
		            if ($row['goods_thumb'] != '' && is_file($this->upload . $row['goods_thumb']))
		            {
		                @unlink($this->upload. '/Upload/' . $row['goods_thumb']);
		            }
		            if ($row['goods_img'] != '' && is_file($this->upload . $row['goods_img']))
		            {
		                @unlink($this->upload. '/Upload/' . $row['goods_img']);
		            }
		            if ($row['original_img'] != '' && is_file($this->upload . $row['original_img']))
		            {
		                /* 先不处理，以防止程序中途出错停止 */
		                //$old_original_img = $row['original_img']; //记录旧图路径
		            }
		            /* 清除原来商品图片 */
		            if ($proc_thumb === false)
		            {
		                get_image_path($_POST[goods_id], $row['goods_img'], false, 'goods', true);
		                get_image_path($_POST[goods_id], $row['goods_thumb'], true, 'goods', true);
		            }
		        }
				if ($boolean) 
				{
					import('ORG.Net.UploadFile');
					$upload = new UploadFile();// 实例化上传类
					$upload->maxSize  = 3145728 ;// 设置附件上传大小
					$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
					if(file_exists($upload_images . date('Ym')) || make_dir($upload_images . date('Ym')))
					{
						$upload->savePath =  $upload_images . date('Ym');// 设置附件上传目录
					}
					if(!$upload->upload()) {// 上传错误提示错误信息
						$this->error($upload->getErrorMsg());
					}else{// 上传成功 获取上传文件信息
						$info =  $upload->getUploadFileInfo();
					}
				}
			}

			// var_dump($_POST);			
			// 插入/添加操作
			// die($is_insert);
			$goods_model = D('Goods');
			$ope_str = $is_insert ? '添加操作' : '更新操作';
			$goods_model->goods_operation($_POST, $is_insert) ? $this->success($ope_str.'成功') : $this->error($ope_str.'失败');
		}
		/**
		 * 商品属性 ajax
		 * [goods_attr_json description]	返回商品属性html
		 * @return [type] [description]
		 */
		public function goods_attr_json()
		{
		    $goods_id   = empty($_GET['goods_id']) ? 0 : intval($_GET['goods_id']);
		    $goods_type = empty($_GET['goods_type']) ? 0 : intval($_GET['goods_type']);

		    $content    = build_attr_html($goods_type, $goods_id);

		    $content ? die(json_encode(array('error'=>0, 'content'=>$content))) : die(json_encode(array('message'=>'修改数据失败'))); 
		}
			// VIEW.3.  商品分类
		/**
		 * 商品分类 页面
		 * [goods_category_view description]
		 * @return [type]
		 */
		public function goods_category_view(){
		  /* 获取分类列表 */
		    $cat_list = cat_list(0, 0, false);

		    /* 模板赋值 */
		    // $this->assign('ur_here',      $_LANG['03_category_list']);
		    $this->assign('action_link',  array('href' => 'category.php?act=add', 'text' => $_LANG['04_category_add']));
		    $this->assign('full_page',    1);

		    $this->assign('cat_info',     $cat_list);
		    // dump($cat_list);
		    /* 列表页面 */
		    // assign_query_info();
		    $this->assign('page_name', '商品分类');
			$this->assign('button_name', '添加分类');
			$this->assign('button_url', 'goods_category_edit_view');
			$this->display();
		}
		/**
		 * 商品分类 ajax更新操作
		 * [goods_category_json description]
		 * @return [type]
		 */
		public function goods_category_json()
		{
			if(IS_POST){
				$table = 'category';
				// 修改操作
				if (substr(I('post.act'), 0, 5)=='edit_' || substr(I('post.act'), 0, 7)=='toggle_') 
				{
					$cat_id = 'cat_id='.I('post.id');
					$value = I('post.val');
					switch (I('post.act')) {
						case 'edit_measure_unit':
							$data['measure_unit'] = $value;
							$boolean = M($table)->where($cat_id)->save($data); 
							break;
						case 'toggle_show_in_nav':
							$data['show_in_nav'] = $value;
							$boolean = M($table)->where($cat_id)->save($data);
							break;
						case 'toggle_is_show':
							$data['is_show'] = $value;
							$boolean = M($table)->where($cat_id)->save($data); 
							break;
						case 'edit_grade':
							$data['grade'] = $value;
							$boolean = M($table)->where($cat_id)->save($data); 
							break;
						case 'edit_sort_order':
							$data['sort_order'] = $value;
							$boolean = M($table)->where($cat_id)->save($data); 
							break;
						default:
							$boolean = FALSE;
							break;
					}
					$boolean !== FALSE ? die(json_encode(array('error'=>0, 'content'=>$value))) : die(json_encode(array('message'=>'修改数据失败'))); 
				}
			}else{
				// 非ajax操作,页面跳转
			}
		}
		/**
		 * 商品分类 添加/更新操作
		 * [goods_category_edit description]
		 * @return [type]
		 */
		public function goods_category_edit_view()
		{
			if (isset($_GET['cat_id'])) 
			{
				$category = M('category')->where('cat_id = '.$_GET['cat_id'])->find();
				// 分类列表
				$this->assign('category', $category);
				$this->assign('update', 1);
				// dump($category);
			}
			$this->assign('page_name', '添加分类');
			$this->assign('button_name', '商品分类');
			$this->assign('button_url', 'goods_category_view');
			$this->display();
		}
		/**
		 * 商品分类 修改
		 * [goods_category_edit description]
		 * @return [type] [description]
		 */
		public function goods_category_edit()
		{
			// dump($_POST);
			IS_POST || isset($_GET['act']) ? '' : $this->error('非法操作');
			$category = M('category');
			if (!empty($_POST['act']) && $_POST['act'] == 'insert') {
				$operation = '添加商品分类';
				$category->create();
				$boolean = $category->add();
			}
			elseif (!empty($_POST['act']) && $_POST['act'] == 'update') 
			{
				$operation = '更新商品分类';
				$category->create();
				$boolean = $category->save();
			}
			elseif (isset($_GET['act']) && $_GET['act'] == 'remove' && !empty($_GET['cat_id'])) 
			{
				// dump($_GET);
				$operation = '删除商品分类';
				// $data['cat_id'] = $_GET['cat_id'];
				// $data['is_show'] = 0;
				// $boolean = $category->where('cat_id='.intval($_GET['cat_id']))->save($data);
				$boolean = $category->where('cat_id='.intval($_GET['cat_id']))->delete();
			}
			else
			{
				$this->error('操作失败, 请重新操作');
			}
			$boolean ? $this->success($operation.'成功') : $this->error($operation.'失败');
		}
			// VIEW.4.  商品品牌
		/**
		 * 商品品牌 页面
		 * [goods_brand_view description]
		 * @return [type]
		 */
		public function goods_brand_view()
		{
			// dump($_POST);
			$where = !empty($_POST['search_brand_name']) ? "brand_name like '%".I('post.search_brand_name')."%'" : '';
			$Brand = M('Brand'); // 实例化Brand对象
			import('ORG.Util.Page');// 导入分页类
			$count      = $Brand->where($where)->count();// 查询满足要求的总记录数
			$Page       = new Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出
			// !empty($_POST['search_brand_name']) ? ($Page->parameter .= 'search_brand_name='.$_POST['search_brand_name']) : '';
			// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
			$brand_list = $Brand->where($where)->order('sort_order')->limit($Page->firstRow.','.$Page->listRows)->select();
			// dump($brand_list);
			$this->assign('brand_list',$brand_list);// 赋值数据集
			$this->assign('search_brand_name', $_POST['search_brand_name']);
			$this->assign('page',$show);// 赋值分页输出
			// dump($Page->show());

			$this->assign('page_name', '商品品牌');
			$this->assign('button_name', '添加品牌');
			$this->assign('button_url', 'goods_brand_edit_view');
			$this->display(); // 输出模板
		}
		/**
		 * 商品品牌 添加/更新操作
		 * [goods_brand_edit description]
		 * @return [type]
		 */
		public function goods_brand_edit()
		{
			// dump($_POST);
			IS_POST || isset($_GET['act']) ? '' : $this->error('非法操作');
			$Brand = M('brand');
			if (!empty($_POST['act']) && $_POST['act'] == 'insert') {
				$operation = '添加商品品牌';
				$Brand->create();
				$boolean = $Brand->add();
			}
			elseif (!empty($_POST['act']) && $_POST['act'] == 'update') 
			{
				$operation = '更新商品品牌';
				$Brand->create();
				$boolean = $Brand->save();
			}
			elseif (isset($_GET['act']) && $_GET['act'] == 'remove' && !empty($_GET['brand_id'])) 
			{
				// dump($_GET);
				$operation = '删除商品品牌';
				// $data['brand_id'] = $_GET['brand_id'];
				// $data['is_show'] = 0;
				// $boolean = $Brand->where('brand_id='.intval($_GET['brand_id']))->save($data);
				$boolean = $Brand->where('brand_id='.intval($_GET['brand_id']))->delete();
			}
			else
			{
				$this->error('操作失败, 请重新操作');
			}
			$boolean ? $this->success($operation.'成功') : $this->error($operation.'失败');
		}
		/**
		 * 商品品牌 编辑页面
		 * [goods_brand_edit_view description] 
		 * @return [type]
		 */
		public function goods_brand_edit_view()
		{
			if (isset($_GET['brand_id'])) 
			{
				$brand = M('brand')->where('brand_id = '.$_GET['brand_id'])->find();
				$this->assign('brand', $brand);
				$this->assign('update', 1);
			}
			$this->assign('page_name', '编辑品牌记录');
			$this->assign('button_name', '商品品牌');
			$this->assign('button_url', 'goods_brand_view');
			$this->display();
		}
		// public function goods_brand_update()
		// {
		// 	dump($_POST);exit;
		// }
				// 商品类型
		/**
		 * 品牌类型 页面
		 * [goods_type_view description]
		 * @return [type]
		 */
		public function goods_type_view()
		{
		    $goods_model = D('Goods');
		    $good_type_list = $goods_model->get_goodstype();
			import('ORG.Util.Page');// 导入分页类
			$Page       = new Page($good_type_list['record_count'], 15);// 实例化分页类 传入总记录数和每页显示的记录数
			$show       = $Page->show();// 分页显示输出

			$this->assign('page',$show);// 赋值分页输出
		    $this->assign('goods_type_arr',   $good_type_list['type']);
		    $this->assign('record_count', $good_type_list['record_count']);

		    $this->assign('page_name', '商品类型');
			$this->assign('button_name', '建立商品类型');
			$this->assign('button_url', 'goods_type_edit_view');
		    $this->display();
		}

		public function goods_type_edit_view()
		{
			if (isset($_GET['cat_id'])) 
			{
				$goods_type = M('goods_type')->where('cat_id = '.$_GET['cat_id'])->find();
				$this->assign('goods_type', $goods_type);
				$this->assign('update', 1);
			}
			$this->assign('page_name', '编辑商品类型');
			$this->assign('button_name', '商品类型列表');
			$this->assign('button_url', 'goods_type_view');
			$this->display();
		}

		public function goods_type_edit()
		{
			IS_POST || isset($_GET['act']) ? '' : $this->error('非法操作');
			$goods_type = M('goods_type');
			if (!empty($_POST['act']) && $_POST['act'] == 'insert') {
				$operation = '添加商品类型';
				$goods_type->create();
				$boolean = $goods_type->add();
			}
			elseif (!empty($_POST['act']) && $_POST['act'] == 'update') 
			{
				$operation = '更新商品类型';
				$goods_type->create();
				$boolean = $goods_type->save();
			}
			elseif (isset($_GET['act']) && $_GET['act'] == 'remove' && !empty($_GET['cat_id'])) 
			{
				// dump($_GET);
				$operation = '删除商品类型';
				// $data['cat_id'] = $_GET['cat_id'];
				// $data['is_show'] = 0;
				// $boolean = $goods_type->where('cat_id='.intval($_GET['cat_id']))->save($data);
				$boolean = $goods_type->where('cat_id='.intval($_GET['cat_id']))->delete();
			}
			else
			{
				$this->error('操作失败, 请重新操作');
			}
			$boolean ? $this->success($operation.'成功') : $this->error($operation.'失败');
		}


			// VIEW.5.  用户评论
		public function goods_comment_view(){

			$this->assign('page_name', '用户评论');
			$this->display();
		}
			// VIEW.6.  商品回收站
		public function goods_recycle_view(){
			$table = 'goods';
			$page_size = 15;													// 页长
			$field = 'goods_id, goods_name, goods_type, goods_sn, shop_price, sort_order, goods_number, integral';
			$where = 'is_delete=1 AND is_real=1';
			$order = 'goods_id DESC ';
			// $limit = '0,'.$page_size;
			$goods_list = M($table)->field($field)->where($where)->order($order)->limit()->select();
			// 普通方式获取数据
			// var_dump($goods_list);exit;
			$this->assign('PAGESIZE', $page_size);
			$this->assign('COUNT', count($goods_list));
			$this->assign('PAGECOUNT', ceil(count($goods_list)/$page_size));
			$this->assign('goods_list', array_slice($goods_list, 0, $page_size));

			$this->assign('page_name', '商品回收站');
			$this->assign('button_name', '商品列表');
			$this->assign('button_url', 'goods_list_view');
			$this->display();
		}
			// VIEW.7.  商品上下架
		// public function goods_sale_view(){
		// 	$this->display();
		// }
			// VIEW.8.  供应商管理???
		// public function goods_list_view(){
			// $this->display();
		// }
			// VIEW.9.  缺货商品 暂无
		// public function goods_booking_view(){
		// 	$this->display();
		// }
		// 	// VIEW.10. 优惠活动 暂无
		// public function goods_favourable_view(){
		// 	$this->display();
		// }
		
		
	}

