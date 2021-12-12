<?php 
//initialize the page
require_once('../private/initialize.php');
require_once('header.php'); 
//callback function
$_SESSION['callback_url'] = 'gallery.php';
no_SSL();
//get Page number
 $page=$_GET['page'];
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
  </section>
    <!-- End Breadcrumbs -->

    <!-- ======= Checkbox ======= -->
  <section>
    <div class="container"> 
      <div class = "row gy-4">                 
        <div class="col-lg-2">
          <div class="list-group">
            <h3>Type</h3>

            <?php
            //read all type and display as checkbox
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
            //read all primary material and display as checkbox
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
            <br/>
            <div class="row filter_data">
            </div>
          </section>
        </div>
      </div>
    </div>
  </section>


 <!-- AJAX Code for gallery -->
  <script src="../private/ajax.js"></script>

<footer id="footer">
    
    <?php
    include_once('footer.php');
    ?>
  
    </footer><!-- End Footer -->
</body>

</html>

