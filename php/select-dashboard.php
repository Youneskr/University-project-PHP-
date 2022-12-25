<?php
session_start();
if (isset($_SESSION['id'])){
    if($_SESSION['role'] == 'admin'){
        echo "<script type='text/javascript'>document.location.replace('../dashboard-admin/dashboard.php');</script>";
    }
    else{
        echo "<script type='text/javascript'>document.location.replace('../etudiant/profil.php');</script>";
    }
}
else{
    echo "<script type='text/javascript'>document.location.replace('../index.php');</script>";
}