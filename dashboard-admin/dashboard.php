<?php 
    session_start();
    if (!isset($_SESSION['id']) || $_SESSION['role'] != 'admin' ) {
        header("Location: ../login.php");
    }
    if ($_SESSION['role'] != 'admin' ) {
        header("Location: ../error.php");
    }
    $id = $_SESSION['id'] ;
    $db = mysqli_connect('localhost' , "root" , "" , "isitc");
    $sql = "SELECT * FROM admin  WHERE id ='$id' " ;
    $result = mysqli_query($db , $sql);
    $info = mysqli_fetch_assoc($result);
    $nb_admin = mysqli_num_rows(mysqli_query($db , "SELECT * FROM admin"));
    $nb_etudiant = mysqli_num_rows(mysqli_query($db , "SELECT * FROM users"));
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
                <li class="nav-item rounded-pill active"><a class="nav-link" href="dashboard.php"><i class="fa-solid fa-chart-line"></i> Dashboard</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="forum.php"><i class="fa-solid fa-comments"></i> Forum</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="administration.php"><i class="fa-solid fa-school"></i> Administration</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiants.php"><i class="fa-solid fa-graduation-cap"></i> Etudiants</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="admin.php"><i class="fa-solid fa-user-plus"></i> admin</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiant.php"><i class="fa-solid fa-user-plus"></i> étudiant</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="profil.php"><i class="fa-regular fa-user"></i> Profil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../home.php"><i class="fa-solid fa-house"></i> Accueil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a></li>
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="container">
                <!-- Bienvenu -->
                <div class="p-4 mb-4 text-white rounded fw-bold">
                    <h1 class=" fst-italic">Bienvenue <?= $info['Prenom'] ?> !</h1>
                    <hr>
                    <p>Le 19/03/2022 | 3:28 AM</p>
                </div>
                <!-- Bienvenu -->
                <h2 class="text-center py-4">Quelques chiffres</h2>
                <div class="row text-center">
                    <div class="col-md-4 mb-5">
                        <div class="card text-start bg-light">
                            <div class="card-body">
                                <h5 class="card-title">
                                    <a style="color: #ff3150;" class="text-decoration-none" href="profil.php"><i class="fa-solid fa-user"></i> Profil</a>
                                </h5>
                                <hr>
                                <p class="card-text">
                                    <span style="color: #2470dc;" class="fw-bold">Statut</span> : <span class="text-success fw-bold"><?= $_SESSION['role'] ?></span>
                                </p>
                                <p class="card-text">
                                    <span style="color: #2470dc;" class="fw-bold">Identité</span> : <span class=" fw-bold text-dark"><?= $info['Nom'].' '.$info['Prenom'] ?></span>
                                </p>
                                <p class="card-text">
                                    <span style="color: #2470dc;" class="fw-bold">Email</span> : <span class=" fw-bold text-dark"><?= $info['Email'] ?></span>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class=" card text-center bg-light  pt-4  "  style="min-height: 193px;">
                            <h1 class="fw-bold"  style="color: #2470dc;"><?= $nb_etudiant ?></h1>
                            <h2 class="fw-bold"  style="color: #2470dc;"><a class="text-decoration-none" href="etudiants.php">Etudiant(s)</a></h2>
                        </div>
                    </div>
                    <div class="col-md-4 mb-5">
                        <div class=" card text-center bg-light  pt-4 "  style="min-height: 193px;">
                            <h1 class="fw-bold"  style="color: #ff3150;"><?= $nb_admin ?></h1>
                            <h2 class="fw-bold"  ><a style="color: #ff3150;" class="text-decoration-none" href="administration.php">Admin(s)</a></h2>
                        </div>
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