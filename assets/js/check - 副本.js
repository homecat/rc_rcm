jQuery.prototype.serializeObject=function(){  
    var a,o,h,i,e;  
    a=this.serializeArray();  
    o={};  
    h=o.hasOwnProperty;  
    for(i=0;i<a.length;i++){  
        e=a[i];  
        if(!h.call(o,e.name)){  
            o[e.name]=e.value;  
        }  
    }  
    return o;  
};

function checkAdd()
{
    var f = $('#add_memner_accounts').serializeObject();
    console.log(f.member_phone);
    if(f.member_qq || f.member_phone || f.member_weixin){
        $('.first_back_note').hide();
        if(!f.member_name || !f.member_status || !f.member_from || !f.channel || !f.member_info){
            $('.back_note').show();
            return false;
        }else{
            $('.back_note').hide();
            $.ajax({
                type:'post',
                dataType:'json',
                url: '/rc_rcm/index.php/manage/member_account/ajax',
                data:'member_qq='+f.member_qq+'&member_phone='+f.member_phone+'&member_weixin='+f.member_weixin,
                success:function(result) {
                    var sales = result.sales_info;
                    $.each(result,function(i, item){
                        if(item == 1100){
                            $('.' + i).html(" 已存在");
                            var sale = result.sales_info;
                            var  msg = ' 负责人:'+sale.name;
                            if(sale.real_account!=''&& sale.real_account!=null) msg+=' MT4:'+sale.real_account;
                            if(sale.updated!=''&& sale.updated!=null) msg+=' 更新时间:'+sale.updated;
                            //当只有创建时间无更新时间时，创建时间优先
                            if(sale.created!=''&& sale.created!=null && sale.updated ==null)msg+=' 创建时间:'+sale.created;
                            $('.member_info').html(msg);
                        }else if(item == 1000 || item == 0){
                            $('.'+ i).empty();
                        }else if(item == 'Enable'){
                           $('#add_memner_accounts').submit();
                        }
                    })
                  },
                error:function(){
                    alert('Access error');
                }
            });
            return false;
        }
    }else{
        $('.submit_back').empty();
        //$('#add_member_account_submit').attr('disabled','');
        $('.first_back_note').show();
        return false;
    }
}