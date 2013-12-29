<?php

	Class MemcacheModel extends Model{

		// memcache对象
		private $cache;

		private $model;

		/* 初始化判断是否启用memcache */
		function __construct(){
			parent::__construct();
			$this->model = M();

			$host_port = empty(C('MEMCACHE_HOST')) ? C('MEMCACHE_HOST') : 'tcp://127.0.0.1:11211';
			$arr = explode(':', $host_port);
			$host = substr($arr[1], 2);
			$port = $arr[2];
			$cacahe_str = function_exists('fsockopen') && fsockopen($host,$port)!= FALSE ? 'Memcache' : 'File';
			C('MEMCACHE_HOST', $cache_str);

			cacahe_nav();
		}
		/**
		 * 缓存导航
		 * @return Ambigous <mixed, object, NULL, unknown>
		 */
		public function cacahe_nav(){
			$CACHE_NAV = cache('CACHE_NAV');
			if (empty($CACHE_NAV)) {
				$sql = "SELECT ID, NAME, URL, TYPE 
						FROM ".table('nav')." 
						WHERE ifshow = '1' 
						ORDER BY type, vieworder";
				$res = $this->model->query($sql);

				foreach ($res as $row) {
					$TYPE = $row['TYPE'];
					$ID = $row['ID'];

					$CACHE_NAV[$TYPE][$ID]['NAME'] = $row['NAME'];
					$CACHE_NAV[$TYPE][$ID]['URL'] = $row['URL'];
				}
				if(is_array($CACHE_NAV)){
					foreach ($CACHE_NAV as $key => $value) {
						cache('CACHE_NAV_'.$key, $CACHE_NAV[$key]);			// 按照type保存, 二维数组
					}
					cache('CACHE_NAV', 1);
				}
			}
			return $CACHE_NAV;											// 返回三维数组
		}
	}