<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>站点设置</title>
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
<img src="__PUBLIC__/ligerUI/skins/icons/communication.gif";" alt="" />   <span style="font-weight: bold;">站点设置</span>
<hr />
</div>
        <table cellpadding="0" cellspacing="0" class="l-table-edit" >
        <tr align="right">
        <td>参数说明</td>
        <td>参数值</td>
        <td >变量名</td>
        </tr>
            <tr>
                <td align="right" class="l-table-edit-td">站点根网址:</td>
                <td align="right" class="l-table-edit-td"><input name="BASEHOST" type="text"  value="<?php echo (C("basehost")); ?>" class="l-table-input" /></td>
                <td align="right" class="l-table-edit-td"><span>BASEHOST</span></td>
            </tr>
			    <tr>
                <td align="right" class="l-table-edit-td">网页主页链接：</td>
                <td align="right" class="l-table-edit-td"><input name="INDEXURL" type="text"  value="<?php echo (C("indexurl")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>INDEXURL</span></td>
            </tr>
   			    <tr>
                <td align="right" class="l-table-edit-td">网站名称：</td>
                <td align="right" class="l-table-edit-td"><input name="INDEXNAME" type="text"  value="<?php echo (C("indexname")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>INDEXNAME</span></td>
            </tr>   
               			    <tr>
                <td align="right" class="l-table-edit-td">网站版权信息：</td>
                <td align="right" class="l-table-edit-td"><input name="POWERBY" type="text"  value="<?php echo (C("POWERBY")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>POWERBY</span></td>
            </tr>
                           			    <tr>
                <td align="right" class="l-table-edit-td">站点默认关键字：</td>
                <td align="right" class="l-table-edit-td"><input name="KEYWORDS" type="text"  value="<?php echo (C("KEYWORDS")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>KEYWORDS</span></td>
            </tr>  
                           			    <tr>
                <td align="right" class="l-table-edit-td">站点描述：</td>
                <td align="right" class="l-table-edit-td"><textarea name="DESCRIPTION" class="l-table-textarea"><?php echo (C("description")); ?></textarea>
                <td align="right" class="l-table-edit-td"><span>DESCRIPTION</span></td>
            </tr>  
                           			    <tr>
                <td align="right" class="l-table-edit-td">网站备案号：</td>
                <td align="right" class="l-table-edit-td"><input name="BEIAN" type="text"  value="<?php echo (C("beian")); ?>" class="l-table-input"/></td>
                <td align="right" class="l-table-edit-td"><span>BEIAN</span></td>
            </tr>         
        </table>
<div class="text-center">
<input type="submit" value="提交"  class="l-button l-button-submit" /> &nbsp;&nbsp;
<input type="reset"" value="重置"  class="l-button l-button-submit"/>
</div>
    </form>
    <div style="display:none">
    <!--  数据统计代码 --></div>

    
</body>
</html>