//基本类
var Account = function( form_id ){
    this.form_id = form_id;
    this.is_success = true;
};
Account.prototype = {
    //根据ID取得表单数据key=val串
    get_form_data:function(){
        return $('#' + this.form_id).serializeArray();
    },
    //显示已存在qq/phone/weixin关联信息,
    get_exists_info:function( id, msg ){
        var tmp_msg = '';
        if(msg){
            if(msg.exists)            $('.' + id).html(msg.exists);
            if(msg.sales_name)        tmp_msg += ' 负责人:'+ msg.sales_name + ' 日期:';
            if(msg.update_time)       tmp_msg += msg.update_time;
            else if(msg.create_time)  tmp_msg += msg.create_time;
            if(msg.real_account)      tmp_msg += ' mt4:' + msg.real_account;
            //由于msg信息比较多，被放在[描述]的后面
            this.is_success = false;
            $('.msg').html(tmp_msg);
        }
        return this;
    },
    check_qq:function(qq) {
        if(qq){
            var msg;
            var myreg = /(\d)$/;
            if (!myreg.test(qq)) {
                $('.member_qq').html('无效');
                this.is_success = false;
            }
            else if( (msg = this.check_is_exist('member_qq', qq )) ||  (msg = this.check_is_exist('member_qq2', qq ))) {
                this.get_exists_info('member_qq', msg);
                this.is_success = false;
            }
        }
        return this;
    },
    check_weixin:function(weixin) {
        if(weixin){
            var msg = '';
            msg = this.check_is_exist('member_weixin', weixin );
            if(msg) {
                this.get_exists_info('member_weixin', msg);
                this.is_success = false;
            }
        }
        return this;
    },
    check_phone:function(phone) {
        if(phone){
            var msg;
            var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-3]{1})|(18[5-9]{1}))+\d{8})$/;
            if (phone.length != 11)  {
                $('.member_phone').html('位数不对');
                this.is_success = false;
            }
            else if ( !myreg.test(phone)) {
                $('.member_phone').html('无效');
                this.is_success = false;
            }
            else if(( msg = this.check_is_exist( 'member_phone', phone )) || ( msg = this.check_is_exist('member_phone2', phone ))) this.get_exists_info('member_phone', msg);
            else $('.msg').empty();
        }
        return this;
    },
    //common method
    check_is_exist:function( key, val ) {
        var flag = false;
        var data = 'key=' + key + '&val=' + val;
        $.ajax({
            url: 'http://192.168.1.8/rc_rcm/index.php/manage/member_account/ajax',
            data: data,
            dataType: 'json',
            type: 'post',
            async: false,
            success: function( data ) {
                flag = data;
                if(null == flag) this.is_success = false;
            }
        });
        return flag;
    },
    submit:function(form_id) {
        console.log('submit->'+this.is_success);
        if(this.is_success) console.log('保存');
        if(this.is_success) $('#'+form_id).submit();
    }
}