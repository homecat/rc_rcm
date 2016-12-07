//基本类
var Account = function( form_id ){
    this.form_id = form_id;
    this.is_success = true;
    this.ms = [];
};
Account.prototype = {
    //根据ID取得表单数据key=val串
    get_form_data:function(){
        this.ms = $('#' + this.form_id).serializeArray();
        return this;
    },
    //显示已存在qq/phone/weixin关联信息,
    show_exists_info:function( id, msg ){
        var tmp_msg = '';
        if(msg){
            $('.' + id).html('已存在');
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
    //定义QQ是否全部为数字
    check_format_qq:function(qq){
        if(qq){
            var msg;
            var myreg = /(\d)$/;
            if (!myreg.test(qq)) {
                this.is_success = false;
                $('.member_qq').html('无效');
            }else $('.member_qq').empty();
        }
        return this;
    },
    //定义手机的格式和前三位是否正常    
    check_format_phone:function(phone){
        if(phone){
            var msg;
            var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-3]{1})|(18[5-9]{1}))+\d{8})$/;
            if (phone.length != 11){
                this.is_success = false;
                $('.member_phone').html('位数不对');
            }
            else if ( !myreg.test(phone)) {
                this.is_success = false;
                $('.member_phone').html('无效');
            }else $('.member_phone').empty();
        }
        return this;

    },

    check_qq_exists:function(qq) {
        var number = qq;
        if(number){
            var qq1 = this.check_db('member_qq', number );
            var qq2 = this.check_db('member_qq2', number );
            if(qq1) this.show_exists_info('member_qq', qq1);
            else this.show_exists_info('member_qq', qq2);
        }
        return this;
    },
    check_weixin_exists:function(weixin) {
        if(weixin){
            var msg = this.check_db('member_weixin', weixin );
            if(msg){
                this.show_exists_info('member_weixin', msg);
            }else $('.member_weixin').empty();
        }
        return this;
    },
    check_phone_exists:function(phone) {
        var number = phone;
        if(number){
            var phone1 = this.check_db('member_phone', number);
            var phone2 = this.check_db('member_phone2', number );
            if(phone1) this.show_exists_info('member_phone', phone1);
            else this.show_exists_info('member_qq', phone2);
        }
        return this;
    },
    //common method
    check_db:function( key, val ) {
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
    },
    submit:function(form_id) {
        if(this.is_success) console.log('保存');
        if(this.is_success) $('#'+form_id).submit();
    }
}