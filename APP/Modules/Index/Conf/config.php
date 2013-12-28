<?php
	return array(
		// 'TMPL_FILE_DEPR'	=>	'_',
		'TMPL_PARSE_STRING'	=>	array(
			 '__PUBLIC__'	=>	__ROOT__.'/Public/'.GROUP_NAME,
			 '__CSS__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/css',
			 '__JS__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/js',
			 '__IMG__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/images'
			),
		// 'URL_HTML_SUFFIX'	=>	'.html',

		// 模板布局
		'LAYOUT_ON'=>true,
		'LAYOUT_NAME'=>'layout',

		 // 'TAGLIB_LOAD' => true,//加载标签库打开
         // 'APP_AUTOLOAD_PATH' => '@.TagLib',//标签库的文件名
         // 'TAGLIB_BUILD_IN' => 'Cx,Hd',//标签库类名
		);

?>