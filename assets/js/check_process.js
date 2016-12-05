//check_process
var check_process   = function( form_id ){
    Account.call( this, form_id );
    this.references = ['member_qq','member_phone','member_weixin'];
    this.m3  = []; //可选其一项
    this.m5  = []; //必填项
    this.status = []; //规则提示
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
    var i = 0; 

    $.each(this.m5, function(index, val){
        if('' == val.value) {
            $('.' + val.name).html('必填');
            status = false;
        }
        else  $('.' + val.name).empty();
    });

var s = '';
    $.each(this.m3, function(index, val){
        if('' == val.value) {
            i++;
            s = val.name;
            $('.' + s).empty();
        }
        if(i == 3){
            $('.msg').html('qq/手机/微信必填一项');
            status = false;
        }
    });
    this.is_success = status;
    return this;
}

check_process.prototype.check = function(){
    var m3 = this.m3;
    if(this.is_empty()){
        $('.msg').empty();

        for(var x in m3){
            if(m3[x].name.indexOf('member_qq') != -1){
                var qq = m3[x].value;
                this.check_format_qq(qq).check_qq_exists(qq);
            }
            if(m3[x].name.indexOf('member_weixin') != -1) this.check_weixin_exists(m3[x].value);
            if(m3[x].name.indexOf('member_phone') != -1){
                var phone = m3[x].value;
                this.check_format_phone(phone).check_phone_exists(phone);
            }
        }
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