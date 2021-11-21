<?php


?>

<?php require_once('../Eterna/header.php'); ?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.html">Home</a></li>
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
        require_once('../private/initialize.php');
		$res = queryAll('artwork');
		while ($row = mysqli_fetch_assoc($res)){
		    echo "<div class=\"col-lg-4 col-md-6 portfolio-item filter-app\">";
		    echo "<div class=\"portfolio-wrap\">";
		    echo "<img src=\"assets/img/portfolio/portfolio-1.jpg\" class=\"img-fluid\">";

		    }

        ?>


