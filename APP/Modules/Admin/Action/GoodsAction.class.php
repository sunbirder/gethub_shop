<?php

	Class GoodsAction extends Action{

		private $cache;													// 自定义cache对象


		function __construct(){
			parent::__construct();
		}

			// VIEW.1.  商品列表
		public function goods_list_view(){
			//SELECT goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, sort_order, goods_number, integral 
			//FROM `shop`.`ecs_goods` AS g WHERE is_delete='0' AND is_real='1' ORDER BY goods_id DESC LIMIT 0,10
			// 通过ajax.post方式获取JSON格式数据, 用于分页
			$table = 'goods';
			if(IS_POST){
				// 显示列表, 排序操作, 分页操作, 页面跳转, 搜索操作
				if (I('post.act')=='query') {
					// dump($_REQUEST);exit;
					$sortname = I('post.sortname');
					$sortorder = I('post.sortorder');
					$page = I('post.page');
					$page_size = I('post.page_size');
        			$cat_id = I('post.cat_id');
			        $brand_id = I('post.brand_id');
			        $intro_type = I('post.intro_type');
			        $suppliers_id = I('post.suppliers_id');
			        $is_on_sale = I('post.is_on_sale');
			        $keyword = I('post.keyword');
			        $goods_model = D('Goods');
					$goods_list = $goods_model->goods_list($sortname, $sortorder, $page, $page_size, $cat_id, $brand_id, $intro_type, $suppliers_id, $is_on_sale, $keyword);
					// p($goods_list);exit;
					// $date['error'] = 0;
					// $date['message'] = "";
					$date['content'] = goods_list($goods_list);
					$date['filter']	= array('sortname'=>$sortname, 'sortorder'=>$sortorder, 'page'=>$page, 'page_size'=>$page_size);
					$date['page_count'] = $goods_list['PAGECOUNT'];
					$date['sortname'] = $sortname;
					$date['sortorder'] = $sortorder;
					// var_dump($date);exit;
					die(json_encode($date));
				}
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
			}
			// var_dump($_REQUEST);die;
			$page_size = 15;													// 页长
			$field = 'goods_id, goods_name, goods_type, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, sort_order, goods_number, integral';
			$where = 'is_delete=0 AND is_real=1';
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

			// VIEW.2.  商品添加
		public function goods_insert_view(){
			$this->display();
		}
			// VIEW.3.  商品分类
		public function goods_category_view(){
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
			$this->display();
		}
			// VIEW.7.  商品上下架
		public function goods_sale_view(){
			$this->display();
		}
			// VIEW.8.  供应商管理???
		// public function goods_list_view(){
			// $this->display();
		// }
			// VIEW.9.  缺货商品 暂无
		public function goods_booking_view(){
			$this->display();
		}
			// VIEW.10. 优惠活动 暂无
		public function goods_favourable_view(){
			$this->display();
		}
	}

