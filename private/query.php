<?php

function queryAll($table){
	global $db;

	$sql = "SELECT * FROM $table ";
	$res = mysqli_query($db, $sql);
	return $res;
}

function queryLimited($table,$start_item,$list_item){
	global $db;

	$sql = "SELECT * FROM $table LIMIT $start_item, $list_item";
  //$sql = "SELECT * FROM $table LIMIT". ($start_item-1) * 5 . ",5";
	$res = mysqli_query($db, $sql);
	return $res;
}

function queryAllbyID($table, $id){
	global $db;

	$sql = "SELECT * FROM $table WHERE RegistryID = '$id'";
	//echo $sql;
	$res = mysqli_query($db, $sql);

	return $res;
}

function queryAllCommentsbyID($table, $id){
	global $db;

	$sql = "SELECT * FROM $table WHERE artID = '$id'";
	//echo $sql;
	$res = mysqli_query($db, $sql);

	return $res;
}

function queryFromFav($id){
  global $db;

  $sql = "SELECT * FROM artwork, favourite WHERE artID = RegistryID AND userID = '$id'";
  //echo $sql;
  $res = mysqli_query($db, $sql);

  return $res;
}

function favDelete($artid, $userID){
  global $db;

  $sql = "DELETE FROM favourite WHERE artID = '$artid' AND userID = '$userID'";
  //echo $sql;
  $res = mysqli_query($db, $sql);
}

function favCheck($artid){
  global $db;
  $sql = "SELECT userID FROM favourite WHERE artID = '$artid' ";
  $query = mysqli_query($db, $sql);
  //echo"before res";
  $res = mysqli_fetch_array($query);
  //echo 're'.$res;

  return $res;
}

function queryRecom(){
  global $db;

  $sql = "SELECT * FROM artwork WHERE isRecom = true";
  //echo $sql;
  $res = mysqli_query($db, $sql);

  return $res;
}

function update_subject($subject) {
    global $db;


    $sql = "UPDATE member SET ";
    $sql .= "password='" . db_escape($db, $subject['password']) . "', ";
    $sql .= "FirstName='" . db_escape($db, $subject['FirstName']) . "', ";
    $sql .= "LastName='" . db_escape($db, $subject['LastName']) . "',";
	$sql .= "otherContact='" . db_escape($db, $subject['otherContact']) . "' ";
    $sql .= "WHERE userName = '" . $_SESSION['username'] . "'";
    
    $result = mysqli_query($db, $sql);
	
    // For UPDATE statements, $result is true/false
    if($result) {
      return true;
    } else {
      // UPDATE failed
      echo mysqli_error($db);
	  //echo $sql;
      db_disconnect($db);
      exit;
    }

  }

function find_subject_by_id($username) {
    global $db;

    $sql = "SELECT password, FirstName, LastName, otherContact FROM member ";
    $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
    // echo $sql;

    $result = mysqli_query($db, $sql);
    //confirm_result_set($result);
    $subject = mysqli_fetch_assoc($result);
    mysqli_free_result($result);
    return $subject; // returns an assoc. array
}

function find_id_by_name($username) {
  global $db;

  $sql = "SELECT userID FROM member ";
  $sql .= "WHERE username='" . db_escape($db, $username) . "' ";
  // echo $sql;

  $result = mysqli_query($db, $sql);
  //confirm_result_set($result);
  $subject = mysqli_fetch_assoc($result);
  mysqli_free_result($result);
  return implode($subject); // returns an assoc. array
}

function find_num($table){
  global $db;

  $sql = "SELECT COUNT(1) FROM $table";
  $result = mysqli_query($db, $sql);
  $row= mysqli_fetch_row($result);      
  $message_count=$row[0];
  //echo "message_count".$message_count;
  return $message_count;

}

function find_type(){
  global $db;

  $sql = "SELECT DISTINCT(Type) FROM artwork ORDER BY Type DESC";
  $res = mysqli_query($db, $sql);

  return $res;
}

function findMaterial(){
  global $db;

  $sql = "SELECT DISTINCT(PrimaryMaterial) FROM artwork ORDER BY Type DESC";
  $res = mysqli_query($db, $sql);

  return $res;
}
?>