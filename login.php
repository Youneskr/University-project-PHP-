<?php
session_start();
if (isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('home.php');</script>";
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
if(!$db){
    echo 'Erreur : '. mysqli_connect_error();
}

$error = ''; 

if (isset($_POST['connecter'])) {
    $Login = htmlspecialchars($_POST['Login']);
    $Password = $_POST['Password'];
    if ( empty($Login) ) { $error = 'Saisit votre Login ! '; }
    if ( empty($Password) ) { $error = 'Saisit votre Mot de Passe  !'; }
    if (empty($Login) && empty($Password)) { $error = 'Saisit votre coordonnées !'; }
    else {
        // Requêtes SQL
        $sql_user = "SELECT * FROM users  WHERE Login = '$Login'  AND Password= '$Password' ";
        $sql_admin = "SELECT * FROM admin  WHERE Login = '$Login'  AND Password= '$Password' ";
        // Exécuter les requêtes SQL dans la base des données
        $result_user = mysqli_query($db , $sql_user);
        $result_admin = mysqli_query($db , $sql_admin);

        if (mysqli_num_rows($result_user) == 1){
            $_SESSION['role']='etudiant';
            $userinfo = mysqli_fetch_assoc($result_user);
            if($userinfo['Login'] == $Login && $userinfo['Password'] == $Password){
                $_SESSION['id']=$userinfo['id'];
                $error="user = ".$userinfo['id'];
                echo "<script type='text/javascript'>document.location.replace('home.php');</script>";

            }
        }
        else if (mysqli_num_rows($result_admin) == 1){
            $_SESSION['role']='admin';
            $userinfo = mysqli_fetch_assoc($result_admin);
            if($userinfo['Login'] == $Login && $userinfo['Password'] == $Password){
                $_SESSION['id']=$userinfo['id'];
                
                $error="user = ".$userinfo['id'];
                echo "<script type='text/javascript'>document.location.replace('home.php');</script>";

            }
        }
        else { $error="Vos données sont incorrects !"; }
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- CSS -->
    <link rel="stylesheet" href="css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/login.css?v=<?php echo time(); ?>">
    <title>N'hésitcom | Se connecter</title>
</head>
<body>
    <!-- Video -->
    <div class="background">
        <div class="video-wrap">
            <video src="video/index.mp4" autoplay loop muted></video>
        </div>
        <div class="overlay"></div>
    </div>
    <!-- Video -->

    <main>
        <!-- Nav-bar -->
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <a class="navbar-brand" href="#"><img class="img-fluid" src="imgs/mini_logo.png" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="icon fa-solid fa-bars"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbar">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#formation">Formation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clubs">Clubs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#forum">Forum</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav-bar -->

        <!-- login form -->
        <div class="container login-container text-center text-white">
            <div class="d-flex justify-content-center">
                <div class="w-50 login-form">
                    <h3 class="mb-4">Se connecter</h3>
                    <form method="POST" action="login.php">
                        <div class="form-group mb-3">
                            <input name="Login" type="text" class="form-control" placeholder="Login" value="" />
                        </div>
                        <div class="form-group mb-3">
                            <input name="Password" type="password" class="form-control" placeholder="Mot de passe" value="" />
                        </div>
                        <div class="form-group">
                            <input name="connecter" type="submit" class="btnSubmit text-dark" value="Login" />
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- login form -->
    </main>

    <footer class="bg-dark text-center text-white">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2022 Copyright: Projet Fédérer
        </div>
        <!-- Copyright -->
    </footer>

    <!-- JS -->
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>