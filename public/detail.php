<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
error_reporting(E_ALL);
ini_set("display_errors", 1);
no_SSL();?>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">
        <br><br><br>

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
  //get user id and artwork id
  
  if(isset($_SESSION['username'])){
    $userID = find_id_by_name($_SESSION['username']);
    $userName = $_SESSION['username'];
    echo "<input type=\"hidden\" id=\"userid\" value=".$userName.">";
  };
  
  //check if this artwork has been add to fav list
  $check =  favCheck($id);
  if ($check != null && in_array($userID,$check)){
    $faved = "1";
  }else{
    $faved = "0";
  }


  //diaplay details of artwork
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
        
    //check and display map
    if ($row['Geom'] == null){
    echo "<Strong>Geometry Information not found</Strong>";
    }else{
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
              <br>"
  ?>
    <!-- Comment area HTML display from tutorial-->
    <div class="card">
    	<div class="card-header">Comments information</div>
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						<b><span id="average_rating">0.0</span> / 5</b>
    					</h1>
    					<div class="mb-4">
    						<i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
                <i class="fas fa-star star-light mr-1 main_star"></i>
	    				</div>
    					<h3><span id="total_review">0</span> Review</h3>
    				</div>
    				<div class="col-sm-5">
    					<p>
                <div class="progress-label-left"><b>5</b> <i class="fas fa-star text-warning"></i></div>
                <div class="progress-label-right">(<span id="total_five_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="five_star_progress"></div>
                </div>
              </p>
    					<p>
                <div class="progress-label-left"><b>4</b> <i class="fas fa-star text-warning"></i></div>
                <div class="progress-label-right">(<span id="total_four_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="four_star_progress"></div>
                </div>               
              </p>
    					<p>
                <div class="progress-label-left"><b>3</b> <i class="fas fa-star text-warning"></i></div>
                <div class="progress-label-right">(<span id="total_three_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="three_star_progress"></div>
                </div>               
              </p>
    					<p>
                <div class="progress-label-left"><b>2</b> <i class="fas fa-star text-warning"></i></div>
                <div class="progress-label-right">(<span id="total_two_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="two_star_progress"></div>
                </div>               
              </p>
    					<p>
                <div class="progress-label-left"><b>1</b> <i class="fas fa-star text-warning"></i></div>
                <div class="progress-label-right">(<span id="total_one_star_review">0</span>)</div>
                <div class="progress">
                  <div class="progress-bar bg-warning" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100" id="one_star_progress"></div>
                </div>               
              </p>
    				</div>
    			</div>
    		</div>
    	</div>

      <div class="mt-5" id="review_content"></div>
      <?PHP
      echo "
      <section id=\"contact\" class=\"contact\">
        <div class=\"row\">
          <div class=\"col-lg-12\">
            <form method=\"post\" role=\"form\" class=\"php-email-form\">
              <div class=\"row\">
                <div class=\"col-md-6 form-group\">"?>
                <h4 class=" mt-1 mb-3"> Rate:
	        		<i class="fas fa-star star-light submit_star mr-1" id="submit_star_1" data-rating="1"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_2" data-rating="2"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_3" data-rating="3"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_4" data-rating="4"></i>
                    <i class="fas fa-star star-light submit_star mr-1" id="submit_star_5" data-rating="5"></i>
	        	</h4>
            
            <?php
                  echo"
                </div>
                
              </div>
              <div class=\"form-group mt-3\">
                <textarea class=\"form-control\" name=\"user_review\" id=\"user_review\" rows=\"5\" placeholder=\"Comments\" required></textarea>
              </div>
              <br>
              <button type=\"button\" name=\"add_review\" id=\"save_review\" class=\"btn btn-primary\">Comment</button>
            </form>
          </div>
        </div>
      </div>
    </section>
           </div>  
      </div>
    </section>
  </main>";

}

//php code for favourite button function
//if not log in yet redirect to login page
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
    }else{
      header('Location:login.php');
    }
}
?>


<footer id="footer">
    <?php
    include_once('footer.php');
    ?>
</footer>

<!-- AJAX Code for command area -->
<script src="../private/detail.js"></script>