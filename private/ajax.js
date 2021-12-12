$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        //setup ajax
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var Type = get_filter('Type');
        var PrimaryMaterial = get_filter('PrimaryMaterial');
        var page = getUrlParam('page');
;
        //connect to fetch data file
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
    //filter function
    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }
    //call filter fucntion when click
    $('.common_selector').click(function(){
        filter_data();
    });
    //create function to read parameter from url
    function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); 
            var r = window.location.search.substr(1).match(reg);  
            if (r != null) return unescape(r[2]); return null;
    }


});