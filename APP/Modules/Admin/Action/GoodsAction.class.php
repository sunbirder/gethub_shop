<?php

	Class GoodsAction extends Action{

		private $cache;													// 自定义cache对象


		function __construct(){
			parent::__construct();
			$this->waitSecond = 9;
		}

			// VIEW.1.  商品列表
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
			$this->display('goods_list_view');
		}
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
		 * [goods_curd_json description]
		 * @return [type]
		 */
		public function goods_curd_json(){
			if(IS_POST){
				$table = 'goods';
				// 修改操作
				if (substr(I('post.act'), 0, 5)=='edit_' || substr(I('post.act'), 0, 7)=='toggle_') {
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
			}else{
				// 非ajax操作,页面跳转
			}
		}
		/**
		 * [goods_curd_bath description]p
		 * @return [type]
		 */
		public function goods_curd_bath(){
			/* 取得要操作的商品编号 */
			$goods_id = !empty($_POST['checkboxes']) ? implode(',', $_POST['checkboxes']) : 0;
			$table = 'goods';
			$date['last_update'] = time() - date('Z');
			if (isset($_POST['type'])){
			    switch($_POST['type']){
/* 放入回收站 */	case 'trash':
			            //admin_priv('remove_back');
			            $date['is_delete'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_delete', '1');
			 			/* 记录日志 */
			            // admin_log('', 'batch_trash', 'goods');
			            break;
/* 上架 */	        case 'on_sale':
			            //admin_priv('goods_manage');
			       		$date['is_on_sale'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_on_sale', '1');
			            break;
/* 下架 */	        case 'not_on_sale':
			            //admin_priv('goods_manage');
			       		$date['is_on_sale'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_on_sale', '0');
			            break;
/* 设为精品 */      case 'best':
			            //admin_priv('goods_manage');
			       		$date['is_best'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_best', '1');
			            break;
/* 取消精品 */      case 'not_best':
			            //admin_priv('goods_manage');
			       		$date['is_best'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_best', '0');
			            break;
/* 设为新品 */      case 'new':
			            //admin_priv('goods_manage');
			       		$date['is_new'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_new', '1');
			            break;
/* 取消新品 */      case 'not_new':
			            //admin_priv('goods_manage');
			       		$date['is_new'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_new', '0');
			            break;
/* 设为热销 */       case 'hot':
			            //admin_priv('goods_manage');
			       		$date['is_hot'] = 1;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_hot', '1');
			            break;
/* 取消热销 */       case 'not_hot':
			            //admin_priv('goods_manage');
			       		$date['is_hot'] = 0;
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_hot', '0');
			            break;
/* 转移到分类 */     case 'move_to':
			            //admin_priv('goods_manage');
			       		$date['suppliers_id'] = $_POST['target_cat'];
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'cat_id', $_POST['target_cat']);
			            break;
/* 转移到供货商 */   case 'suppliers_move_to':
			            //admin_priv('goods_manage');
			       		$date['suppliers_id'] = $_POST['suppliers_id'];
			            $date['goods_id'] = array('in', $goods_id);
			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'suppliers_id', $_POST['suppliers_id']);
			            break;
// /* 还原 */	        case 'restore':
// 			            //admin_priv('remove_back');
// 			       		$date['is_delete'] = 0;
// 			            $date['goods_id'] = array('in', $goods_id);
// 			            $boolean = M($table)->save($date);
			            // update_goods($goods_id, 'is_delete', '0');
			 /* 记录日志 */
			            // admin_log('', 'batch_restore', 'goods');
			            // break;
// /* 删除 */	        case 'drop':
			            //admin_priv('remove_back');
			            // delete_goods($goods_id);
			            /* 记录日志 */
			            // admin_log('', 'batch_remove', 'goods');
			            // break;
			        default:
			        	$boolean = FALSE;
			    }
			}
			    $boolean ? R('Goods/goods_list_view') : die('操作失败');
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
		 * [goods_insert_view description] 显示添加, 修改页面
		 * @return [type] [description]
		 */
		public function goods_operation_view(){
			$this->display();
		}
		public function goods_operation(){
			IS_POST ? '' : $this->error('非法操作');
			$is_insert = $_POST['goods_id'] ? true : false;
			// 判断商品货号是否重复
			$table = "goods_sn = $_POST[goods_sn] AND is_delete = 0 AND goods_id <> $_POST[goods_id]";
			M('goods')->where($table)->count() > 0 ? $this->error('商品货号重复') : '';
			// 图片上传检查
			if(is_array($_FILES)){
				foreach ($_FILES as $key => $value) {
					switch ($key) {
						case 'goods_img':
							$value['error'] > 0 ? $this->error('商品图片上传失败, 请检查图片是否符合要求') : '';
							break;
						case 'goods_thumb':
							$value['error'] > 0 ? $this->error('商品微缩图上传失败 请检查图片是否符合要求') : '';
							break;
						case 'img_url':
							$value['error'] > 0 ? $this->error('商品相册图片上传失败 请检查图片是否符合要求') : '';
							break;
						default:
							$boolean = FALSE;
							break;
					}
				}
				if ($boolean) {
					import('ORG.Net.UploadFile');
					$upload = new UploadFile();// 实例化上传类
					$upload->maxSize  = 3145728 ;// 设置附件上传大小
					$upload->allowExts  = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
					$upload->savePath =  './Public/Uploads/';// 设置附件上传目录
					if(!$upload->upload()) {// 上传错误提示错误信息
						$this->error($upload->getErrorMsg());
					}else{// 上传成功 获取上传文件信息
						$info =  $upload->getUploadFileInfo();
					}
				}
			}

			var_dump($_POST);			
			// 插入/添加操作
			
			$goods_model = D('Goods');
			// $goods_model->goods_operation($_POST, $is_inset);
		}

			// VIEW.3.  商品分类
		public function goods_category_view(){
			$this->display();
		}
		public function goods_category_insert(){
			$this->display();
		}
			// VIEW.4.  商品品牌
		public function goods_brand_view(){
			$this->display();
		}
			// VIEW.5.  用户评论
		public function goods_comment_view(){
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

