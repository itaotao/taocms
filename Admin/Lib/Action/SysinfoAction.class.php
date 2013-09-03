<?php
class SysinfoAction  extends CommonAction{
	public function config(){
		if(F("site",$_POST,CONF_PATH)){
			$this->success("修改成功！");
		}else {
			$this->error("修改失败，请修改相关文件或目录权限！");
		}
		
	}
}