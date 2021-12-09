<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
$_SESSION['callback_url'] = 'gallery.php';
no_SSL();
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
       
             <section id="portfolio" class="portfolio">
      <div class="container">
              <br />
                <div class="row filter_data">
                </div>
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
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, Type:Type},
            success:function(data){
                $('.filter_data').html(data);
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


});

</script>

</body>

</html>

