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

<?php

//fetch_data.php

require_once('../private/initialize.php');

 $page=$_POST['page'];
if($page==null || $page == 0){
  //echo "cant get".$page;
  $page=1;
}
//echo "page:" . $page;
//var_dump($_POST);



//echo $page;
$pagesize=9;

$total = find_num('artwork');
//echo 'total'.$total;
$lastpg=ceil($total/$pagesize);
//echo "lastpage".$lastpg;

$start = ($page-1)*$pagesize;


if(isset($_POST["action"]))
{
 $sql = "
  SELECT * FROM artwork  WHERE RegistryID > '1'
 ";

 if(isset($_POST["Type"]))
 {
  $type_filter = implode("','", $_POST["Type"]);

  $sql .= "
   AND Type IN('".$type_filter."')
  ";
 }
  if(isset($_POST["PrimaryMaterial"]))
 {
  $material_filter = implode("','", $_POST["PrimaryMaterial"]);

  $sql .= "
   AND PrimaryMaterial IN('".$material_filter."')
  ";
 }
  $sql .= "LIMIT $start, $pagesize";
  //echo $sql;

$res = mysqli_query($db, $sql);
$total = mysqli_num_rows($res);
//echo 'total'.$total;
$lastpg=ceil($total/$pagesize);
        while ($row = mysqli_fetch_assoc($res)){

            echo "<div class=\"col-lg-4 col-md-6 portfolio-item filter_data";
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
            echo "<div class=\"center\"> <div class=\"pagination\">";
              if($page!=1){
              echo("<a href=gallery.php?page=1>First Page</a>");
               echo("<a href=gallery.php?page=".($page-1).">Previous Page</a>");
          }
          for($i=1;$i<=$lastpg;$i++){
            echo("<a href=gallery.php?page=".($i).">".$i."</a>");

              //if($i==$page) $pagenav.="<option value='$i' selected>$i</option>\n"; 
                      //else $pagenav.="<option value='$i'>$i</option>\n"; 
          } 
          if($page!=$lastpg){
              
              echo("<a href=gallery.php?page=".($page+1).">Next Page</a>");
          
              echo("<a href=gallery.php?page=".$lastpg.">Last Page</a>");
          }
          echo "</div></div> ";
          }
?>