<?php require_once('header.php'); ?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
          <li>Detail</li>
        </ol>
        <h2>Detail</h2>

      </div>
    </section><!-- End Breadcrumbs -->

<?php
	require_once('../private/initialize.php');
	$id = $_GET['varname'];
    $res = queryAllbyID('artwork', $id);
    


	while ($row = mysqli_fetch_assoc($res)){
	
	echo "    <section id=\"portfolio-details\" class=\"portfolio-details\">
      <div class=\"container\">

        <div class=\"row gy-4\">

          <div class=\"col-lg-8\">
            <div class=\"portfolio-details-slider swiper\">
              <div class=\"swiper-wrapper align-items-center\">

                <div class=\"swiper-slide\">
                  <img src=\"".$row['PhotoURL']."\" alt=\"\">
                </div>

              </div>
              <div class=\"swiper-pagination\"></div>
            </div>
          </div>

          <div class=\"col-lg-4\">
            <div class=\"portfolio-info\">
              <h3>Project information</h3>
              <ul>
                <li><strong>Type</strong>: ".$row['Type']."</li>
                <li><strong>Site Name</strong>: ".$row['SiteName']."</li>
                <li><strong>Project date</strong>: ".$row['YearOfInstallation']."</li>

              </ul>
            </div>
            <div class=\"portfolio-description\">
              <h2>Artist Project Description</h2>
              <p>
                ".$row['ArtistProjectStatement']."
              </p>
              <h2>Description of Work</h2>
              <p>
                ".$row['DescriptionOfwork']."
              </p>
            </div>
          </div>

        </div>

          <div class=\"col-lg-6 \">
            <div class=\"info-box mb-4\">
              <h3>Our Address</h3>
            </div>";
        
    if ($row['Geom'] == null){
		echo "<Strong>Geometry Information not found</Strong>";
	}
	else{

	$start = strpos($row['Geom'], '[') + 1;
	$end = strpos($row['Geom'], ']');
	$between = substr($row['Geom'], $start, $end - $start);
	$pos = explode(",", $between);

	echo "<iframe class=\"mb-4 mb-lg-0\" src=\"https://www.google.com/maps/embed/v1/place?key=AIzaSyD-LdeoPQejHASho9UBQNvAlvPrBS6zwVM&q=".$pos[1].",".$pos[0]."\" frameborder=\"0\" style=\"border:0; width: 100%; height: 384px;\" allowfullscreen></iframe>";
	}

        echo "</div>

        <div class=\"col-lg-8\">
            <div class=\"portfolio-info\">
              <h3>Artist information</h3>
              <ul>
                <li><strong>Artist Name</strong>: ".$row['FirstN']." ".$row['LastN']."</li>
                <li><strong>Artist URL</strong>: <a href=\"#\">
                ".$row['ArtistURL']."</a></li>
              </ul>
            </div>
            <div class=\"portfolio-description\">
              <h2>Artist Project Description</h2>
              <p>
                ".$row['Biography']."
              </p>
            </div>
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->";
	}


require_once('../public/footer.php');
?>