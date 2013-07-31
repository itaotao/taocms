<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>后台用户列表</title>
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

     //去掉  大于小于包括,并改变顺序
     $.ligerDefaults.Filter.operators['string'] =
     $.ligerDefaults.Filter.operators['text'] =
     ["like" , "equal", "notequal", "startwith", "endwith","greater","greaterorequal","less","lessorequal"];
         var statusData = [{ status: 1, text: '已激活' }, { status: 0, text: '已禁用'}];
         var fields= [
                      { display: 'ID', name: 'id', align: 'left', width: 50},
                      { display: '用户名', name: 'username', minWidth: 60, width: 140 },
                      { display: '昵称', name: 'nickname', width: 120,align:'left' },
                      { display: '添加时间', name: 'create_time', width: 140,render: function (record, rowindex, value, column) { 
                      	return date("Y-m-d h:i:s",value);}},
                      { display: '上次登录时间', name: 'last_login_time', width: 140,render: function (record, rowindex, value, column) { 
                          	return date("Y-m-d h:i:s",value);}},
                      { display: '上次登录IP', name: 'last_login_ip', width: 100},
                      { display: '登录次数', name: 'login_count', width: 100},
                      { display: '状态', name: 'status', width: 140 ,
                      editor: { type: 'select', data: statusData, valueField: 'status' },
                      render: function (item)
                      {
                          if (parseInt(item.status) == 1) return '已激活';
                          return '已禁用';
                      }
                      },
                      ]; 
 

        $(function () { 
            window['g'] = 
            $("#maingrid4").ligerGrid({
                checkbox: true,
                columns: fields, 
                dataAction: 'server',
                url:'<?php echo U("getData");?>',
                root:	 'Rows',
                record:'Total',
                pageParmName:'page',
                pagesizeParmName:'pagesize',
                usePager:true,
                rownumbers: true,
                pageSize:15,
                toolbar: { items: [
                                  { text: '高级查询', click: itemclick, icon: 'search2'},
                                   { text: '增加', click: addclick, icon: 'add' },
                                   { line: true },
                                   { text: '修改', click: editclick, icon: 'modify' },
                                   { line: true },
                                   { text: '删除', click: delclick, icon:'delete' }
                                                      
                                   ]},
                width: '100%', height: '100%', isChecked: f_isChecked, onCheckRow: f_onCheckRow, onCheckAllRow: f_onCheckAllRow
            });
          $("#pageloading").hide();
        });
        function f_reload() {
            g.loadData();
        }
          
      function itemclick()
       {
          if (window.winfilter)
          {
              window.winfilter.show();
          }
          else
          {
              //这里一个要有一个ID
              var filtercontainer = $('<div id="filtercontainer"></div>').width(380).height(120).hide();
              window.filter =  filtercontainer.ligerFilter({ fields: fields });
              window.winfilter = $.ligerDialog.open({
                  width: 420, height: 208,
                  target: filtercontainer, isResize: true, top: 50,
                  buttons: [
                      { text: '确定', onclick: function (item, dialog) { loadData(); dialog.hide(); } },
                      { text: '取消', onclick: function (item, dialog) { dialog.hide(); } }
                  ]
              });
          }
       }
      function loadData()
      {
          var group = window.filter.getData();
     var where=$.ligerui.toJSON(group);
     g.loadServerData({where:encodeURI(where),page:1,pagesize:g.options.pageSize});
      }


      function addclick(){
    	  $.ligerDialog.open({ url: "<?php echo U('add');?>",height: 400,width:800, isResize:true ,showMax:true,showMin:true});
    	  f_reload();
          }
      function editclick(){
     var str=parseInt(f_getChecked().split(",",1));
    var id=parseInt(str);
     var url="edit?id="+id;
     if(isNaN(id)){
   	  $.ligerDialog.alert("请至少选择其中一项！", '警告', "warn");
	     }else{
     $.ligerDialog.open({ url:"<?php echo U('"+url+"');?>",height: 400,width:800, isResize:true ,showMax:true,showMin:true});
     f_reload();
	     }
          }
      function delclick(){
    	     var str=f_getChecked();
    	     if(str==""){
        	  $.ligerDialog.alert("请至少选择其中一项！", '警告', "warn");
    	     }else{
    	  $.ligerDialog.confirm('您确定要删除吗？', function (result) { 
      		if(result)
          	 {
      	         if($.post("<?php echo U('delete');?>", {id:str})){
              	   $.ligerDialog.alert("删除成功！", '成功提示', "success");
              	   f_reload();
                 		}else{
                 		 $.ligerDialog.alert("删除失败！", '错误提示', "error");
                 		}
      		 }
        	   });
    	     }
    	   }
        function f_onCheckAllRow(checked)
        {
            for (var rowid in this.records)
            {
                if(checked)
                    addCheckedCustomer(this.records[rowid]['id']);
                else
                    removeCheckedCustomer(this.records[rowid]['id']);
            }
        }

        /*
        该例子实现 表单分页多选
        即利用onCheckRow将选中的行记忆下来，并利用isChecked将记忆下来的行初始化选中
        */
        var checkedCustomer = [];
        function findCheckedCustomer(id)
        {
            for(var i =0;i<checkedCustomer.length;i++)
            {
                if(checkedCustomer[i] == id) return i;
            }
            return -1;
        }
        function addCheckedCustomer(id)
        {
            if(findCheckedCustomer(id) == -1)
                checkedCustomer.push(id);
        }
        function removeCheckedCustomer(id)
        {
            var i = findCheckedCustomer(id);
            if(i==-1) return;
            checkedCustomer.splice(i,1);
        }
        function f_isChecked(rowdata)
        {
            if (findCheckedCustomer(rowdata.id) == -1)
                return false;
            return true;
        }
        function f_onCheckRow(checked, data)
        {
            if (checked) addCheckedCustomer(data.id);
            else removeCheckedCustomer(data.id);
        }
        function f_getChecked()
        {
            return checkedCustomer.join(',');
        }
    </script>

</head>
<body >
<div id="filter" style="border:1px solid #d3d3d3; display:none; width:370px; height:120px;"></div>
<div class="l-loading" style="display:block" id="pageloading"></div> 
  <form>
    <div id="maingrid4" style="margin:0; padding:0"></div>
  </form>

</body>
</html>