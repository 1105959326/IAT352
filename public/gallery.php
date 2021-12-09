<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
$_SESSION['callback_url'] = 'gallery.php';
no_SSL();

 $page=$_GET['page'];
// if($page==null){
//   echo "cant get".$page;
//   $page=1;
// }else{
//   echo "alread get" . $page;
// }
?>


<body>
    <!-- Page Content -->
    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Gallery</li>
        </ol>
        <h2>Gallery</h2>

      </div>
    </section><!-- End Breadcrumbs -->
    <div class="container"> 
      <div class = "row gy-4">                 
        <div class="col-lg-2">
          <div class="list-group">
            <h3>Type</h3>
                      <?php
                      $res = find_type();
                        while ($row = mysqli_fetch_assoc($res)){
                      ?>
                      <div class="list-group-item checkbox">
                          <label><input type="checkbox" class="common_selector Type" value="<?php echo $row['Type']; ?>" > <?php echo $row['Type']; ?></label>
                      </div>
                      <?php    
                      }

                      ?>
                  </div>

          <div class="list-group">
            <h3>Primary Material</h3>
                      <?php
                      $res = findMaterial();
                        while ($row = mysqli_fetch_assoc($res)){
                      ?>
                      <div class="list-group-item checkbox">
                          <label><input type="checkbox" class="common_selector PrimaryMaterial" value="<?php echo $row['PrimaryMaterial']; ?>" > <?php echo $row['PrimaryMaterial']; ?></label>
                      </div>
                      <?php    
                      }

                      ?>
                  </div>
        </div>
             

      <div class="col-lg-10">
        <section id="portfolio" class="portfolio">
              <br />
                <div class="row filter_data">
                </div>
              </section>
    </div>
  </div>
</div>



<script>
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
        //var Page = $_GET['page'];
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, Type:Type, PrimaryMaterial:PrimaryMaterial, page:page},
            //data:{action:action, Type:Type, PrimaryMaterial:PrimaryMaterial},
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

</script>

<footer id="footer">
    
    <?php
    include_once('footer.php');
    ?>
  
    </footer><!-- End Footer -->
</body>

</html>

