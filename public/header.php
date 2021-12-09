<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Vancouver Public Art</title>
  <meta content="" name="description">
  <meta content="" name="keywords">
  <script src="../js/jquery-1.10.2.min.js"></script>

<!--   <link href = "css/jquery-ui.css" rel = "stylesheet">
 -->
  <!-- Favicons -->
  <link href="../Eterna/assets/img/favicon.png" rel="icon">
  <link href="../Eterna/assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../Eterna/assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="../Eterna/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../Eterna/assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../Eterna/assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../Eterna/assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="../Eterna/assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="../Eterna/assets/css/style.css" rel="stylesheet"><header id="header" class="d-flex align-items-center">
    <div class="container d-flex justify-content-between align-items-center">

      <div class="logo">
        <h1><a href="index.php">Vancouver Public Art</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar">
        <ul>
          <li><a class="active" href="index.php">Home</a></li>
          <li><a href="gallery.php">Gallery</a></li>
          <li class="dropdown"><a href="#"><span>My account</span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              
              <!-- <li class="dropdown"><a href="#"><span>Deep Drop Down</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="#">Deep Drop Down 1</a></li>
                  <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li>
                </ul>
              </li> -->
              <?php
              if(isset($_SESSION['username'])) {
                //redirect_to(url_for('/staff/index.php'));
              
                echo "<li><a href='setting.php'> Setting: ". $_SESSION['username'] ?? ''."</a></li>";
                echo "<li><a href='logout.php'>Log Out</a></li>";
                //header('Location: index.php');
                //exit();
            }else{
              echo "<li><a href='login.php'>Login</a></li>";
              echo "<li><a href='registration.php'>Registration</a></li>";
            }
            ?>
              
              <!-- <li><a href="#">Drop Down 3</a></li>
              <li><a href="#">Drop Down 4</a></li> -->
            </ul>
          </li>
          <li><a href="citation.php">Citation</a></li>
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

    </div>
  </header><!-- End Header -->