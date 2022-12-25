<?php
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
if(isset($_GET['id'])){
  $id = $_GET['id'];
  $sql = "DELETE  FROM users WHERE id='$id' " ;
  $result = mysqli_query($db , $sql);
  if ($result){
    header("Location:../dashboard-admin/etudiants.php");
  }
}

