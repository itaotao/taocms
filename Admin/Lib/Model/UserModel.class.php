<?php
class UserModel extends Model{
	//表单的数据验证
	protected $_validate = array(
	 array('username', '/^[a-z]\w{4,16}$/', '用户名格式不正确！'), 
     array('username','','用户名已经存在！',0,'unique',1), // 在新增的时候验证name字段是否唯一
     array('password', ' /^[a-zA-Z]\w{5,15}$/', '密码格式不正确！'), 
     array('confirmpassword','password','两次密码不一致！',0,'confirm'), // 验证确认密码是否和密码一致array('email', 'require', '邮箱必须！'), 
     array('nickname','','昵称已经存在！',0,'unique',1), // 在新增的时候验证nickname字段是否唯一
     array('email', 'require', 'email必须！',3), 
     array('email','email','邮箱格式不正确',3),
     array('email','','邮箱已经存在！',0,'unique',1), // 在新增的时候验证email字段是否唯一
);
	
    //表单项与字段的映射
//    protected $_map=array(
//    array('user'=>'username'),
//    array('pwd'=>'password'),
//    );
   //数据的自动填充
   protected $_auto = array ( 
       array('status','1'),  // 新增的时候把status字段设置为1
        array('password','md5',3,'function') , // 对password字段在新增和编辑的时候使md5函数处理
       array('create_time','time',1,'function'), // 对update_time字段在更新的时候写入当前时间戳
      // array('joinip','getIP',1,'callback'),
   );
   //关联模型

//   protected $_link = array(
//
//        'Member'=>array(
//
//        'mapping_type' =>HAS_ONE,
//
//        'class_name'   =>'Member',
//      
//                  ),
//
//);


}