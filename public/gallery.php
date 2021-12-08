<?php 
require_once('../private/initialize.php');
require_once('header.php'); 
$_SESSION['callback_url'] = 'gallery.php';
no_SSL();
?>

<main id="main">

    <!-- ======= Breadcrumbs ======= -->
    <section id="breadcrumbs" class="breadcrumbs">
      <div class="container">

        <ol>
          <li><a href="index.php">Home</a></li>
          <li>Gallery</li>
        </ol>
        <h2>Gallery</h2>

      </div>
    </section><!-- End Breadcrumbs -->

        <section id="portfolio" class="portfolio">
      <div class="container">

        <div class="row">
          <div class="col-lg-12 d-flex justify-content-center">
            <ul id="portfolio-flters">
              <h3>Type</h3>
                    <?php

                    $res = find_type();
                    while ($row = mysqli_fetch_assoc($res)){
                        
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['Type']; ?>" > <?php echo $row['Type']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>  
            </ul>
          </div>

        <div class="row portfolio-container">
<!--  <div class="list-group">
     <h3>Type</h3>
                    <?php

                    $res = find_type();
                    while ($row = mysqli_fetch_assoc($res)){
                        
                    ?>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector ram" value="<?php echo $row['Type']; ?>" > <?php echo $row['Type']; ?></label>
                    </div>
                    <?php    
                    }

                    ?>
                </div>   -->



        <?php
        // global $page, $firstcount;
        // $displaypg = 10; //Limited item for each page
        // if(!$page) $page=1; 
        
        // $page=min($lastpg,$page); 
        // $prepg=$page-1; //last page
        // $nextpg=($page==$lastpg ? 0 : $page+1); //next page
        // $firstcount=($page-1)*$displaypg; 

        //$sql = "SELECT * FROM artwork LIMIT 0 , 10";
	      //$res = mysqli_query($db, $sql);

        // $firstcount = 0;
        // $displaypg = 10;

        $page=$_GET['page'];
        if($page==0){
            $page=1;
        }
        //设置每页最大能显示的数量
        $pagesize=9;

        $total = find_num('artwork');
        //echo '11111'.$total;
        $lastpg=ceil($total/$pagesize);
        //echo $lastpg;

        // echo $lastpg, $total;

    //   $query="select count(*) as total from artwork";     
    //   echo'1';
    //  $result = mysqli_query($db, $query);
    //  echo'2';
    //  $row= mysqli_fetch_row($result);    
    //  echo'3';  
    //  $message_count=$row[0];



        
    		$res = queryLimited('artwork',$page,$pagesize);
    		while ($row = mysqli_fetch_assoc($res)){

    		    echo "<div class=\"col-lg-4 col-md-6 portfolio-item filter";
                // if ($row['YearOfInstallation'] > 2000) echo "--2000";
                // else echo "-2000";
            echo "\">";
    		    echo "<div class=\"portfolio-wrap\" >";
    		    echo "<img src=" .$row['PhotoURL']. "   height = \"400\" style=\"margin-left:auto;margin-right:auto;\">";
    		    echo "<div class=\"portfolio-info\">";
                    if ($row['SiteName']!= null) echo "<h4>" .$row['SiteName']. "</h4>";
                    else echo "<h4>Untitled</h4>";
                    
                    if ($row['artistID']!= null) echo "<p style=\"text-transform:capitalize;\">" .$row['FirstN']." ". $row['LastN']. "</p>";
                    else echo "<p>Unknow artist</p>";

                    if ($row['YearOfInstallation']!= null) echo "<p>" .$row['YearOfInstallation']."</p>";
                    else echo "<p>Unknow Date</p>";

                    echo "
                    <div class=\"portfolio-links\">
                      <a href=\"detail.php?varname=".$row['RegistryID']."\" title=\"More Details\"><i class=\"bx bx-link\"></i></a>
                      
                    </div>

                  </div>
                </div>
              </div>";

    		    }

          echo "</div><div class=\"center\"> <div class=\"pagination\">";

          if($page!=1){
              echo("<a href=gallery.php?page=1>First Page</a>");
               echo("<a href=gallery.php?page=".($page-1).">Previous Page</a>");
          }
          //下拉跳转列表，循环列出所有页码： 
          //$pagenav.="　到第 <select name='topage' size='1' onchange='window.location=\"$url=\"+this.value'>\n"; 
          for($i=1;$i<=$lastpg;$i++){
            echo("<a href=gallery.php?page=".($i).">".$i."</a>");

              //if($i==$page) $pagenav.="<option value='$i' selected>$i</option>\n"; 
                      //else $pagenav.="<option value='$i'>$i</option>\n"; 
          } 
          if($page!=$lastpg){
              
              echo("<a href=gallery.php?page=".($page+1).">Next Page</a>");
          
              echo("<a href=gallery.php?page=".$pagecount.">Last Page</a>");
          }

          echo "</div></div></section> ";
          ?>


<!-- ======= Footer ======= -->
<footer id="footer">
    
    <?php
    include_once('footer.php');
    ?>
  
    </footer><!-- End Footer -->
  
<script type="text/javascript" src = "../private/ajax.js"></script>

  </body>
  
  </html>

       


