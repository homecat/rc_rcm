var check_process   = function( form_id ){
//    var p = inheritObject(Account.prototype);
//    p.constructor
    Account.call( this, form_id );
    this.references = ['member_qq','member_phone','member_weixin'];
    this.one_thems   = []; //可选其一项
    var requireds   = 'requires'; //必填项
    this.msg         = []; //规则提示
};
//继承Account
check_process.prototype = new Account();
//分离可选/必填
check_process.prototype.grouping = function(){
    var m5  = this.get_form_data();
    var m3 = [];
    var s  = this.references;
    //划分表单中的必填项和其它项
    for(var i in m5){
        for(var j in s){
            if( m5[i].name.indexOf( s[j] ) != -1 ){
                m3.push({
                    name:m5[i].name,
                    value:m5[i].value
                });
                m5.splice(i, 1);
            }
        }
    }
    return m3;// m5 m3 这里的值需要共享出来？
}

//显示错误提示
check_process.prototype.show_msg = function(class_name, msg){
    $('.'+ class_name).html(msg);
}

check_process.prototype.one_thems_fn = function(){
    //计算QQ/手机/微信...，有多少个是否被填写
    var error_msg = ' qq,手机,微信,必填其一';
    var m3 = this.grouping();
    //合计
    var m3_total_num = m3.length;
    for(var k in m3){
        if(m3[k].value == '') {
            m3_total_num--;
        }else{
            //手机验证判断
            if(m3[k].name.indexOf('member_phone') != -1) {
                var msg = this.check_phone(m3[k].value);
                //如果有错误信息则显示出来
                if(msg != '')$('.' + m3[k].name).html(msg);
            }else{
                //如被纠正填入资料，则清理掉前次的错误信息
                $('.'+m3[k].name).empty();
            }
            //qq验证判断
            if(m3[k].name.indexOf('member_qq') != -1) {
                var msg = this.check_qq(m3[k].value);
                if(msg != '') $('.'+m3[k].name).html(msg);
            }else{
                $('.'+m3[k].name).empty();
            }
        }
    }
    if( m3_total_num == 0){
        this.show_msg( 'msg', ' qq,手机,微信,必填其一' );
    }else $('.msg').empty();
}
// 在这里测试运行代码
function check(){
    var t = new check_process('add_member_accounts');
    console.log(t.one_thems_fn(t.grouping()));
    /*
    //计算name/status/channel/from/info是否填写
    var m5_total_num = m5.length;
    for(var t in m5){
        if(m5[t].value == ''){
            $('.'+m5[t].name).html('必填');
            m5_total_num--;
            add_status = false;
        }else{
            $('.'+m5[t].name).empty();
        }
    }
    //调试
//    console.log(m3);
//    console.log(m5);
    //是否提交表单
    console.log(m5_total_num);
    if( m5_total_num + m3_total_num >= m5.length + 1 ) add_status = true;
    else add_status = false;

    */
    return false;
};
