<?php
require_once('../private/initialize.php');
require_SSL();
$errors = [];

// Redirect to home index if a session is detected.
if(isset($_SESSION['username'])) {
    header('Location: index.php');
    exit();
}

if(is_post_request()) {

  // Check password match two times input
  if($_POST['password'] === $_POST['conpassword']) {
    
    // If password matches, check for existing user
    $existing_query = "SELECT COUNT(*) as count FROM member WHERE username = '" . $_POST['username'] . "'";
    $existing_res = mysqli_query($db, $existing_query);

    // If the count is not 0, that means an account with the same username already exists
    if(mysqli_fetch_assoc($existing_res)['count'] != 0) {
      array_push($errors, 'The username has been used, please try another username instead.');
    } else {
      // Else encrpyt the password
      $hashed_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      //insert in data base
      $insert_user_query = "INSERT INTO member(userName, email, password, FirstName, LastName, otherContact) VALUES (
                            '" . mysqli_real_escape_string($db, $_POST['username'])  . "',
                            '" . mysqli_real_escape_string($db, $_POST['email']) . "',
                            '" . mysqli_real_escape_string($db, $hashed_password) . "',
                            '" . mysqli_real_escape_string($db, $_POST['fname']) . "',
                            '" . mysqli_real_escape_string($db, $_POST['lname']) . "',
                            '" . mysqli_real_escape_string($db, $_POST['contact']) . "')";

      if(mysqli_query($db, $insert_user_query)) {
        // INSERT is successful, save a session then redirect to index
        $_SESSION['username'] = $_POST['username'];
        header('Location: index.php');
      } else {
        // Display the mysql error if failed
        array_push($errors, mysqli_error($db));
      }
    }
  } else {
    array_push($errors, 'Two passwords do not match, please try again.');
  }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>
  <title>Registration</title>
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
          <li>Registration</li>
        </ol>
        <h2>Registration</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Login Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
          
      <?php 
      foreach($errors as $x => $value) {
        echo "<a href='#'>". $value . "</a>";
        echo "<br> <br>";
      }
      ?>

      </div>

      <div class="row justify-content-center">

        <div class="col-lg-6 ">
          <form action="registration.php" method="post" role="form" class="php-email-form">
            <div class="row">
              <div class="col-md-6 form-group">
                <h4>First Name</h4>
                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" required>
              </div>

              <div class="col-md-6 form-group mt-3 mt-md-0">
                <h4>Last Name</h4>
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" required>
              </div>

              <div class="form-group mt-3">
                <h4>User Name</h4>
                <input type="text" name="username" class="form-control" id="username" placeholder="User Name" required>
              </div>

              <div class="form-group mt-3">
                <h4>Password</h4>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" required>
              </div>

              <div class="form-group mt-3">
                <h4>Confirm Password</h4>
                <input type="password" class="form-control" name="conpassword" id="conpassword" placeholder="Confirm Password" required>
              </div>

              <div class="form-group mt-3">
                <h4>Email</h4>
                <input type="email" class="form-control" name="email" id="email" placeholder="****@***.com" required>
              </div>

              <div class="form-group mt-3">
                <h4>Other Contact</h4>
                <input type="text" class="form-control" name="contact" id="contact" placeholder="other contact information" required>
              </div>
            </div>
            
            <div class="text-center">
              <br>
                <button type="submit">Registrate</button><br>
                <a href="login.php">Already have an account?</a><br>
            </div>
          </form>
        </div>
      </div>
    </section><!-- End Registrate Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer">

  <?php
  include_once('footer.php');
  ?>

  </footer><!-- End Footer -->

  

</body>

</html>