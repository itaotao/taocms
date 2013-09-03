<?php
return array(
	'DB_TYPE'       =>     'mysql',
	'DB_HOST'       =>     'localhost',
	'DB_NAME'       =>     'taocms',
	'DB_USER'       =>     'root',
	'DB_PWD'        =>     '',
	'DB_PORT'       =>     '3306',
	'DB_PREFIX'     =>     'tao_',
    'DB_CHARSET'    =>     'utf8',
    'DEFAULT_THEME'  =>    'default',    // 默认模板主题名称
    'DEFAULT_FILTER'=>'htmlspecialchars',
    'SHOW_PAGE_TRACE'  =>  false, 
    'TMPL_PARSE_STRING'  => array(
     '__PUBLIC__' =>  '/taotao/Public' ,   //  更改默认的 __PUBLIC__ 替换规则
	 ),
	 'DB_BACKUP'    =>     './Public/backup/',//数据库备份路径
	 'DB_BACKUP_SIZE'    =>     '2048',
	'TOKEN_ON'=>false,  // 是否开启令牌验证
    'TOKEN_NAME'=>'__hash__',    // 令牌验证的表单隐藏字段名称
    'TOKEN_TYPE'=>'md5',  //令牌哈希验证规则 默认为MD5
    'TOKEN_RESET'=>true,  //令牌验证出错后是否重置令牌 默认为true
	'LOAD_EXT_CONFIG' =>'mark,site',
	'SHOW_PAGE_TRACE'        =>true, 
);