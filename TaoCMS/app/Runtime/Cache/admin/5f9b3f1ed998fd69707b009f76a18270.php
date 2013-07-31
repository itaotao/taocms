<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>节点管理</title>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>『TaoCMS后台管理平台』By ThinkPHP <?php echo (THINK_VERSION); ?></title>
    <link href="__PUBLIC__/ligerUI/skins/Aqua/css/ligerui-all.css" rel="stylesheet" type="text/css" />
<!--        <link href="__PUBLIC__/ligerUI/skins/Gray/css/all.css" rel="stylesheet" type="text/css" />-->
    <link href="__PUBLIC__/ligerUI/skins/ligerui-icons.css" rel="stylesheet" type="text/css" /> 
   <script type="text/javascript" src="__PUBLIC__/js/jquery-1.3.2.min.js"></script>
    <script src="__PUBLIC__/ligerUI/js/ligerui.min.js" type="text/javascript"></script>
   <script src="__PUBLIC__/ligerUI/js/plugins/ligerGrid.js"></script>
     <script src="__PUBLIC__/ligerUI/js/plugins/ligerToolBar.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerDialog.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerFilter.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerDrag.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerResizable.js" type="text/javascript"></script>
  <script src="__PUBLIC__/ligerUI/js/plugins/ligerTextBox.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerCheckBox.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerComboBox.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerDateEditor.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerSpinner.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerTip.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerButton.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerForm.js" type="text/javascript"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerPopupEdit.js"></script>
    <script src="__PUBLIC__/ligerUI/js/plugins/ligerTab.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/jquery.validate.min.js" type="text/javascript"></script> 
    <script src="__PUBLIC__/js/jquery.metadata.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/messages_cn.js" type="text/javascript"></script>
    <script src="__PUBLIC__/js/ligerGrid.showFilter.js"></script>
     <script src="__PUBLIC__/js/base.js"></script>
        
     
<script language="JavaScript">

//指定当前组模块URL地址 
var URL = '__URL__';
var APP	 =	 '__APP__';
var PUBLIC = '__PUBLIC__';

</script>

