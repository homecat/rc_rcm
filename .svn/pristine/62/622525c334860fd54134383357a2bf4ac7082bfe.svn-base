<?php if (!defined('BASEPATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>目录菜单</title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet"/>
<script src="<?php echo base_url()?>assets/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo base_url()?>assets/js/script.js" type="text/javascript"></script>
<style type="text/css">html, body {height:100%;}</style>
<script type="text/javascript">
$(function(){
	$('#open_menus').click(function(){
		$('.expand').show();
		$('.min').hide();
		window.parent.frames['importantIframe'].cols = "192,*";
	});
	$('#hide_box').click(function(){
		$('.expand').hide();
		$('.min').show();
		window.parent.frames['importantIframe'].cols = "26,*";
	});
});
</script>
</head>
<body class="leftbox">
<div class="boxmid expand">
	<div class="menuboxs">
	<?php $num=0;foreach($manage_perms as $k=>$perms):?>
    <?php $dd = NULL; foreach($perms['list'] as $perm):if($perm['menus']):
          if($this->user_list_model->check_class($perm['value'],$user_perms)):
          $dd .= '<dd><a href="'.site_url($perms['folder'].'/'.$perm['value'][0]).'" target="mainFrame">'.$perm['title'].'</a></dd>';
          endif;endif;endforeach;if($dd):?>
        <dl class="menubox <?php if($num>0)echo'bdt';?>">
          <dt><?php echo $perms['title'];?></dt>
          <?php echo $dd;$num++;?>
        </dl>
    <?php endif;endforeach; ?>
    </div>
    <span id="hide_box" class="cp" style="position:absolute;top:0px;right:2px;display:block;width:14px;height:100%;"><<br /><</span>
</div>
<div class="boxbot expand"></div>
<div class="min_boxmid dn min">
	<table height="100%" width="100%">
    	<tr><td id="open_menus" valign="middle" align="center" class="cp">></td></tr>
    </table>
</div>
<div class="min_boxbot dn min"></div>
</body>
</html>
