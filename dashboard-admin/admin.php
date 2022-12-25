<?php 
    session_start();
    if (!isset($_SESSION['id'])) {
        header("Location: ../index.php");
    }
    $id = $_SESSION['id'] ;
    if ($_SESSION['role']=='admin'){
        $sql = "SELECT * FROM admin  WHERE id ='$id' " ;
    }
    elseif($_SESSION['role']=='user'){
        $sql = "SELECT * FROM users  WHERE id ='$id' " ;
    }
    $db = mysqli_connect('localhost' , "root" , "" , "isitc");
    $result = mysqli_query($db , $sql);
    $info = mysqli_fetch_assoc($result);

    $erreurs = [
		'Nom_prenom' => '',
		'CIN' => '',
		'Email' => '',
		'Login' => '',
		'Password' => '',
		'cPassword' => ''
	];
		$Nom = '';
		$Prenom = '';
		$CIN = '';
		$Email = '';
		$Login = '';
		$Password = '';
		$cPassword = '';
	if(isset($_POST['create']))
	{
		$Nom = $_POST['Nom'];
		$Prenom = $_POST['prenom'];
		$CIN = $_POST['CIN'];
		$Email = $_POST['Email'];
		$Login = $_POST['Login'];
		$Password = $_POST['Password'];
		$cPassword = $_POST['cPassword'];
        //test nom et prenom
		if(empty($Nom) && !empty($Prenom)){ $erreurs ['Nom_prenom'] =  "Veuillez saisir le nom"; }
		elseif(empty($Prenom) && !empty($Nom)){ $erreurs ['Nom_prenom'] = "Veuillez saisir le prénom"; }
        elseif(empty($Prenom) && empty($Nom)){$erreurs ['Nom_prenom'] =  "Veuillez saisir le nom et le prénom";}

        //test CIN
		if(empty($CIN)){ $erreurs ['CIN'] = "Veuillez saisir le CIN"; }
        
        //test Email
		if(empty($Email)){ $erreurs ['Email'] = "Veuillez saisir l'Email"; }
		elseif(!filter_var($Email , FILTER_VALIDATE_EMAIL)){$erreurs ['Email'] = "Email invalide";}

        //test Login
		if(empty($Login)){ $erreurs ['Login'] = "Veuillez saisir le Login"; }

		if(empty($Password)){ $erreurs ['Password'] = "Veuillez saisir le mot de passe"; }
		if ($Password != $cPassword) {$erreurs ['Password'] = "Mot de passe invalide";}
		if (!array_filter($erreurs)) {
			$msg_f="";
			// Requete SQL d'insertion
			$sql = "INSERT INTO admin (CIN, Nom, Prenom, Email, Login, Password) 
					VALUES ('$CIN','$Nom','$Prenom','$Email','$Login','$Password')";
			if(!mysqli_query($db , $sql)){
				$msg_f = "Echec : Impossible d'ajouter l'admin";
			}
			else {$msg_f = $Prenom." ".$Nom." a été ajouté";}
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
    <link rel="stylesheet" href="../css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/bootstrap.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/dashboard/dashboard.css?v=<?php echo time(); ?>">
    <title>N'hésitcom | Dashboard</title>
</head>
<body>
<!-- Video -->
<div class="background">
    <div class="video-wrap">
        <video src="../video/index.mp4" autoplay loop muted></video>
    </div>
    <div class="overlay"></div>
</div>
<!-- Video -->

<main>
    <div class="links d-none d-md-block">
        <nav class="navbar">
            <ul class="nav navbar-nav text-center">
            <li class="nav-item rounded-pill"><a class="nav-link" href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="forum.php"><i class="fa-solid fa-comments"></i> Forum</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="administration.php"><i class="fa-solid fa-school"></i> Administration</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiants.php"><i class="fa-solid fa-graduation-cap"></i> Etudiants</a></li>
                <li class="nav-item rounded-pill active"><a class="nav-link" href="admin.php"><i class="fa-solid fa-user-plus"></i> admin</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiant.php"><i class="fa-solid fa-user-plus"></i> étudiant</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="profil.php"><i class="fa-regular fa-user"></i> Profil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../home.php"><i class="fa-solid fa-house"></i> Accueil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a></li>            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <div class="row formaulaire d-flex justify-content-between align-items-center rounded">
                <div class="col-12 col-lg-7">
                    <form class="p-2" action="admin.php" method="POST">
                            <!-- Nom et prenom -->
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Nom et prénom</span>
                                </div>
                                <input value="<?php echo $Nom ; ?>" type="text" name="Nom" id="Nom" class="form-control" placeholder="Nom">
                                <input value="<?php echo $Prenom ; ?>" type="text" name="prenom" id="prenom" class="form-control" placeholder="Prénom">
                            </div>
                            <div class="form-text erreur mb-2"><?php echo $erreurs ['Nom_prenom']; ?></div>
                            <!-- Nom et prenom -->

                            <!-- CIN -->
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >CIN</span>
                                </div>
                                <input value="<?php echo $CIN ; ?>" type="text" name="CIN" id="CIN" class="form-control" placeholder="12......">
                            </div>
                            <div class="form-text erreur mb-2"><?php echo $erreurs ['CIN']; ?></div>
                            <!-- CIN -->

                            <!-- Email -->
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Email</span>
                                </div>
                                <input value="<?php echo $Email ; ?>" type="text" name="Email" id="Email" class="form-control" placeholder="admin@isitcom.tn">
                            </div>
                            <div class="form-text erreur mb-2"><?php echo $erreurs ['Email']; ?></div>
                            <!-- Email -->

                            <!-- Login -->
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" >Login</span>
                                </div>
                                <input value="<?php echo $Login ; ?>" type="text" name="Login" id="Login" class="form-control" placeholder="admin123">
                            </div>
                            <div class="form-text erreur mb-2"><?php echo $erreurs ['Login']; ?></div>
                            <!-- Login -->

                            <!-- Password -->
                            <div class="input-group ">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa-solid fa-key"></i> &nbsp; Mot de Passe</span>
                                </div>
                                <input value="<?php echo $Password ; ?>" type="password" name="Password" id="Password" class="form-control" placeholder="........">
                                <input type="password" name="cPassword" id="cPassword" class="form-control" placeholder="confirmation">
                            </div>
                            <div class="form-text erreur mb-2"><?php echo $erreurs ['Password']; ?></div>
                            <!-- Password -->

                            <!-- Bouttons -->
                            <div class="text-center pt-3">
                                <button type="submit" name="create" id="register" class="main-btn btn rounded-pill me-5">Ajouter</button>
                                <button type="reset" class="cancel-btn btn rounded-pill">Annuler</button>
                            </div>
                            <!-- Bouttons -->
                            <?php
                                if(isset($msg_f)){
                                    echo('<h4 class="text-center mt-3" style="color: #0060b1">'.$msg_f.'</h4>');
                                }
                            ?>
                        </form>
                </div>
                <div class="col-lg-5">
                    <img class="img-fluid" src="../imgs/box-logo.png" alt="">
                </div>
            </div>
        </div>
    </div>
</main>
        
<!-- FOOTER  -->
<footer class="bg-dark text-center text-white">
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
        &copy; 2022 Copyright: Projet Fédérer
    </div>
</footer>
<!-- FOOTER  -->

<!-- JS -->
    <script src="js/all.min.js>"></script>
    <script src="js/bootstrap.bundle.min.js>"></script>
    <script src="js/main.js>"></script>
</body>
</html>