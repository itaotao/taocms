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
 * TaoCMS RoleAction角色管理控制器类
 * @author   tao <544828662@qq.com>
 */
class RoleAction extends CommonAction{
	/**
     * 拼接数据并json格式化输出
     * @access public
     * @return void
     */	
	public function getData(){
		$role=M("Role");
		//当前页数
		$page=I("page",1);
		//每页显示条数
    	$pagesize=I("pagesize",15);
    	//获取前台传入的where条件
   		$where=urldecode(I("where"));
    	$where=chuli(json_decode($where,true));
    	//总记录数
    	$total=$role->where($where)->count();
    	//开始条数
    	$start=($page-1)*$pagesize;
		$list=$role->where($where)->limit($start,$pagesize)->select();
		$list=node_merge($list);
		echo $list='{"Rows":'.json_encode($list).',"Total":'.$total.'}'; 
	}
	/**
     * 添加角色页面显示
     * @access public
     * @return void
     */
	public function add(){
		$Role=M("Role");
		$result=$Role->select();
		$this->assign("list",$result);
		$this->display();
	}
	/**
     * 插入角色操作
     * @access public
     * @return void
     */
	public function insert(){
		// 实例化Role模型
		$Role = D('Role');
		if(!$Role->create($_POST,1))
		{
			// echo $Role->getError();
			$this->error($Role->getError());

		}else
		{
	  if(!false==$Role->add()){
	  	$this->success("新增角色成功！");
	  }else
	  {
	  	$this->error("新增角色失败！");
	  }
		}
		 
	}
	/**
     * 编辑角色页面显示
     * @access public
     * @return void
     */
	public function  edit(){
		$Role_id=I("id");
		$Role=M("Role");
		$result=$Role->select();
		$list=$Role->where("id=".$Role_id)->select();
		$parent=$Role->where("id=".$list[0]["pid"])->find();
		$this->assign("list",$result);
		$this->assign("result",$list);
		$this->assign("parent",$parent);
		$this->display();
	}
	/**
     * 修改角色
     * @access public
     * @return void
     */
	public function update(){
		$Role=D("Role");

		if(!false==$Role->create()){
			$Role->save();
			$this->success("修改角色成功！");
		}else {
			$this->error($Role->getError());
		}
	}
	/**
     * 删除角色
     * @access public
     * @return void
     */	
	public function  delete(){
	 $idlist=I("id");
	 $Role=D("Role");
	 $result=$Role->where("id in (".$idlist.")")->delete();
	 if (false==$result){
	 	echo "删除失败";
	 }else {
	 	echo "删除成功";
	 }
	 
	}
	/**
     * 权限选择页面显示
     * @access public
     * @return void
     */
	public function auth(){
		$role_id=I("id");
		$authlist=M("Access")->where("role_id=".$role_id)->field("node_id")->select();
		$authlist=$this->getUserIdList($authlist);
		$list=M("Node")->select();
		$list=node_merge($list);
		$this->assign('authList',$authlist);
		$this->assign('list',$list);
		$this->assign('role_id',$role_id);
		$this->display();

	}
	/**
     * 增加权限
     * @access public
     * @return void
     */
	public function addauth(){
		$role_id=I('role_id');
		$auth=I('auth');
		$db=M("Access");
		$result=$db->where("role_id=".$role_id)->delete();
		$data=array();
		foreach($auth as $value) {
			$arr=explode("_", $value);
			$data[]=array(
 						'node_id'=>$arr[0],
 						'level'=>$arr[1],
 						'role_id'=>$role_id
					);
		}
		if($db->addAll($data)){
			$this->success("授权成功！");
		}

	}
	/**
     * 对应角色用户列表
     * @access public
     * @return void
     */	
	public function userlist(){
		$role_id=I('role_id');
		$ruser=M("Role_user");
		$list=$ruser->where("role_id=".$role_id)->field("user_id")->select();
		$list=$this->getUserIdList($list);
		$user=M("user");
		$idList=implode(',', $list);
		$result=$user->where("id in (".$idList.")")->select();
		$result=json_encode($result);
		$this->assign('list',$result);
		$this->display();
	}
	/**
     * 得到用户id组成的数组
     * @access protected
     * @return void
     */	
	protected function getUserIdList($arr){
		foreach ($arr as $value){
			foreach ($value as $v){
				$list[]=$v;
			}
		}
		return $list;
	}
	/**
     * 禁用操作
     * @access public
     * @return void
     */		
	public function forbid(){
		$idlist=I("id");
	 	$role = D('Role');
	 	$data["status"]=0;
	 	$result=$role->where("id in (".$idlist.")")->save($data);
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
	 	$role = D('Role');
	 	$data["status"]=1;
	 	$result=$role->where("id in (".$idlist.")")->save($data);
		if(false==$result){
	 		$this->error("启用失败！");
	 	}else {
	 		$this->success("启用成功！");
	 	}
	}
}
/*---------------------------------------------------NodeAction End TaoCMS---------------------------------------------------------------*/