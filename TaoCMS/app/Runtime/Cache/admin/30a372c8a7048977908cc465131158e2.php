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
         var UserData={ Rows: <?php echo ($list); ?> };    
        $(function () {
            window['g'] = 
            $("#maingrid1").ligerGrid({
                checkbox: true,
                columns: [
                { display: '文件信息', name: 'filename', align: 'left', width: 300},
                { display: '文件大小', name: 'size', width: 140 },
                { display: '操作', width: 100, name:'filename',
                	render: function (record, rowindex, value, column) { 
                	//this 这里指向grid 
                	//record 行数据 
                	//rowindex 行索引 
                	//value 当前的值，对应record[column.name] 
                	//column 列信息 
                	return "<a href='restore?file=" + value + "'>导入</a>"; 
                	} 
                	}, 
                ], dataAction: 'local',data: $.extend(true,{},UserData),pageSize:15, alternatingRow: false,
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
        function f_onCheckAllRow(checked)
        {
            for (var rowid in this.records)
            {
                if(checked)
                    addCheckedCustomer(this.records[rowid]['filename']);
                else
                    removeCheckedCustomer(this.records[rowid]['filename']);
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
    <div id="maingrid1"  style="margin:0; padding:0"></div>

 

</body>
</html>