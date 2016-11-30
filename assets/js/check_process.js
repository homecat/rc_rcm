var check_process   = function( form_id ){
//    var p = inheritObject(Account.prototype);
//    p.constructor
    Account.call( this, form_id );
    this.references = ['member_qq','member_phone','member_weixin'];
    this.m3  = []; //可选其一项
    this.m5  = []; //必填项
    this.msg = []; //规则提示
};
//继承Account
check_process.prototype = new Account();
//分离可选/必填
check_process.prototype.grouping = function(){
    var ms  = this.get_form_data();
    var r = this.references;
    //划分表单中的必填项和其它项
    for(var i in ms){
        for(var j in r){
            if( ms[i].name.indexOf( r[j] ) != -1 ){
                this.m3.push({
                    name:ms[i].name,
                    value:ms[i].value
                });
                ms.splice(i, 1);
            }
        }
    }
    this.m5 = ms;
    return this;
}

check_process.prototype.is_empty = function(){
    $.each(this.m5, function(index, val){
        if('' == val.value){
            $('.' + val.name).html('必填');
        }else{
            $('.' + val.name).empty();
        }
    });
    var i = 0;
    $.each(this.m3, function(index, val){
        if('' == val.value){
            i++;
        }else{
            $('.' + val.name).empty();
        }
        if(i == (this.references.size = function(){
            var n, count = 0;
            for(n in this){
                if(this.hasOwnProperty(n)){
                    count++;
                }
            }
            console.log(count);
            return count;
        })){
            $('.msg').html('qq/手机/微信必填一项');
        }
    });
    return this;
}
check_process.prototype.one_thems_fn = function(){
    //计算QQ/手机/微信...，有多少个是否被填写
    var msg_qq = '', msg_weixin = '', msg_phone;
    var m3 = this.grouping();
    //合计
    var m3_total_num = m3.length;
    for(var k in m3){
        if(m3[k].value == '') {
            //清空历史msg
            $('.'+m3[k].name).empty();
            $('.msg').empty();
            m3_total_num--;
            if( m3_total_num == 0)  $( '.msg').html( ' qq,手机,微信,必填其一' );
        }else{
            if(m3[k].name.indexOf('member_qq') != -1) {
                var s = this.check_qq(m3[k].value);
                console.log(s);
            }
            if(m3[k].name.indexOf('member_phone') != -1) {
                this.check_phone(m3[k].value);
            }


/*
           //qq验证判断
           if(m3[k].name.indexOf('member_qq') != -1) {
               msg_qq = this.check_qq(m3[k].value);
               if(msg_qq){
                   $('.member_qq').html(msg_qq);
                   //如果手机号不在DB中，就显示QQDB的相关资料
                    if(msg_qq.msg) {
                        $('.member_qq').html('已存在');
                        this.get_exists_info( msg_qq );
                    }
               }
            }
            //weixin验证判断
           if(m3[k].name.indexOf('member_weixin') != -1) {
                msg_weixin = this.check_weixin(m3[k].value);
                if(msg_weixin){
                    $('.member_weixin').html('已存在');
                    if(msg_weixin.msg) this.get_exists_info(member_weixin);
                }
            }
            //手机验证判断
           if(m3[k].name.indexOf('member_phone') != -1) {
                msg_phone = this.check_phone(m3[k].value);
                if(msg_phone){
                    $('.member_phone').html('已存在');
                    if(msg_phone.msg) this.get_exists_info(msg_phone);
                }
            }
            */

            //DB中存在就不能通过
            if(msg_phone || msg_qq || msg_weixin) return false;


        }
    }
}
// 在这里测试运行代码
function check(){
    var t = new check_process('add_member_accounts');
    t.grouping().is_empty();
    return false;
};
