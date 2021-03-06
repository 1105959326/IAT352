<?php

function queryAll($table){
	global $db;

	$sql = "SELECT * FROM $table ";
	$res = mysqli_query($db, $sql);
	return $res;
}

function queryLimited($table,$start_item,$list_item){
  //select limited items, for page function
	global $db;

	$sql = "SELECT * FROM $table LIMIT $start_item, $list_item";
	$res = mysqli_query($db, $sql);
	return $res;
}

function queryAllbyID($table, $id){
	global $db;

	$sql = "SELECT * FROM $table WHERE RegistryID = '$id'";
	$res = mysqli_query($db, $sql);

	return $res;
}

function queryAllCommentsbyID($table, $id){
	global $db;

	$sql = "SELECT * FROM $table WHERE artID = '$id'";
	$res = mysqli_query($db, $sql);

	return $res;
}

function queryFromFav($id){
  //select all from fav list
  global $db;

  $sql = "SELECT * FROM artwork, favourite WHERE artID = RegistryID AND userID = '$id'";
  $res = mysqli_query($db, $sql);

  return $res;
}

function favDelete($artid, $userID){
  //delect item from fav list
  global $db;

  $sql = "DELETE FROM favourite WHERE artID = '$artid' AND userID = '$userID'";
  $res = mysqli_query($db, $sql);
}

function favCheck($artid){
  //check if this artwork has been liked by current loggin user
  global $db;

  $sql = "SELECT userID FROM favourite WHERE artID = '$artid' ";
  $query = mysqli_query($db, $sql);
  $res = mysqli_fetch_array($query);

  return $res;
}

function queryRecom(){
  //select all recommand items
  global $db;

  $sql = "SELECT * FROM artwork WHERE isRecom = true";
  $res = mysqli_query($db, $sql);

  return $res;
}

function update_subject($subject) {
  //update database for user's information
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
  //find user information by userid
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
  //find user id by user name
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
  //count total items number in database
  global $db;

  $sql = "SELECT COUNT(1) FROM $table";
  $result = mysqli_query($db, $sql);
  $row= mysqli_fetch_row($result);      
  $message_count=$row[0];
  //echo "message_count".$message_count;
  return $message_count;

}

function find_type(){
  //find all types from data base
  global $db;

  $sql = "SELECT DISTINCT(Type) FROM artwork ORDER BY Type DESC";
  $res = mysqli_query($db, $sql);

  return $res;
}

function findMaterial(){
  //find all types of materials from data base
  global $db;

  $sql = "SELECT DISTINCT(PrimaryMaterial) FROM artwork ORDER BY Type DESC";
  $res = mysqli_query($db, $sql);

  return $res;
}
?>