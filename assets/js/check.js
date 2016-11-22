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

function check(){
    var f = $('#add_memner_accounts').serializeObject();
    var status = true;
    $.each(f,function(i, item){
        switch(i){
            case 'member_qq':
            case 'member_phone':
            case 'member_weixin':
                if(!f.member_qq && !f.member_phone && !f.member_weixin){
                    $('.msg').html('QQ,手机,微信必填其一');
                    status = false;
                }else{
                    if(item) {
                        if(i == 'member_qq'){
                            var res = vailQQ(item);
                            if(res)$('.' + i).html(res);
                            else $('.' + i).empty();
                        }

                        if(i == 'member_phone'){
                            var res = vailPhone(item);
                            if(res) $('.' + i).html(res);
                            else $('.' + i).empty();
                        }

                        $('.msg').empty();
                    }
                }
                break;
            case 'member_name':
            case 'member_info':
                if(!item){
                    $('.'+i).html('必填');
                    status = false;
                }else{
                    $('.'+i).empty();
                }
                break;
            case 'member_status':
            case 'member_from':
            case 'channel':
                if(!item){
                    $('.'+i).html('必选');
                    status = false;
                }else{
                    $('.'+i).empty();
                }
                break;
        };
    });
    return false;//status;
}

function vailPhone(phone) {
    var message = '';
    var myreg = /^(((13[0-9]{1})|(14[0-9]{1})|(17[0-9]{1})|(15[0-3]{1})|(15[5-9]{1})|(18[0-3]{1})|(18[5-9]{1}))+\d{8})$/;

    if (phone.length != 11) message = '位数不对';
    else if (!myreg.test(phone)) message = "无效";
    else if((msg = checkIsExist('member_phone', phone)) || (msg = checkIsExist('member_phone2', phone))) message = msg;
    return message;
}

function vailQQ(qq) {
    var message = '';
    var myreg = /(\d)$/;
    if (!myreg.test(qq)) message = "无效！";
    else if((msg = checkIsExist('member_qq', qq)) || (msg = checkIsExist('member_qq2', qq))) message = msg;
    return message;
}
//common method
function checkIsExist(key,val) {
    var flag = false;
    var data = 'key='+key+'&val='+val;
    jQuery.ajax({
        url: 'http://192.168.0.8/rc_rcm/index.php/manage/member_account/ajax',
        data: data,
        dataType: 'json',
        type: 'post',
        async: false,
        success: function(data) {
            flag = data.msg;
        }
    });
    return flag;
}