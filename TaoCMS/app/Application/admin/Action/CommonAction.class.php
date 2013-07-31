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
 * TaoCMS CommonAction公共控制器基类
 * @author   tao <544828662@qq.com>
 */
class CommonAction extends Action{
	/**
     * 初始化方法
     * @access public
     * @return void
     */		
	public function _initialize(){
		//引入RBAC类
		import('ORG.Util.RBAC');
		if(empty($_SESSION[C('USER_AUTH_KEY')])){
		
			$this->redirect("Public/login");
	
		}
	//	dump(RBAC::saveAccessList());
		//dump($_SESSION['_ACCESS_LIST']);
		//die();
		$notauth=in_array(MODULE_NAME, explode(",", C("NOT_AUTH_MODULE"))) || in_array(ACTION_NAME, explode(",", C("NOT_AUTH_ACTION")));
		if(C("USER_AUTH_ON")&&!$notauth){
			RBAC::AccessDecision()||$this->error("没有权限");
		}
	}
	public function index(){
		$this->display();
	}
}
/*---------------------------------------------------CommonAction End TaoCMS---------------------------------------------------------------*/
