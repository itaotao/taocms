<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>TaoCMS后台管理系统</title>
    <link href="__PUBLIC__/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" /> 
    <link href="__PUBLIC__/ligerUI/skins/Silvery/css/all.css" rel="stylesheet" type="text/css" />
    <script src="__PUBLIC__/js/jquery-1.3.2.min.js" type="text/javascript"></script>    
    <script src="__PUBLIC__/ligerUI/js/ligerui.min.js" type="text/javascript"></script> 
     <script src="__PUBLIC__/ligerUI/js/plugins/ligerTree.js" type="text/javascript"></script>
        <script type="text/javascript">
       // var indexdata = <?php echo ($list); ?>;
        	        
            var tab = null;
            var accordion = null;
            var tree = null;

            $(function ()
            {        
            	 $("#tree1").ligerTree({ checkbox: false });
                //布局
                $("#layout1").ligerLayout({
                    leftWidth: 190,
                    height: '100%',
                    heightDiff: -34,
                    space: 4,
                    onHeightChanged: f_heightChanged
                });

                var height = $(".l-layout-center").height();

                //Tab
                $("#framecenter").ligerTab({ height: height });

                //面板
                $("#accordion1").ligerAccordion({ height: height - 24, speed: null });

                $(".l-link").hover(function ()
                {
                    $(this).addClass("l-link-over");
                }, function ()
                {
                    $(this).removeClass("l-link-over");
                });
                //树


                tab = $("#framecenter").ligerGetTabManager();
                accordion = $("#accordion1").ligerGetAccordionManager();
                tree = $("#tree1").ligerGetTreeManager();
                $("#pageloading").hide();

            });
            function f_heightChanged(options)
            {
                if (tab)
                    tab.addHeight(options.diff);
                if (accordion && options.middleHeight - 24 > 0)
                    accordion.setHeight(options.middleHeight - 24);
            }
            function f_addTab(tabid,text, url)
            { 
                tab.addTabItem({ tabid : tabid,text: text, url: url });
            } 
             function changePwd(){
            	 $.ligerDialog.open({ url: "<?php echo U('Public/changepwd');?>",height: 400,width:800, isResize:true ,showMax:true,showMin:true});
             }
             function note(){
            	 $.ligerDialog.open({ url: "<?php echo U('Public/note');?>",height: 400,width:800,title:'便签', isResize:true ,showMax:true,showMin:true});
             }
     </script> 
<style type="text/css"> 
    body,html{height:100%;}
    body{ padding:0px; margin:0;   overflow:hidden;}  
    .l-link{ display:block; height:26px; line-height:26px; padding-left:10px; text-decoration:underline; color:#333;}
    .l-link2{text-decoration:underline; color:white; margin-left:2px;margin-right:2px;}
    .l-layout-top{background:#102A49; color:White;}
    .l-layout-bottom{ background:#E5EDEF; text-align:center;}
    #pageloading{position:absolute; left:0px; top:0px; background:white url('__PUBLIC__/img/loading.gif') no-repeat center; width:100%; height:100%;z-index:99999;}
    .l-link{ display:block; line-height:22px; height:22px; padding-left:16px;border:1px solid white; margin:4px;}
    .l-link-over{ background:#FFEEAC; border:1px solid #DB9F00;} 
    .l-winbar{ background:#2B5A76; height:30px; position:absolute; left:0px; bottom:0px; width:100%; z-index:99999;}
    .space{ color:#E7E7E7;}
    /* 顶部 */ 
    .l-topmenu{ margin:0; padding:0; height:31px; line-height:31px; background:url('__PUBLIC__/img/top.jpg') repeat-x bottom;  position:relative; border-top:1px solid #1D438B;  }
    .l-topmenu-logo{ color:#E7E7E7; padding-left:35px; line-height:26px;}
    .l-topmenu-welcome{  position:absolute; height:24px; line-height:24px;  right:30px; top:2px;color:#070A0C;}
    .l-topmenu-welcome a{ color:#E7E7E7; text-decoration:underline} 
     .node{display:none;}
 </style>
</head>
<body style="padding:0px;background:#EAEEF5;">  
<div id="pageloading"></div>  
<div id="topmenu" class="l-topmenu">
    <div class="l-topmenu-logo">TaoCMS后台管理系统</div>
    <div class="l-topmenu-welcome">
        <a>欢迎您，<?php echo (session('loginUserName')); ?></a>
        <a href="javascript:note()" class="l-link2">小便签</a>
        <span class="space">|</span>
        <a href="#" class="l-link2" target="_blank">后台地图</a> 
        <span class="space">|</span>
        <a href="javascript:changePwd()" class="l-link2" target="_blank">修改密码</a>
         <a href="<?php echo U("Public/logout/");?>" class="l-link2" target="_top">安全退出</a>
    </div> 
</div>
  <div id="layout1" style="width:99.2%; margin:0 auto; margin-top:4px; "> 
        <div position="left"  title="后台管理菜单" id="accordion1">
                     <div title="功能列表" class="l-scroll">
                       	<ul id="tree1">

<?php if(is_array($menu)): $i = 0; $__LIST__ = $menu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
       <span><?php echo (nodetozh($key)); ?></span>
       <ul>
      <?php if(is_array($vo)): $i = 0; $__LIST__ = $vo;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$data): $mod = ($i % 2 );++$i;?><li>
                    <span><a href="javascript:f_addTab('<?php echo ($data); ?>','<?php echo (nodetozh($data)); ?>','__GROUP__/<?php echo ($data); ?>/index')"  ><?php echo (nodetozh($data)); ?></a></span>
              </li><?php endforeach; endif; else: echo "" ;endif; ?>
       </ul>
</li><?php endforeach; endif; else: echo "" ;endif; ?>
</ul>  
                    </div>
        </div>
        <div position="center" id="framecenter"> 
            <div tabid="home" title="我的主页" style="height:300px;text-align: center;" >
                <iframe frameborder="0" name="home" id="home" src="<?php echo U('main');?>"></iframe>
           
            <TABLE   width="60%"  border="1" align="center">
<TR  style="text-align: center;"><th colspan="2" style="text-align: center;">系统信息</th></tr>
<?php if(is_array($info)): $i = 0; $__LIST__ = $info;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?><TR class="row" onmouseover="over()" onmouseout="out()" onclick="change()" ><TD width="15%"><?php echo ($key); ?></TD><TD><?php echo ($v); ?></TD></TR><?php endforeach; endif; else: echo "" ;endif; ?>
</TABLE>
            </div> 
        </div> 
        
    </div>
    <div  style="height:32px; line-height:32px; text-align:center;">
            Copyright © 2011-2013 blog.kisscn.com
    </div>

</body>
</html>