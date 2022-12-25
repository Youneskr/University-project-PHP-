<?php
session_start();
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
$info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id' "));

if(isset($_POST['modif']))
{
    $Nom = $_POST['Nom'];
    $Prenom = $_POST['Prenom'];
    $CIN = $_POST['CIN'];
    $Niveau = $_POST['Niveau'];
    $Fil = $_POST['Fil'];
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];

    if($Password==$info['Password']){
        $sql = "UPDATE users SET `CIN`='$CIN',`Nom`='$Nom',`Prenom`='$Prenom',`Email`='$Email',`Niveau`='$Niveau',`Fil`='$Fil' WHERE id='$id' " ;
        $modif=mysqli_query($db , $sql);
        if($modif){
            header("Location:../etudiant/profil.php");
        }
    }
    else{
        header("Location:../etudiant/modif_erreur.php");
        
    }

}