<?php 
require_once('../private/initialize.php');
include_once('header.php'); ?>

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
              <li data-filter=".filter-app">App</li>
              <li data-filter=".filter-card">Card</li>
              <li data-filter=".filter-web">Web</li>
            </ul>
          </div>
        </div>

        <div class="row portfolio-container">


        <?php
        
    		$res = queryAll('artwork');
    		while ($row = mysqli_fetch_assoc($res)){

    		    echo "<div class=\"col-lg-4 col-md-6 portfolio-item filter-app\">";
    		    echo "<div class=\"portfolio-wrap\" >";
    		    echo "<img src=" .$row['PhotoURL']. "  class=\"img-fluid\" style=\"margin-left:auto;margin-right:auto;width:100%;height:100%\">";
    		    echo "<div class=\"portfolio-info\">";
                    if ($row['SiteName']!= null) echo "<h4>" .$row['SiteName']. "</h4>";
                    else echo "<h4>Untitled</h4>";
                    echo "<p>App</p>
                    <div class=\"portfolio-links\">
                      <a href=\"assets/img/portfolio/portfolio-1.jpg\" data-gallery=\"portfolioGallery\" class=\"portfolio-lightbox\" title=\"App 1\"><i class=\"bx bx-plus\"></i></a>

                      <a href=\"detail.php?varname=".$row['RegistryID']."\" title=\"More Details\"><i class=\"bx bx-link\"></i></a>

                      
                    </div>
                  </div>
                </div>
              </div>";

    		    }

          ?>


