//check_process
var check_process   = function( form_id ){
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
    //划分表单中的必填项和可选项
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
//检查是否为空
check_process.prototype.is_empty = function(){
    var status = true;
    $.each(this.m5, function(index, val){
        if('' == val.value) {
            $('.' + val.name).html('必填');
            status = false;
        }
        else  $('.' + val.name).empty();
    });
    var i = 0;
    $.each(this.m3, function(index, val){
        if('' == val.value) i++;
        else $('.' + val.name).empty();
        if(i == 3){
            $('.msg').html('qq/手机/微信必填一项');
            status = false;
        }
    });
    this.is_success = status;
    return this;
}
//检查是否为空
check_process.prototype.check = function(){
    var m3 = this.m3;
    for(var x in m3){
        if(m3[x].name.indexOf('member_qq') != -1) this.check_qq(m3[x].value);
        if(m3[x].name.indexOf('member_weixin') != -1) this.check_weixin(m3[x].value);
        if(m3[x].name.indexOf('member_phone') != -1) this.check_phone(m3[x].value);
    }
    return this;
}
// 在这里测试运行代码
function check(){
    var formname = 'add_member_accounts';
    var t = new check_process(formname);
    t.grouping().is_empty().check().submit(formname);
    return false;
};