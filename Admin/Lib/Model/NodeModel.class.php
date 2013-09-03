<?php
class NodeModel extends Model{
	//表单的数据验证
	protected $_validate = array(
    
     
);
   //数据的自动填充
   protected $_auto = array ( 
       array('create_time','time',1,'function'), // 对create_time字段在新增的时候写入当前时间戳
        array('update_time','time',2,'function'), // 对update_time字段在更新的时候写入当前时间戳
   );
}