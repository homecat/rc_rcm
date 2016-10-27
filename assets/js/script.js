$(function(){
	
	
	// 全局左边菜单
	$('.menubox dt').toggle(
		function(){ $(this).addClass('show').siblings('dd').show();},
		function(){ $(this).removeClass('show').siblings('dd').hide();}	
	);
	$('.menubox dd').click(function(){ 
		$('.menubox dd').removeClass('on');
		$(this).addClass('on'); 
	}); 
	
	
	// 删除数据提示信息
	$("a.btn.del").click(function(){
		if(confirm('确认删除!')){
			window.location.href = $(this).attr("href");
		}
		return false;
	});
	
	
	
	// 全选操作
	$("input[name='all']").click(function(){
		if($(this).attr("checked")){
			$("input.ids").attr("checked",'true');//全选
		}else{
			$("input.ids").removeAttr("checked");//取消全选  
		}
	});
	$("input.ids").click(function(){
		$("input[name='all']").removeAttr("checked");
	});
	
	
	// 提交后按钮失效
	$("#submitOnce").click(function(){
		$(this).attr('disabled',true);
		$(this).parents('form').submit();
		return false;
	});
	
	
	
	// 资金管理 - 取款记录批辖 | 金额调整记录批辖
	$("input.btn_audit, input.btn_cancel").click(function(){
		$(this).attr("disabled",true).val($(this).val()+"...");
		$("form.form_audit_cancel").attr("action",$(this).attr("rel"));
		$("form.form_audit_cancel").submit();
	});
	

	// 资金管理 - 赠金记录到期
	$("#credit_expires").click(function(){
		$(this).attr("disabled",true).val($(this).val()+"...");
		$("#credit_expires_form").submit();
	});
	
	
	
	
	
	// 系统管理 - 用户管理 - 修改页面
	$("#user_edit_pwd").val(null);
	
	
})


