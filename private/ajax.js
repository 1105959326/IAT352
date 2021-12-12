$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var Type = get_filter('Type');
        var PrimaryMaterial = get_filter('PrimaryMaterial');
        var page = getUrlParam('page');
;
        
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, Type:Type, PrimaryMaterial:PrimaryMaterial, page:page},
            success:function(data){
                $('.filter_data').html(data);
            },
            error:function(data){
              alert('fail!');
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
    }


});