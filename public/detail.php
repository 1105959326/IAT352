<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
no_SSL();?>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Detail</li>
        </ol>
        <h2>Detail</h2>

      </div>
    </section><!-- End Breadcrumbs -->

<?php

  
  $id = $_GET['varname'];
  $res = queryAllbyID('artwork', $id);
  
  $_SESSION['callback_url'] = 'detail.php?varname='.$id;

  $userID = find_id_by_name($_SESSION['username']);
  //echo $id;
      //$check =  implode(favCheck($id));
      $check =  favCheck($id);
      //echo "check".$check;
      if ($check != null && in_array($userID,$check)){
        $faved = "1";
      }else{
        $faved = "0";
      }
      //$chec =  implode(' ',$check);
      //echo "fav".$faved ."check".$chec."id".$id;
  //echo $id;
  //echo $_SESSION['callback_url'];


  while ($row = mysqli_fetch_assoc($res)){
  
  echo "    <section id=\"portfolio-details\" class=\"portfolio-details\">
      <div class=\"container\">

        <div class=\"row gy-4\">

          <div class=\"col-lg-8\">
            <div class=\"portfolio-details-slider swiper\">
              <div class=\"swiper-wrapper align-items-center\">

                <div class=\"swiper-slide\">
                  <img src=\"".$row['PhotoURL']."\" alt=\"\" >
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
                <li><strong>Primary Material</strong>: ".$row['PrimaryMaterial']."</li>
                <br>
                <form method = \"post\">";
                if ($faved == "0") {
                  echo "<div class=\"text-center\">
                  <input style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\" type=\"submit\" name=\"favor\" value=\"Add to Favorite\"></div>";
                }else{
                  echo "<div class=\"text-center\">
                  <input style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\" type=\"submit\" name=\"favor\" value=\"Remove from Favorite\"></div>";
                }
                  
                echo"</form>
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
              <br>
              <h2>Comments</h2>";
              $comments = queryAllCommentsbyID('comments', $id);
              date_default_timezone_set('America/Vancouver');
              $dates = date('Y-m-d H:i:s');
              if (mysqli_num_rows($comments) > 0){

                  while ($comment = mysqli_fetch_assoc($comments)){
                    echo "
        
                    <div class=\"portfolio-info\">
                    <h3>Commentor:".$comment['userID']."</h3>
                    <ul>
                    <li>".$comment['content']."</li>
                      <li><strong>Comment Date</strong>: ".$comment['dates']."</li>
                      <li><strong>Comment rate</strong>: ".$comment['rates']."</li>
                    </ul>
                  </div>";
                }
              }
           echo "
            <section id=\"contact\" class=\"contact\">
     
        <div class=\"row\">

          <div class=\"col-lg-12\">
            <form method=\"post\" role=\"form\" class=\"php-email-form\">
              <div class=\"row\">
                <div class=\"col-md-6 form-group\">
                  <input type=\"number\" name=\"rate\" class=\"form-control\" id=\"name\" placeholder=\"Rating\" required>
                </div>
                
              </div>
              <div class=\"form-group mt-3\">
                <textarea class=\"form-control\" name=\"content\" rows=\"5\" placeholder=\"Comments\" required></textarea>
              </div>
              <br>
              <div class=\"text-center\"><input style=\"background: #e96b56;border: 0;border-radius: 50px;padding: 10px 24px;color: #fff;transition: 0.4s;\" type=\"submit\" name=\"submit\" value=\"Publish Comment\"></div>
            </form>
          </div>

        </div>

      </div>
    </section><!-- End Contact Section -->
           </div>
            
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->";

  

}

if(isset($_POST['submit'])) {
    if(isset($_SESSION['username'])) {
      $userID = find_id_by_name($_SESSION['username']);
      $date = $dates;
      $content = $_POST['content'];
      $rate = $_POST['rate'];
      $sql = "INSERT INTO comments(artID, userID, content, dates, rates) VALUES ('$id', '$userID', '$content', '$date', '$rate')";
      if (mysqli_query($db, $sql)){
        echo "Pulished!";
        header('Location:detail.php?varname='.$id);
      }else{
        echo "WRONG Query:" . $sql;
      }
      //echo "WRONG Query:" . $sql;
      //echo $mysqli_error;
    }
    else{
      header('Location:login.php');
    }
  }


if (isset($_POST['favor'])){
  if(isset($_SESSION['username'])) {
      $userID = find_id_by_name($_SESSION['username']);
      if ($faved == "0"){
        $sql = "INSERT INTO favourite(artID, userID) VALUES ('$id', '$userID')";
        if (mysqli_query($db, $sql)){
          header('Location:detail.php?varname='.$id);
        //echo "Pulished!";
        }else{
          echo "WRONG Query:" . $sql;
          header('Location:detail.php?varname='.$id);
        }

      }else{
        favDelete($id, $userID);
        header('Location:detail.php?varname='.$id);
      }
      
    }
    else{
      header('Location:login.php');
    }
}
?>

<footer id="footer">
    
    <?php
    include_once('footer.php');
    ?>
  
</footer>