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
    var ms  = this.ms;
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
    for(var x in this.m5){
        if(''==this.m5[x].value){
            $('.' + this.m5[x].name).html('必填');
        }else{
            $('.' + this.m5[x].name).empty();
        }
    }

    var i = 0;
    for(var x in this.m3){
        if(''==this.m3[x].value){
            i++;
            $('.' + this.m3[x].name).empty();
        }
        if(i == 3){
            $('.msg').html('qq/手机/微信必填一项');
        }else{
            $('.msg').empty();
        }
    }
    return this;
}

//格式检查正则
check_process.prototype.check_format = function(){
    for(var x in this.m3){
        if('member_qq' == this.m3[x].name)    this.check_format_qq(this.m3[x].value);
        if('member_phone' == this.m3[x].name) this.check_format_phone(this.m3[x].value);
    }
    return this;
}

check_process.prototype.check_exists = function(){
    var m3 = this.m3;
    if(m3){
        for(var x in m3){
            if(m3[x].name.indexOf('member_qq') != -1)     this.check_qq_exists(m3[x].value);
            if(m3[x].name.indexOf('member_weixin') != -1) this.check_weixin_exists(m3[x].value);
            if(m3[x].name.indexOf('member_phone') != -1)  this.check_phone_exists(m3[x].value);
        }
    }else{
        $('.msg').empty();
    }

    return this;
}

function main(){
    var formname = 'add_member_accounts';
    var t = new check_process(formname);

    t.get_form_data().grouping().is_empty().check_format().check_exists();
    // t.grouping().is_empty().check().submit(formname);
    return false;
};