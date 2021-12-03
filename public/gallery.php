<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
$_SESSION['callback_url'] = 'gallery.php';
no_SSL();
?>

<main id="main">

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

        <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <li data-filter="*" class="filter-active">All</li>
              <li data-filter=".filter-app">Material</li>
              <li data-filter=".filter-card">Artist</li>
              <li data-filter=".filter-web">Date</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">


        <?php
        
    		$res = queryAll('artwork');
    		while ($row = mysqli_fetch_assoc($res)){

    		    echo "<div class=\"col-lg-4 col-md-6 portfolio-item filter-app\">";
    		    echo "<div class=\"portfolio-wrap\" >";
    		    echo "<img src=" .$row['PhotoURL']. "   height = \"400\" style=\"margin-left:auto;margin-right:auto;\">";
    		    echo "<div class=\"portfolio-info\">";
                    if ($row['SiteName']!= null) echo "<h4>" .$row['SiteName']. "</h4>";
                    else echo "<h4>Untitled</h4>";
                    
                    if ($row['artistID']!= null) echo "<p style=\"text-transform:capitalize;\">" .$row['FirstN']." ". $row['LastN']. "</p>";
                    else echo "<p>Unknow artist</p>";

                    if ($row['YearOfInstallation']!= null) echo "<p>" .$row['YearOfInstallation']."</p>";
                    else echo "<p>Unknow Date</p>";

                    echo "
                    <div class=\"portfolio-links\">
                      <a href=\"detail.php?varname=".$row['RegistryID']."\" title=\"More Details\"><i class=\"bx bx-link\"></i></a>
                      
                    </div>

                  </div>
                </div>
              </div>";

    		    }

          ?>


