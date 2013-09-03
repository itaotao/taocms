<?php
class GroupModel extends Model{
	//表单的数据验证
	protected $_validate = array(
     array('name','','分组已经存在！',0,'unique',1), // 在新增的时候验证nickname字段是否唯一
     //array('name', '/^[a-z|A-Z|\d_]$/', '格式不正确！'), 
     array('title','','显示名称已经存在！',0,'unique',1), // 在新增的时候验证nickname字段是否唯一
     array('sort','number','必须是数字!',2), 
);
   //数据的自动填充
   protected $_auto = array ( 
       //array('active','1'),  // 新增的时候把status字段设置为1
       array('create_time','time',1,'function'), 
       array('update_time','time',2,'function'),// 对update_time字段在更新的时候写入当前时间戳
       array('sort','getSort',1,'callback'),
   );
   function getSort(){
   	$group=M("Group");
   	$sort = $group->max('sort');
    $sort=$sort+1;
    return $sort;  	
   }
}