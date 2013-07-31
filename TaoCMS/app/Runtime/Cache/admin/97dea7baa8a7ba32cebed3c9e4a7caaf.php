<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>核心设置</title>
<link href="__PUBLIC__/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
    <style type="text/css">
           body{ font-size:12px;}
        .l-table-edit-td{ padding:6px;}
       .l-table-input{width:400px;height:25px;}
        .l-table-textarea{width:400px;height:100px;}
        .l-button-submit,.l-button-test{width:80px; float:left; margin-left:10px; padding-bottom:2px;}
        .l-verify-tip{ left:230px; top:120px;}
    </style>

</head>

<body style="padding:10px">

    <form name="form1" method="post"   action="<?php echo U('config');?>">
<div>
<img src="__PUBLIC__/ligerUI/skins/icons/communication.gif";" alt="" />   <span style="font-weight: bold;">核心设置</span>
<hr />
</div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr align="right">
        <td>参数说明</td>
        <td>参数值</td>
        <td >变量名</td>
        </tr>
            <tr>
                <td align="right" class="l-table-edit-td">TaoCMS安装目录:</td>
                <td align="right" class="l-table-edit-td"><input name="CMSPATH" type="text"  value="<?php echo (C("cmspath")); ?>" class="l-table-input" /></td>
                <td align="right" class="l-table-edit-td"><span>cmspath</span></td>
            </tr>
			    <tr>
                <td align="right" class="l-table-edit-td">数据备份目录（在Public目录内）：</td>
                <td align="right" class="l-table-edit-td"><input name="BACKDIR" type="text"  value="<?php echo (C("BACKDIR")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>backupdir</span></td>
            </tr>
   			    <tr>
                <td align="right" class="l-table-edit-td">smtp服务器：</td>
                <td align="right" class="l-table-edit-td"><input name="SMTP_SERVER" type="text"  value="<?php echo (C("SMTP_SERVER")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>smtp_server</span></td>
            </tr>   
               			    <tr>
                <td align="right" class="l-table-edit-td">smtp服务器端口：</td>
                <td align="right" class="l-table-edit-td"><input name="SMTP_PORT" type="text"  value="<?php echo (C("SMTP_PORT")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>smtp_port</span></td>
            </tr>
                           			    <tr>
                <td align="right" class="l-table-edit-td">SMTP服务器的用户账号：</td>
                <td align="right" class="l-table-edit-td"><input name="SMTP_USER" type="text"  value="<?php echo (C("SMTP_USER")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>smtp_user</span></td>
            </tr>  
                           			    <tr>
                <td align="right" class="l-table-edit-td">SMTP服务器的用户密码：</td>
                <td align="right" class="l-table-edit-td"><input type="password" name="SMTP_PASSWORD" class="l-table-input" value="<?php echo (C("smtp_password")); ?>">
                <td align="right" class="l-table-edit-td"><span>smtp_password</span></td>
            </tr>  
       
        </table>
<div class="text-center">
<input type="hidden" name="config" value="core"/>
<input type="submit" value="提交"  class="l-button l-button-submit" /> &nbsp;&nbsp;
<input type="reset"" value="重置"  class="l-button l-button-submit"/>
</div>
    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>