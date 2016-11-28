//基本类

var Account = function( form_id ){
    this.form_id = form_id;
};
Account.prototype = {
    //根据ID取得表单数据key=val串
    get_form_data:function(){
        return $('#' + this.form_id).serializeArray();
    },
    //显示已存在qq/phone关联信息
    get_exists_info:function( id ){
        var info = '';
        if(this.sales_man)         info += this.sales_man;
        if(this.real_account)      info += this.real_account;
        if(this.create_time)       info += this.create_time;
        else if(this.update_time) info += this.update_time;
        return info;
    },
    check_phone:function( phone ) {
        var msg = '',message = '';
        var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-3]{1})|(18[5-9]{1}))+\d{8})$/;
        if (phone.length != 11) msg = '位数不对';
        else if ( !myreg.test( phone )) msg = "无效";
        else if(( message = this.check_is_exist( 'member_phone', phone )) || ( message = this.check_is_exist('member_phone2', phone ))) message = msg;
        return msg;
    },
    check_qq:function( qq ) {
        var msg = '';
        var myreg = /(\d)$/;
        if (!myreg.test( qq )) msg = "无效！";
        else if(( msg = this.check_is_exist('member_qq', qq )) || ( msg = this.check_is_exist('member_qq2', qq ))) return msg;
        return msg;
    },
    //common method
    check_is_exist:function( key, val ) {
        var flag = false;
        var data = 'key=' + key + '&val=' + val;
        $.ajax({
            url: 'http://192.168.0.8/rc_rcm/index.php/manage/member_account/ajax',
            data: data,
            dataType: 'json',
            type: 'post',
            async: false,
            success: function( data ) {
                flag = data;
            }
        });
        return flag;
    }
}