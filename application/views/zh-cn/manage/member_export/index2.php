<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>assets/datePicker/WdatePicker.js"></script>
<script type="text/javascript">
	var sel = [];
	function OnClick() {
	    var select = document.getElementById("select1");
	    var index = select.selectedIndex;
	    var iHas = -1; 
	    sel.sort();
	    for (var i = 0; i < sel.length; i++) {
	        if (sel[i] == index) {
	            iHas = i;
	        } else {
	            select[sel[i]].selected = true;
	        }
	    }
	    if (iHas == -1) {
	        sel.push(index);
	        select[index].selected = true;
	    } else {
	        sel.splice(iHas, 1);
	        select[index].selected = false;
	    }
	}
	function OnClick2() {
	    var select = document.getElementById("select2");
	    var index = select.selectedIndex;
	    var iHas = -1; 
	    sel.sort();
	    for (var i = 0; i < sel.length; i++) {
	        if (sel[i] == index) {
	            iHas = i;
	        } else {
	            select[sel[i]].selected = true;
	        }
	    }
	    if (iHas == -1) {
	        sel.push(index);
	        select[index].selected = true;
	    } else {
	        sel.splice(iHas, 1);
	        select[index].selected = false;
	    }
	}
</script>
</head>
<body>
<div class="p5">
    <div class="position"><b>首页</b> - 客户资料导出</div>
	<table style="min-width:985px;width:100%;" cellspacing="0" class="toolbar">
		<tr>
			<td height="20"></td>
		</tr>
	</table>
    <form method="post" action="<?php echo site_url('manage/member_export2/crm/1');?>">
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                <tr>
                   <td>负责人</td>
                   <td>
                      <select name="sales_man" id="sales_man">
                           <option value="">全部</option>
                            <?php echo $this->user_list_model->get_user_id_option($search['sales_man'],$user_status=2);?>
                      </select>
                   </td>
                   <td>状态</td>
                      <td>
                        <select name="member_status" id="member_status">
							<option value="">所有</option>
                            <option value="S1-S5" <?php echo ($search['member_status']=="S1-S5")?"selected='selected'":"";?>>S1-S5</option>
                            <option value="S1-S4" <?php echo ($search['member_status']=="S1-S4")?"selected='selected'":"";?>>S1-S4</option>
                            <?php echo $this->member_params_model->get_parm_option('状态',$search['member_status']);?>
                        </select>
                    </td>
                    <td>来源</td>
                    <td rowspan=2>
							<select id="select1" name="member_from[]" multiple="multiple" onclick="OnClick();"  >
                                <?php echo $this->member_params_model->get_parm_option('来源', $search['member_from']); ?>
							</select>
                    </td>
                    <td colspan=2><input type="submit" value="按修改时间导出" /></td> 
                </tr>
                <tr>  
                    <td>开始时间</td>
                    <td><input type="text" name="time_start" value="<?php echo ($search['time_start'])?$search['time_start']:date('Y-m-d 00:00:00');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td>结束时间</td>
                    <td><input type="text" name="time_end" value="<?php echo ($search['time_end'])?$search['time_end']:date('Y-m-d 23:59:59');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </form>
    <form method="post" action="<?php echo site_url('manage/member_export2/bycreated/2');?>">
        <div class="searchbox" style="min-width:975px;">
            <table cellspacing="0">
                   <tr>
                   <td style="width:50px;">负责人</td>
                   <td>
                      <select name="sales_man" id="sales_man">
                           <option value="">全部</option>
                            <?php echo $this->user_list_model->get_user_id_option($search['sales_man'],$user_status=2);?>
                      </select>
                   </td>
                   <td>状态</td>
                      <td>
                        <select name="member_status" id="member_status">
							<option value="">所有</option>
                            <option value="S1-S5" <?php echo ($search['member_status']=="S1-S5")?"selected='selected'":"";?>>S1-S5</option>
                            <option value="S1-S4" <?php echo ($search['member_status']=="S1-S4")?"selected='selected'":"";?>>S1-S4</option>
                            <?php echo $this->member_params_model->get_parm_option('状态',$search['member_status']);?>
                        </select>
                    </td>
                    <td>来源</td>
                    <td rowspan=2>
							<select id="select2" name="member_from[]" multiple="multiple" onclick="OnClick2();" >
                                <?php echo $this->member_params_model->get_parm_option('来源', $search['member_from']); ?>
							</select>
                    </td>
                    <td colspan=2><input type="submit" value="按创建时间导出"/></td> 
                </tr>
                <tr>
                    <td>开始时间</td>
                    <td><input type="text" name="time_start" value="<?php echo ($search['time_start'])?$search['time_start']:date('Y-m-d 00:00:00');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <td>结束时间</td>
                    <td><input type="text" name="time_end" value="<?php echo ($search['time_end'])?$search['time_end']:date('Y-m-d 23:59:59');?>" onclick="WdatePicker({dateFmt:'yyyy-MM-dd HH:mm:ss'})" /></td>
                    <input type="hidden" name="created" value="1" />
                </tr>
            </table>
        </div>
    </form>
</div>
</body>
</html>