<?php
return array(
	//'配置项'=>'配置值'

	// 数据库配置
	// 'DB_HOST'		=>	'mysql-s',
	// 'DB_USER'		=>	's2056183admin',
	// 'DB_PWD'		=>	'cainiao0',
	// 'DB_NAME'		=>	's2056183_shop',
	// 'DB_PREFIX'		=>	'ecs_',

	'DB_HOST'		=>	'127.0.0.1',
	'DB_USER'		=>	'root',
	'DB_PWD'			=>	'',
	'DB_NAME'		=>	'shop',
	'DB_PREFIX'		=>	'ecs_',

	// 独立分组
	'APP_GROUP_LIST'	=>	'Index,Admin',
	'DEFAULT_GROUP'		=>	'Index',
	'APP_GROUP_MODE'	=>	1,

	// 日志信息
	'SHOW_PAGE_TRACE'	=> true,

	// 设置缓存为Memcache
	// 'DATA_CACHE_TYPE' => 'Memcache',									// 不能判断服务器是否开启memcache, 注释掉
	'MEMCACHE_HOST'   => 'tcp://127.0.0.1:11211',						// 预设值
	'DATA_CACHE_TIME' => '3600',										// 预设值

);
?>