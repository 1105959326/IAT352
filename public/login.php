<?php
require_once('../private/initialize.php');
//https secure login
require_SSL();
$errors = [];

// Redirect to home page if user is login(find session).
if(isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if(is_post_request()) {
  if(!empty($_POST['username']) && !empty($_POST['password'])) {
    // The query to retrieve the hashed_password
    $user_query = "SELECT password FROM member WHERE userName = '" . $_POST['username'] . "'";
    $user_res = mysqli_query($db, $user_query);

    if(mysqli_num_rows($user_res) != 0) {
      // Save the hashed password from db into a variable
      
      $hashed_password = mysqli_fetch_assoc($user_res)['password'];

      // Use password verify to check if the entered password matches
      if(password_verify($_POST['password'], $hashed_password)) {

        // Store username session 
        $_SESSION['username'] = $_POST['username'];

        //check if has callback and redirect
        $callback_url = "index.php";
        if(isset($_SESSION['callback_url'])){
          $callback_url = $_SESSION['callback_url'];
          $_SESSION['callback_url'] = [];
        }
          
        header('Location:'. $callback_url);
        } else {
          // If verify fails, display an error message
          array_push($errors, "Wrong Password. Please try again.");
        }
    } else {
      array_push($errors, "The account does not exist. Plesae check username.");
    }
  } else {
    array_push($errors, "Username or password field is not filled.");
  }
}

?>

<head>
  <?php
  include_once('header.php');
  ?>
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <?php
  include_once('topbar.php');
  ?>

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
                <br>
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