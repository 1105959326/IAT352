<?php
  require_once('../private/initialize.php');
  include_once('header.php');
  $_SESSION['callback_url'] = 'index.php';
  no_SSL();
?>

<body>

  <!-- ======= Top Bar ======= -->
  <?php
  include_once('topbar.php');
  ?>

  <!-- ======= Banner Section ======= -->
  <section id="hero">
    <div class="hero-container">
      <div id="heroCarousel" data-bs-interval="5000" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
        <div class="carousel-inner" role="listbox">
          <div class="carousel-item active" style="background: url(../Eterna/assets/img/banner/1.jpg)">
            <div class="carousel-container">
              <div class="carousel-content">
                <h2 class="animate__animated animate__fadeInDown">Vancouver<span>Public Art</span></h2>
                <p class="animate__animated animate__fadeInUp">Check out the free public artwork now on display in downtown Vancouver. Log in to create your own favourite list.</p>
                <?php
                  if(isset($_SESSION['username'])) {
                  //check if user is login
                  //provide Setting and log out button 
              
                    echo "<a href='setting.php' class='btn-get-started animate__animated animate__fadeInU'>Setting: ".$_SESSION['username'] ?? '';
                    echo "</a><br>";
                    echo "<a href='logout.php' class='btn-get-started animate__animated animate__fadeInU'>Log out</a>";
                    
                  }else{
                    //provide login button
                    echo "<a href='login.php' class='btn-get-started animate__animated animate__fadeInU'>Sign in</a>";

                  }
                ?>
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section><!-- End Banner -->

  <main id="main">

    <section id="contact" class="contact">
      <div class="container">
        <br><br><br><br><br><br><br>
        <?php
        $rec_res = queryRecom();
        //query all recommand artwork

        echo "<div class=\"row\"></div>";
        echo "<h2 class=\"col-lg-2\"> Recommendation</h2>";
        echo "<div class=\"col-lg-12\"> </div><div class=\"row\"> ";


        while ($row = mysqli_fetch_assoc($rec_res)){
          //display recommandation part

          echo "
            <div class=\"col-lg-4\">
              <form method=\"post\" role=\"form\" class=\"php-email-form\">
                <div class=\"portfolio-info\">
                <h3>Artwork information</h3>
                <ul>
                  <li><strong>Type</strong>: ".$row['Type']."</li>
                  <li><strong>Site Name</strong>: ".$row['SiteName']."</li>
                  <li><strong>Project date</strong>: ".$row['YearOfInstallation']."</li>
                  <br>
                  <div class=\"text-center\"><a href=\"detail.php?varname=".$row['RegistryID']."\" style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\">More Information</a></div>
                    <br>";
                  
          echo "</ul>
              </form>
            </div>
          </div>";
        }

        echo "</div>";

        if (isset($_SESSION['username'])){
          $userID = find_id_by_name($_SESSION['username']);
          $fav_result = queryFromFav($userID);
          //query user's favourite list
          //diaplay favourite list

          echo "<h2 class=\"col-lg-2\"> Favorite List</h2>";
          echo "<div class=\"col-lg-12\"> </div><div class=\"row\"> ";
          while ($row = mysqli_fetch_assoc($fav_result)){

            echo "
                  <div class=\"col-lg-4\">
                    <form method=\"post\" role=\"form\" class=\"php-email-form\">
                      <div class=\"portfolio-info\">
                      <h3>Artwork information</h3>
                      <ul>
                        <li><strong>Type</strong>: ".$row['Type']."</li>
                        <li><strong>Site Name</strong>: ".$row['SiteName']."</li>
                        <li><strong>Project date</strong>: ".$row['YearOfInstallation']."</li>
                        <br>
                          <div class=\"text-center\"><a href=\"detail.php?varname=".$row['RegistryID']."\" style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\">More Information</a></div>
                          <br>";
                          if (isset($_SESSION['username'])) 
                          //remove button
                            echo "<div class=\"text-center\"><input style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\" type=\"submit\" name=\"remove\" value=\"Remove From Favorite\"></div>";
            echo "      </ul
                    </form>
                  </div>
                </div>";
        
          }
        }
        ?>
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