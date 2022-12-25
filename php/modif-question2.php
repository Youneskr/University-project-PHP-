<?php
session_start();
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_GET['id'] ;

if(isset($_POST['modif']))
{
    $titre = $_POST['titre'];
    $description = $_POST['description'];
    $contenu = $_POST['contenu'];
    
    $sql = "UPDATE questions SET `titre`='$titre',`description`='$description',`contenu`='$contenu' WHERE id='$id' " ;
    $modif=mysqli_query($db , $sql);
    if($modif){
        header("Location:../forum/index.php");
    }
}