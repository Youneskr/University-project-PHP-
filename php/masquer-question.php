<?php
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "UPDATE questions SET `approved`=0 WHERE id='$id' " ;
    $result = mysqli_query($db , $sql);
    if ($result){
        header("Location:../dashboard-admin/forum.php");
    }
}