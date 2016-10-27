<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>文本编辑</title>
<link href="<?php echo base_url()?>assets/css/manage/style.css" type="text/css" rel="stylesheet" />
<script type="text/javascript" src="<?php echo base_url()?>/assets/kindeditor/kindeditor.js"></script>
	<script type="text/javascript">
	  var editor;//编辑器
	  KindEditor.ready(function(e){
    	  editor = e.create("[name=content]",{
    		 "width":"560px",
    		 "height":"200px",
    	     "items":["source","undo","redo","|","bold","italic","underline"]
    	  });
      });
	</script>
</head>
<body>
<div class="p5">
<div class="position"><b>首页</b> - 文本管理 - 文本编辑</div>
<div class="toolbar"><input type="button" value="返回" onclick="history.back()" /></div>
  <form action="<?php echo site_url('manage/memo/save')?>" method="post">
    <table>
         <?php foreach($result as $item):?>
          <tr>
              <td>标题</td>
              <td><input type="test" name="title" value="<?php echo $item['title']?>" style="width:200px;"/></td>
                 <input type="hidden" name="id" value="<?php echo $item['id']?>"/>
          </tr>
          <tr>
              <td>内容</td>
              <td><textarea name="content" ><?php echo $item['content']?></textarea></div></td>
          </tr>
          <tr>
                <td></td>
               <td><input type="submit" value="确定"/>     
                   <?php if(!empty($_POST)):?>
	                    <span style="color:red">标题/内容不能为空</span>
	               <?php endif;?></td>
          </tr>
          <?php endforeach;?>
    </table>  
  </form>
</div>
</body>
</html>