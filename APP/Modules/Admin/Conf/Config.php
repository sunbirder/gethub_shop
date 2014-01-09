<?php
	return array(
		'TMPL_PARSE_STRING'	=>	array(
			 '__TPLINDEX__'	=>	__ROOT__.'/'.APP_NAME.'/Modules/'.GROUP_NAME.'/Tpl/Index',

			 '__PUBLIC__'	=>	__ROOT__.'/Public/'.GROUP_NAME,
			 '__CSS__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/css',
			 '__JS__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/js',
			 '__IMG__'	=>	__ROOT__.'/Public/'.GROUP_NAME.'/images',
			 '__UPLOAD__'	=>	reset(explode('index', __APP__)).'Upload/',

			 '__GOODSURL__'	=>	__GROUP__.'/Goods',
			),
		);

