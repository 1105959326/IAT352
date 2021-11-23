
<head>

  <!-- =======================================================
  * Template Name: Eterna - v4.6.0
  * Template URL: https://bootstrapmade.com/eterna-free-multipurpose-bootstrap-template/
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <?php
  include_once('header.php');
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
          <li>Sign In</li>
        </ol>
        <h2>Sign In</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Login Section ======= -->
    <section id="contact" class="contact">
      <div class="container">


        </div>

        <div class="row justify-content-center">

          <div class="col-lg-9 ">
            <form action="forms/contact.php" method="post" role="form" class="php-email-form">
              <div class="row">

                <div class="form-group mt-3">
                  <h3>User Name</h3>
                  <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
                </div>

                <div class="form-group mt-3">
                  <h3>Password</h3>
                  <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                </div>
              </div>

              <div class="my-3">
                <div class="loading">Loading</div>
                <div class="error-message"></div>
                <div class="sent-message">Your message has been sent. Thank you!</div>
              </div>
              <div class="text-center">
                  <button type="submit">Sign In</button><br>
                  <a href="registration.php">Don't have an account yet?</a><br>
                  <a href="registration.php">Forgot Password</a>
              </div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

  <?php
  include_once('footer.php');
  ?>

  </footer><!-- End Footer -->

  

</body>

</html>