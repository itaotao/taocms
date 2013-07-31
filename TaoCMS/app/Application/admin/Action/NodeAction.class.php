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
 * TaoCMS NodeAction节点管理控制器类
 * @author   tao <544828662@qq.com>
 */
class NodeAction extends CommonAction{
	/**
     * 拼接数据并json格式化输出
     * @access public
     * @return void
     */
	public function getData(){
		//实例化Node模型
    	$node=M("Node");
    	//当前页数
    	$page=I("page");
    	//每页显示条数
    	$pagesize=I("pagesize");
   		$where=urldecode(I("where"));
    	$where=chuli(json_decode($where,true));
    	//总记录数
       	$total=$node->where($where)->count();
       	//开始条数
     	$start=($page-1)*$pagesize;
		$result=$node->where($where)->order("sort")->limit($start,$pagesize)->select();
		$list=node_merge($result);
		echo $list='{"Rows":'.json_encode($list).',"Total":'.$total.'}'; 
	}
	/**
     * 添加节点页面显示
     * @access public
     * @return void
     */
	public function add(){
	  	$node=M("Node");
     	$result=$node->select();
     	$list=node_merge($result);
     	$this->assign("auth",$list);
		$this->display();
	}
	/**
     * 编辑节点页面
     * @access public
     * @return void
     */	
    public function  edit(){
       	$node_id=I("id");
	    $node=M("Node");
	   	$r=$node->select();
     	$auth=node_merge($r);
     	$this->assign("auth",$auth);    
	    $list=$node->where("id=".$node_id)->select();
	    $parent=$node->where("id=".$list[0]["pid"])->find();
		$this->assign("result",$list);
		$this->assign("parent",$parent);
		$this->display();
    }
	/**
     * 插入节点操作
     * @access public
     * @return void
     */	
	public function insert(){
       	$node = D('Node');
	  	if(!$node->create($_POST,1)){
      	$this->error($node->getError());
	 	 }else{
	  	if(!false==$node->add()){
	  		$this->success("新增节点成功！");
	  	}else{
	  		$this->error("新增节点失败！");
	  	}
	  	}   
	}
	/**
     * 修改节点操作
     * @access public
     * @return void
     */	
	public function update(){
		$node = D('Node');
		if(!false==$node->create()){
			$node->save();
			$this->success("修改节点成功！");
		}else{
	        $this->error($node->getError());
		}
	}
	/**
     * 删除节点操作
     * @access public
     * @return void
     */		
	public function delete(){
		$idlist=I("id");
		$node = D('Node');
	 	$result=$node->where("id in (".$idlist.")")->delete();
	 	if(false==$result){
	 		$this->error("删除失败！");
	 	}else {
	 		$this->success("删除成功！");
	 	}
	}
	/**
     * 禁用节点操作
     * @access public
     * @return void
     */	
	public function forbid(){
	 	$idlist=I("id");
		$node = D('Node');
		$data["status"]=0;
	 	$result=$node->where("id in (".$idlist.")")->save($data);
	 	if(false==$result){
	 		$this->error("禁用失败！");
	 	}else{
	 		$this->success("禁用成功！");
	 	}
	}
	/**
     * 启用节点操作
     * @access public
     * @return void
     */	
	public function open(){
		$idlist=I("id");
		$node = D('Node');
		$data["status"]=1;
	 	$result=$node->where("id in (".$idlist.")")->save($data);
	 	if(false==$result){
	 		$this->error("启用失败！");
	 	}else {
	 		$this->success("启用成功！");
	 	}
	}
}
/*---------------------------------------------------NodeAction End TaoCMS---------------------------------------------------------------*/
