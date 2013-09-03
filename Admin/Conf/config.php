<?php
$config=require './config.inc.php';
$siteconfig= array(
    'APP_DEBUG'             =>      false,	        //开启调试
	'USER_AUTH_ON'			=>		true, 			//开启认证
	'USER_AUTH_TYPE'		=>		1,  			//用户认证使用SESSION标记
	'USER_AUTH_KEY'			=>		'authId',  		//设置认证SESSION的标记名称
	'ADMIN_AUTH_KEY'		=>		'admin',        //管理员用户标记
	'USER_AUTH_MODEL'		=>		'User',  		//验证用户的表模型u_user
	'AUTH_PWD_ENCODER'		=>		'md5', 			//用户认证密码加密方式
	'USER_AUTH_GATEWAY'		=>		'/Public/login',//默认的认证网关
	'NOT_AUTH_MODULE'		=>		'Public',  		//默认不需要认证的模块'A,B,C'
	'REQUIRE_AUTH_MODULE'	=>		'',  			//默认需要认证的模块
	'NOT_AUTH_ACTION'		=>		'',				//默认不需要认证的动作
	'REQUIRE_AUTH_ACTION'	=>		'',				//默认需要认证的动作
	'GUEST_AUTH_ON'			=>		false,			//是否开启游客授权访问
	'GUEST_AUTH_ID'			=>		0, 				//游客标记	
	'RBAC_ROLE_TABLE'		=>		'tao_role',
	'RBAC_USER_TABLE'		=>		'tao_role_user',
	'RBAC_ACCESS_TABLE'		=>		'tao_access',
	'RBAC_NODE_TABLE'		=>		'tao_node',
    'HTML_CACHE_ON'         =>      false,
    'TMPL_CACHE_ON'   		=> 		false, 
	'TAG_NESTED_LEVEL' 		=>		4
	
);

return array_merge($config,$siteconfig);
?>