</head>


    <script type="text/javascript">
  
   // 
    
     //去掉  大于小于包括,并改变顺序
     $.ligerDefaults.Filter.operators['string'] =
     $.ligerDefaults.Filter.operators['text'] =
     ["like" , "equal", "notequal", "startwith", "endwith" ];
         var UserData={ Rows: <?php echo ($list); ?> };
         var statusData = [{ status: 1, text: '已激活' }, { status: 0, text: '已禁用'}];
         
        $(function () {
        	 $("#tab1").ligerTab({
        		 onAfterSelectTabItem: function (tabid)
                 {if(tabid=="tabitem2"){
                	 navtab = $("#tab1").ligerGetTabManager();
               navtab.overrideSelectedTabItem({ tagid:"import",text:"数据导入",url: 'import',height:800 });   
                     }      
                 } 
            	 });
        	 //navtab = $("#tab1").ligerGetTabManager();
        
            window['g'] = 
            $("#maingrid1").ligerGrid({
                checkbox: true,
                columns: [
                { display: '表名', name: 'Name', align: 'left', width: 140},
                { display: '记录数', name: 'Rows', minWidth: 60, width: 140 },
                { display: '类型', name: 'Engine',id:'id1', width: 120 },
                { display: '整理', name: 'Collation', width: 300},
                { display: '大小', name: 'size', width: 140 },
                { display: '多余', name: 'Data_free', width: 140 },
                ], dataAction: 'server',data: $.extend(true,{},UserData),pageSize:15, alternatingRow: false, tree: { columnId: 'id1' },
                toolbar: { items: [
                                   { text: '高级查询', click: itemclick, icon: 'search2'},
                                   { line: true },
                                   { text: '导出', click: exportclick, icon: 'download' },
                                   { line: true },
                                   { text: '全部导出', click: allexport, icon: 'database' },
                                   { line: true },
                                   { text: '优化', click: opclick, icon: 'modify' },
                                   { line: true },
                                   { text: '修复', click: repairclick, icon:'config' }
                                                      
                                   ]},
               // data: { Rows: <?php echo ($ulist); ?> } ,
                width: '100%', height: '100%', isChecked: f_isChecked, onCheckRow: f_onCheckRow, onCheckAllRow: f_onCheckAllRow
            });
            

            $("#pageloading").hide();
        });
        function f_reload() {
            g.loadData();
        }
        function itemclick()
        {
            g.options.data = $.extend(true,{}, UserData);
            g.showFilter();
        }
        function allexport(){
      	  $.ligerDialog.confirm('您确定要导出全部表吗？', function (yes) { 
    		  if(yes)
    		  $.ligerDialog.open({ url: "export",height: 200,width:400, isResize:true ,showMax:true,showMin:true});
     		
       	   });
        }
          function exportclick(){
	     var str=f_getChecked();
	
	     if(str==""){
   	  $.ligerDialog.alert("请至少选择其中一项！", '警告', "warn");
	     }else{
	  $.ligerDialog.confirm('您确定要导出吗？', function (yes) { 
		  if(yes)
		  $.ligerDialog.open({ url: "export?table="+str,height: 200,width:400, isResize:true ,showMax:true,showMin:true});
 		
   	   });
	     }
	   }
       function opclick(){
  	     var str=f_getChecked();
  		
	     if(str==""){
   	  $.ligerDialog.alert("请至少选择其中一项！", '警告', "warn");
	     }else{
	  $.ligerDialog.confirm('您确定要优化吗？', function (yes) { 
		  if(yes)
   	         if($.post("<?php echo U('optimize');?>", {table:str})){
            	   $.ligerDialog.alert("优化成功！", '成功提示', "success");
            	   f_reload();
               		}else{
               		 $.ligerDialog.alert("优化失败！", '错误提示', "error");
               		}
 		
   	   });
	     }
           }
       function repairclick(){
    	     var str=f_getChecked();
    	  		
    	     if(str==""){
       	  $.ligerDialog.alert("请至少选择其中一项！", '警告', "warn");
    	     }else{
    	  $.ligerDialog.confirm('您确定要修复吗？', function (yes) { 
    		  if(yes)
       	         if($.post("<?php echo U('repair');?>", {table:str})){
                	   $.ligerDialog.alert("修复成功！", '成功提示', "success");
                	   f_reload();
                   		}else{
                   		 $.ligerDialog.alert("修复失败！", '错误提示', "error");
                   		}
     		
       	   });
    	     }
           }
        function f_onCheckAllRow(checked)
        {
            for (var rowid in this.records)
            {
                if(checked)
                    addCheckedCustomer(this.records[rowid]['Name']);
                else
                    removeCheckedCustomer(this.records[rowid]['Name']);
            }
        }

        /*
        该例子实现 表单分页多选
        即利用onCheckRow将选中的行记忆下来，并利用isChecked将记忆下来的行初始化选中
        */
        var checkedCustomer = [];
        function findCheckedCustomer(Name)
        {
            for(var i =0;i<checkedCustomer.length;i++)
            {
                if(checkedCustomer[i] == Name) return i;
            }
            return -1;
        }
        function addCheckedCustomer(Name)
        {
            if(findCheckedCustomer(Name) == -1)
                checkedCustomer.push(Name);
        }
        function removeCheckedCustomer(Name)
        {
            var i = findCheckedCustomer(Name);
            if(i==-1) return;
            checkedCustomer.splice(i,1);
        }
        function f_isChecked(rowdata)
        {
            if (findCheckedCustomer(rowdata.Name) == -1)
                return false;
            return true;
        }
        function f_onCheckRow(checked, data)
        {
            if (checked) addCheckedCustomer(data.Name);
            else removeCheckedCustomer(data.Name);
        }
        function f_getChecked()
        {
            return checkedCustomer.join(',');
        }

  </script>

</head>
<body >

<div class="l-loading" style="display:block" id="pageloading"></div> 
<div id="tab1">
    <div id="maingrid1" title="数据导出" lselected="true" style="margin:0; padding:0"></div>
  <div id="maingrid2" title="数据导入" style="margin:0; padding:0" ></div>
 </div>

</body>
</html>