<?php
// +----------------------------------------------------------------------
// | TaoCMS [ TRY ALL OPERATION ]
// +----------------------------------------------------------------------
// | Copyright (c) 2013-2012 http://blog.kisscn.com All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: tao <544828662@qq.com>
// +----------------------------------------------------------------------

/**
 * TaoCMS IndexAction后台首页控制器类
 * @author   tao <544828662@qq.com>
 */
class IndexAction extends CommonAction {
    public function index() {
   // $m=M("Session")->where("session_data like '%authId|s:".strlen($authInfo['id']).":\"".$authInfo['id']."\"%'")->find(
            if(isset($_SESSION[C('USER_AUTH_KEY')])) {
            //显示菜单项
            $menu  = array();
            if(isset($_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]])) {

                //如果已经缓存，直接读取缓存
               $menu   =   $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]];
              
            }else {
            	if($_SESSION["admin"]){
            		$node=M("Node");
            		$result=$node->field("id,name,pid")->select();
            		$result=node_merge($result);
     				foreach ($result as $value){
     					foreach ($value["children"] as $k=>$v){
    						if($v["name"]!="Index" and $v["name"]!="Public") {
    							foreach ($v["children"] as $key=>$vo){
   									$menu[$v["name"]][]= $vo["name"];
    							}	
    						}
     					}	
     				}
            	}else{
            		$arr=$_SESSION['_ACCESS_LIST'];
     				foreach ($arr as $k=>$value){
     					if($k!="ADMIN"){
    						foreach ($value as $key=>$vo) {
   								$menu[$k][] =ucwords(strtolower($key));
    						}
     					}
     				}	
            	}

                //缓存菜单访问
                $_SESSION['menu'.$_SESSION[C('USER_AUTH_KEY')]]	=	$menu;
            }
            $this->assign('menu',$menu);
		}
        $this->display();
    }
	public function main(){
	        $info = array(
            '操作系统'=>PHP_OS,
            '运行环境'=>$_SERVER["SERVER_SOFTWARE"],
            'PHP运行方式'=>php_sapi_name(),
            'ThinkPHP版本'=>THINK_VERSION.' [ <a href="http://thinkphp.cn" target="_blank">查看最新版本</a> ]',
            'Mysql版本'=>mysql_get_server_info(),
            '上传附件限制'=>ini_get('upload_max_filesize'),
            '执行时间限制'=>ini_get('max_execution_time').'秒',
            '服务器时间'=>date("Y年n月j日 H:i:s"),
            '北京时间'=>gmdate("Y年n月j日 H:i:s",time()+8*3600),
            '服务器域名/IP'=>$_SERVER['SERVER_NAME'].' [ '.gethostbyname($_SERVER['SERVER_NAME']).' ]',
            '剩余空间'=>round((@disk_free_space(".")/(1024*1024)),2).'M',
            'register_globals'=>get_cfg_var("register_globals")=="1" ? "ON" : "OFF",
            'magic_quotes_gpc'=>(1===get_magic_quotes_gpc())?'YES':'NO',
            'magic_quotes_runtime'=>(1===get_magic_quotes_runtime())?'YES':'NO',
            );	
        $this->assign('info',$info);
        $this->display();
	}
}