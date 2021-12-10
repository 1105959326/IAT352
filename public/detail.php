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

  
  if(isset($_SESSION['username'])){
    $userID = find_id_by_name($_SESSION['username']);
    $userName = $_SESSION['username'];
    echo "<input type=\"hidden\" id=\"userid\" value=".$userName.">";
  };
  
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
              <br>"

              ?>

<div class="card">
    		<div class="card-header">Sample Product</div>
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
              // echo "<h2>Comments</h2>";
              // $comments = queryAllCommentsbyID('comments', $id);
              // date_default_timezone_set('America/Vancouver');
              // $dates = date('Y-m-d H:i:s');
              // if (mysqli_num_rows($comments) > 0){

              //     while ($comment = mysqli_fetch_assoc($comments)){
              //       echo "
        
              //       <div class=\"portfolio-info\">
              //       <h3>Commentor:".$comment['userID']."</h3>
              //       <ul>
              //       <li>".$comment['content']."</li>
              //         <li><strong>Comment Date</strong>: ".$comment['dates']."</li>
              //         <li><strong>Comment rate</strong>: ".$comment['rates']."</li>
              //       </ul>
              //     </div>";
              //   }
              // }
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
    </section><!-- End Contact Section -->
           </div>
            
      </div>
    </section><!-- End Portfolio Details Section -->

  </main><!-- End #main -->";

  

}

// if(isset($_POST['submit'])) {
//     if(isset($_SESSION['username'])) {
//       $userID = find_id_by_name($_SESSION['username']);
//       $date = $dates;
//       $content = $_POST['content'];
//       $rate = $_POST['rate'];
//       $sql = "INSERT INTO comments(artID, userID, content, dates, rates) VALUES ('$id', '$userID', '$content', '$date', '$rate')";
//       if (mysqli_query($db, $sql)){
//         echo "Pulished!";
//         header('Location:detail.php?varname='.$id);
//       }else{
//         echo "WRONG Query:" . $sql;
//       }
//       //echo "WRONG Query:" . $sql;
//       //echo $mysqli_error;
//     }
//     else{
//       header('Location:login.php');
//     }
//   }


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

<script>

$(document).ready(function(){

	var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){

        var user_name = $('#userid').val();
        //alert(user_name);

        var user_review = $('#user_review').val();

        var artID = getUrlParam('varname');
        //alert(artID);

        if(user_name == '' || user_review == '')
        {
            alert("Please Fill Both Field");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{artID:artID, rating_data:rating_data, user_name:user_name, user_review:user_review},
                error: function(data) {
             //alert('Exception:');
         },
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();
    function getUrlParam(name) {
            var reg = new RegExp("(^|&)" + name + "=([^&]*)(&|$)"); //构造一个含有目标参数的正则表达式对象
            var r = window.location.search.substr(1).match(reg);  //匹配目标参数
            if (r != null) return unescape(r[2]); return null; //返回参数值
    };


    function load_rating_data()
    {

      var artID = getUrlParam('varname');
      //alert(artID);

        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{artID:artID,action:'load_data'},
            dataType:"JSON",
            error: function(data) {
            alert('cant load data:');
         },
            success:function(data)
            {
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';

                        html += '<div class="col-sm-12">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>Username: '+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                            html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;

                        html += '</div>';

                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>