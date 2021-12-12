

<head>
  <?php
  require_once('../private/initialize.php');
  include_once('header.php');
  $_SESSION['callback_url'] = 'citation.php';
  ?>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <?php
  include_once('topbar.php');
  ?>

  <!-- ======= Header ======= -->
  
  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Citation</li>
        </ol>
        <h2>Citation</h2>
      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Citation Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
        <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <h3>Bootstrap</h3>
              <p>Template Name: Eterna 
              <br>Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
              <br>Author: BootstrapMade.com
              <br>License: https://bootstrapmade.com/license/</p>
            </div>
          </div>

          <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <h3>DataBase</h3>
              <p>https://opendata.vancouver.ca/explore/dataset/public-art/information/
              <br>License: https://opendata.vancouver.ca/pages/licence/
              <br>Publisher: City of Vancouver</p>
            </div>
          </div>

          <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <h3>Other Resource (Tutorial for Ajax)</h3>
              <p>https://www.youtube.com/watch?v=JmnM-K1HPFE
              <br>https://www.webslesson.info/2018/08/how-to-make-product-filter-in-php-using-ajax.html
            </div>
          </div>

          <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <h3>IAT 352 Final Project</h3>
              <p>Instructors: Marek Hatala 
              <br>TA: Leo Ruan
              <br>Simon Fraser University
              <br>Fall 2021</p>
            </div>
          </div>

          <div class="row">
          <div class="col-lg-6">
            <div class="info-box mb-4">
              <h3>Team</h3>
              <p>Andrew Lin & Weijing Dong </p>
            </div>
          </div>

        </div>

      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

  <?php
  include_once('footer.php');
  ?>

  </footer><!-- End Footer -->


</body>

</html>