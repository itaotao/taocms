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
 * TaoCMS UserAction用户管理控制器类
 * @author   tao <544828662@qq.com>
 */
class UserAction extends CommonAction{
	/**
     * 拼接数据并json格式化输出
     * @access public
     * @return void
     */
      public function getData(){
      	$User=D("User");
    	$page=I("page");//当前页数
    	$pagesize=I("pagesize");//每页显示条数
   		$where=urldecode(I("where"));
    	$where=chuli(json_decode($where,true));
     	$total=$User->where($where)->field("password",true)->count(); //总记录数
     	$start=($page-1)*$pagesize;//开始条数
		$list=$User->where($where)->field("password",true)->limit($start,$pagesize)->select();
		echo $list='{"Rows":'.json_encode($list).',"Total":'.$total.'}'; 

      }
	/**
     * 添加用户页面显示
     * @access public
     * @return void
     */
	public function add(){
      	$role=M("Role");
      	$list=$role->select();
      	$this->assign("result",$list);
       	$this->display();
    }
	/**
     * 插入用户操作
     * @access public
     * @return void
     */      
	public function insert(){
      	// 实例化User模型
       	$User = D('User');
	  	if(!$User->create($_POST,1)){
			$this->error($User->getError());
		}else{
	  		if(!false==$User->add()){
	  			$uid=$User->getLastInsID();
				$ru['role_id']=$_POST['role_id'];
				$ru['user_id']=$uid;
				$roleuser=new Model('RoleUser');
				$roleuser->add($ru);
	  			$this->ajaxReturn("新增用户成功！");
	  		}else{
	  			$this->ajaxReturn("新增用户失败！");
	  		}
	  } 
	}
	/**
     * 编辑用户页面显示
     * @access public
     * @return void
     */ 
	public  function edit(){
      	$id=I("id");
     	if(!empty($id)){
			$user=M("User");
			$result=$user->field('id,username,nickname,password,email,status,role_id')->join(C("DB_PREFIX").'role_user on id=user_id')->getById($id);
			$this->assign('result',$result);
			$role=new Model('Role');
			$list=$role->select();
			$this->assign('rlist',$list);
		}
		$this->display();
	}
	/**
     * 修改用户页面显示
     * @access public
     * @return void
     */	
	public function update(){
		$user = D('User');
		if(!false==$user->create()){
			if($result=$user->save())
				$this->success("编辑用户成功！");
            else 
            	$this->error("编辑用户失败！");
		}else {
	        $this->ajaxReturn($user->getError(),0);
		}
	}
	/**
     * 删除用户操作
     * @access public
     * @return void
     */	
	public function delete(){
		$idlist=I("id");
		$user = D('User');
	 	$result=$user->where("id in (".$idlist.")")->delete();
	 	if (false==$result){
	 		$this->error("删除失败");
	 	}else {
	 		$this->success("删除成功！");
	 	}
	}
	/**
     * 禁用操作
     * @access public
     * @return void
     */		
	public function forbid(){
		$idlist=I("id");
		$user = D('User');
		$data["status"]=0;
	 	$result=$user->where("id in (".$idlist.")")->save($data);
		if(false==$result){
	 		$this->error("禁用失败！");
	 	}else{
	 		$this->success("禁用成功！");
	 	}
	}
	/**
     * 启用操作
     * @access public
     * @return void
     */		
	public function open(){
		$idlist=I("id");
		$user = D('User');
		$data["status"]=1;
		$result=$user->where("id in (".$idlist.")")->save($data);
		if(false==$result){
	 		$this->error("启用失败！");
	 	}else {
	 		$this->success("启用成功！");
	 	}
	}    
}
/*---------------------------------------------------NodeAction End TaoCMS---------------------------------------------------------------*/