<?php
require_once('../private/initialize.php');

$errors = [];


if(is_post_request()) {
  // TODO: Verify the password matches the record
  // if it does not, throw an error message
  // otherwise set the session and redirect to dashboard

  $content = [];
  if(!empty($_POST['new_password'])) {
    $content['password'] = password_hash($_POST['new_password'], PASSWORD_DEFAULT) ?? '';
  }else{
    $content['password'] = password_hash($_POST['password'], PASSWORD_DEFAULT) ?? '';
  }
  
  $content['FirstName'] = $_POST['fname'] ?? '';
  $content['LastName'] = $_POST['lname'] ?? '';
  $content['otherContact'] = $_POST['contact'] ?? '';
  
  


  if(!empty($_POST['password'])) {
    // Write a query to retrieve the hashed_password
    
    $user_query = "SELECT password FROM member WHERE userName = '" . $_SESSION['username'] . "'";
    $user_res = mysqli_query($db, $user_query);

    // If there is no record, then it should just display the error message
     //if(mysqli_num_rows($user_res) != 0) {
      // Save the hashed password from db into a variable
      
        $hashed_password = mysqli_fetch_assoc($user_res)['password'];
        //echo "1";

        // Use password verify to check if the entered password matches
        if(password_verify($_POST['password'], $hashed_password)) {

            $result = update_subject($content);
            if($result === true) {
                //echo "<a href='#'>The subject was updated successfully.</a>";
                //array_push($errors, "The subject was updated successfully.");
                $_SESSION['message'] = 'The subject was updated successfully.';
                header('Location: setting.php');
            } else {
                echo $result;
                $errors = $result;
    //var_dump($errors);
            }

        }else{
            array_push($errors, "Wrong Password. Please try again.");
        }
          //$update_query  = "UPDATE member SET FirstName = '". mysqli_real_escape_string($db, $_POST['fname'])."'";
          // Store session and redirect
        
        } else {
          // If verify fails, display an error message
          //echo("password wrong");
          array_push($errors, "Please enter password to complete update.");
        }
      }else{
          $content = find_subject_by_id($_SESSION['username']);
      } 
  //} else {
    //array_push($errors, "Username or password field is not filled.");
  //}

  // END TODO
//}

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
  //print_r($content);
  ?>

  <!-- ======= Header ======= -->
  

  <main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>My account</li>
        </ol>
        <h2>Update Information</h2>

      </div>
    </section><!-- End Breadcrumbs -->

    <!-- ======= Login Section ======= -->
    <section id="contact" class="contact">
      <div class="container">
      <?php 
      echo $_SESSION['message'];
      unset($_SESSION['message']);
      foreach($errors as $x => $value) {
        echo "<a href='#'>". $value . "</a>";
        echo "<br> <br>";
      }?>

        </div>

        <div class="row justify-content-center">

          <div class="col-lg-9 ">
            <form action="setting.php" method="post" class="php-email-form">
              <div class="row">
                <h5>Fill the information you want to update.<br>*Are required</h5>

                <div class="col-md-6 form-group">
                  <h4>First Name*</h4>
                  
                  <input type="text" class="form-control" name="fname" id="fname" value="<?php echo h($content['FirstName']); ?>" required/>
                </div>

                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <h4>Last Name*</h4>
                  <input type="text" class="form-control" name="lname" id="lname" value="<?php echo h($content['LastName']); ?>" required/>
                </div>

                <div class="form-group mt-3">
                  <h3>Password*</h3>
                  <input type="password" name="password" class="form-control" id="password" placeholder="Old Password" required>
                </div>

                <div class="form-group mt-3">
                  <h3>New Password</h3>
                  <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" >
                </div>

                <div class="form-group mt-3">
                  <h4>Other Contact</h4>
                  <input type="text" class="form-control" name="contact" id="contact" value="<?php echo h($content['otherContact']); ?>" />
                </div>

              </div>

        
              <div class="text-center">
                  <br>
                  <button type="submit">Update</button><br>
              </div>
            </form>
          </div>
<?php 
$userID = find_id_by_name($_SESSION['username']);
$res = queryFromFav($userID);
 echo "
          <div class=\"row\">
          <div class=\"col-lg-2\"> </div>
          <h2 class=\"col-lg-2\"> Favorite List</h2>
          <div class=\"col-lg-12\"> </div>";
while ($row = mysqli_fetch_assoc($res)){

  echo "
          <div class=\"col-lg-4\">
            <form method=\"post\" role=\"form\" class=\"php-email-form\">
              <div class=\"portfolio-info\">
              <h3>Project information</h3>
              <ul>
                <li><strong>Type</strong>: ".$row['Type']."</li>
                <li><strong>Site Name</strong>: ".$row['SiteName']."</li>
                <li><strong>Project date</strong>: ".$row['YearOfInstallation']."</li>
                <br>
                  <div class=\"text-center\"><a href=\"detail.php?varname=".$row['RegistryID']."\" style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\">More Information</a></div>
                  <br>
                  <div class=\"text-center\"><input style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\" type=\"submit\" name=\"remove\" value=\"Remove From Favorite\"></div>
              </ul>
            </div>
            </form>
          </div>";

  if (isset($_POST['remove'])){
    favDelete($row['RegistryID'], $userID);
    header('setting');
  }
          }
      echo "</div>";
?>
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