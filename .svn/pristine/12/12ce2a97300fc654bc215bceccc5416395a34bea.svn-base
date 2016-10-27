<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>assets/js/script.js"></script>
<script type="text/javascript">
function selectAll(){
    var ckList = document.from1.all;
    for(var i=0;i<ckList.length;i++){
         ckList[i].checked = true;
        }            
    }
function cancleAll(){
    var ckList = document.from1.all;
    for(var i=0;i<ckList.length;i++){
         ckList[i].checked = false;
        }
    }
function against(){
	var ckList = document.from1.all;
	    for(var i=0;i<ckList.length;i++){
              if(ckList[i].checked){
            	  ckList[i].checked = false;
                  }
              else{
            	  ckList[i].checked = true;
                  } 
		    }
}
</script>
</head>
<body>
<div class="p5">
  <div class="position"><b>首页</b> - 系统管理 - 用户管理</div>
  <div class="toolbar">
    <input type="button" value="返回" onclick="history.back()" />
  </div>
  <form method="post"  name="from1">
    <table width="100%" cellspacing="0" cellpadding="0">
      <tr class="titlelist">
        <td class="no">用户信息</td>
        <td width="50%">权限列表  
          <input type="button" value="全选" onclick="selectAll()"/>
          <input type="button" value="取消" onclick="cancleAll()"/>
          <input type="button" value="反选" onclick="against()"/>
          <input type="button" value="复位" onclick="reset()"/>
        </td>
      </tr>
      <tr valign="top">
        <td><table width="100%" cellspacing="0" cellpadding="5">
            <tbody class="itemlist">
              <tr>
                <td width="120">用户ID</td>
                <td><input type="text" disabled="disabled" value="<?php echo $row['user_id'];?>" size="39" /></td>
              </tr>
              <tr>
                <td>销售组/成员<span class="red">*</span></td>
                <td><select name="sales_id" class="sWidth">
                    <?php echo $this->member_sales_model->sales_option($row['sales_id']);?>
                  </select>
                  <?php echo form_error('sales_id');?></td>
              </tr>
              <tr>
                <td>用户级别<span class="red">*</span></td>
                <td><select name="user_limits" class="sWidth">
                	<?php foreach($list_limits as $limit=>$limit_name):?>
                    <option value="<?php echo $limit;?>" <?php echo set_select('user_limits',$limit,$row['user_limits']==$limit?TRUE:FALSE);?>>
					<?php echo $limit_name;?></option>
                    <?php endforeach;?>
                    </select>
                  <?php echo form_error('user_limits');?></td>
              </tr>
              <tr>
                <td width="120">用户名<span class="red">*</span></td>
                <td><input type="text" name="user_name" value="<?php echo set_value('user_name',$row['user_name']); ?>" size="39"/>
                  <?php echo form_error('user_name');?></td>
              </tr>
              <tr>
                <td>登录密码</td>
                <td><input id="user_edit_pwd" type="password" name="user_password" size="39"/>
                  <?php echo form_error('user_password'); ?></td>
              </tr>
              <tr>
                <td>确认密码</td>
                <td><input type="password" name="user_passwordf" size="39"/>
                  <?php echo form_error('user_passwordf'); ?></td>
              </tr>
              <tr>
                <td>用户描述</td>
                <td><input type="text" name="user_info" value="<?php echo set_value('user_info',$row['user_info']); ?>" size="39"/>
                  <?php echo form_error('user_info'); ?></td>
              </tr>
              <tr>
                <td>用户状态</td>
                <td><input type="radio" name="user_status" value="1" <?php echo set_radio('user_status',1,$row['user_status']==1?TRUE:FALSE);?> />停用
                  <input type="radio" name="user_status" value="2" <?php echo set_radio('user_status',2,$row['user_status']==2?TRUE:FALSE);?> />启用 
				  <?php echo form_error('user_status');?></td>
              </tr>
              <tr>
                <td></td>
                <td><input type="submit" value="提交" /></td>
              </tr>
            </tbody>
          </table></td>
        <td><table width="100%" cellspacing="0" cellpadding="0">
            <tbody class="itemlist">
              <tr>
                <td><?php $row_perms = (array)json_decode($row['user_permissions'],TRUE);
					foreach($manage_perms as $pers):?>
                      <fieldset>
                        <legend><?php echo $pers['title'];?></legend>
                        <?php foreach($pers['list'] as $item): if(in_array($item['value'],$row_perms) || $manage_limits==1):?>
                            <span class="fl db mr10"><input type="checkbox" name="user_manage[]" id="all"  value='<?php echo json_encode($item['value']);?>' 
                            <?php if(in_array($item['value'],$row_perms)) echo 'checked="checked"';?>/><?php echo $item['title'];?></span>
                        <?php endif;endforeach;?>
                      </fieldset>
                  <?php endforeach;?></td>
              </tr>
            </tbody>
          </table></td>
      </tr>
    </table>
  </form>
  <div class="selectbar"></div>
</div>
</body>
</html>
