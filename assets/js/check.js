//基本类

var Account = function( form_id ){
    this.form_id = form_id;
};
Account.prototype = {
    //根据ID取得表单数据key=val串
    get_form_data:function(){
        return $('#' + this.form_id).serializeArray();
    },
    //显示已存在qq/phone关联信息,由于msg信息比较多，被放在[描述]的后面 'class = msg'
    get_exists_info:function( id, msg ){
        var tmp_msg = '';
        $('.' + id).html('已存在');
        if(msg.info.sales_name) tmp_msg += ' 负责人:'+ msg.info.sales_name + ' 日期:';
        if(msg.info.update_time) tmp_msg += msg.info.update_time;
        else if(msg.info.create_time) tmp_msg += msg.info.create_time;
        if(msg.info.real_account)tmp_msg += ' mt4:' + msg.info.real_account;
        $('.msg').html(tmp_msg);
        return this;
    },
    check_phone:function( phone ) {
        var msg;
        var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-3]{1})|(18[5-9]{1}))+\d{8})$/;
        if (phone.length != 11)  $('member_phone').html('位数不对');
        else if ( !myreg.test( phone )) $('member_phone').html('无效');
        else if(( msg = this.check_is_exist( 'member_phone', phone )) || ( msg = this.check_is_exist('member_phone2', phone ))) this.get_exists_info('member_phone', msg);
        return this;
    },
    check_qq:function( qq ) {
        var msg;
        var myreg = /(\d)$/;
        if (!myreg.test( qq )) $('member_qq').html('无效');
        else if( (msg = this.check_is_exist('member_qq', qq )) ||  (msg = this.check_is_exist('member_qq2', qq ))) this.get_exists_info('member_qq', msg);
        return this;
    },
    check_weixin:function( weixin ) {
        var msg = '';
        msg = check_is_exist('member_weixin', weixin );
        this.get_exists_info(msg);
        return this;
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