<?php
require_once('../private/initialize.php');

$errors = [];

// TODO: This page should not show if a session is present.
// Redirect to staff index if a session is detected.
if(isset($_SESSION['username'])) {
    //redirect_to(url_for('/staff/index.php'));
    header('Location: index.php');
    exit();
}

if(is_post_request()) {
  // TODO: Verify the password matches the record
  // if it does not, throw an error message
  // otherwise set the session and redirect to dashboard
  if(!empty($_POST['username']) && !empty($_POST['password'])) {
    // Write a query to retrieve the hashed_password
    $user_query = "SELECT password FROM member WHERE userName = '" . $_POST['username'] . "'";
    $user_res = mysqli_query($db, $user_query);

    // If there is no record, then it should just display the error message
     if(mysqli_num_rows($user_res) != 0) {
      // Save the hashed password from db into a variable
      
        $hashed_password = mysqli_fetch_assoc($user_res)['password'];

        // Use password verify to check if the entered password matches
        if(password_verify($_POST['password'], $hashed_password)) {
          //echo("loged in");

          // Store session and redirect
          $_SESSION['username'] = $_POST['username'];

          $callback_url = "index.php";
          if(isset($_SESSION['callback_url'])){
            $callback_url = $_SESSION['callback_url'];
            $_SESSION['callback_url'] = [];
          }
          
          header('Location:'. $callback_url);
        } else {
          // If verify fails, display an error message
          //echo("password wrong");
          array_push($errors, "Wrong Password. Please try again.");
        }
      } else  {
        array_push($errors, "The account does not exist. Plesae check username.");
      }
  } else {
    array_push($errors, "Username or password field is not filled.");
  }

  // END TODO
}

?>

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
      <?php 
      foreach($errors as $x => $value) {
        echo "<a href='#'>". $value . "</a>";
        echo "<br> <br>";
      }?>

        </div>

        <div class="row justify-content-center">

          <div class="col-lg-9 ">
            <form action="login.php" method="post" class="php-email-form">
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