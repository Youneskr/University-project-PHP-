<?php
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
if(isset($_GET['id'])){
    $id = $_GET['id'];
    $sql = "DELETE  FROM questions WHERE id='$id' " ;
    $result = mysqli_query($db , $sql);
    if ($result){
        header("Location:../forum/mesQuestions.php");
    }
}
