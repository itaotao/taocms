<?php
class MenuModel extends Model{
	   protected $_auto = array ( 

       array('url','getUrl',1,'callback')
   );
   function getUrl(){
   	return __APP__."/".I("url");
   }
} 