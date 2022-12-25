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
    $etudiants = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM users"),  MYSQLI_ASSOC);
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
                <li class="nav-item rounded-pill active"><a class="nav-link" href="etudiants.php"><i class="fa-solid fa-graduation-cap"></i> Etudiants</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="admin.php"><i class="fa-solid fa-user-plus"></i> admin</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiant.php"><i class="fa-solid fa-user-plus"></i> étudiant</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="profil.php"><i class="fa-regular fa-user"></i> Profil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../home.php"><i class="fa-solid fa-house"></i> Accueil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a></li>            </ul>
            </ul>
        </nav>
    </div>
    <div class="content">
        <div class="container">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>Etudiants</h2>
            </div>
            <table class="table text-white table-striped table-sm">
                <thead>
                    <tr>
                    <th scope="col">CIN</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prénom</th>
                        <th scope="col">Email</th>
                        <th scope="col">Niveau</th>
                        <th scope="col">Filliére</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($etudiants as $etudiant): ?>
                        <tr>
                            <td class="text-white"><?= $etudiant['CIN'] ?></td>
                            <td class="text-white"><?= $etudiant['Nom'] ?></td>
                            <td class="text-white"><?= $etudiant['Prenom'] ?></td>
                            <td class="text-white"><?= $etudiant['Email'] ?></td>
                            <td class="text-white"><?= $etudiant['Niveau'] ?></td>
                            <td class="text-white"><?= $etudiant['Fil'] ?></td>
                            <td class="text-white">
                                <a  class="btn main-btn rounded-pill mr-2"> 
                                    <i class="fas fa-edit"></i>
                                </a>
                                
                                    
                                <a  class='btn cancel-btn rounded-pill mr-2'
                                    onclick="return confirm('Voulez-vous vraimet supprimer <?= $etudiant['Prenom'].' '.$etudiant['Nom'] ?> ?')"
                                    href="../php/supp-etudiant.php?id=<?= $etudiant['id'] ?>">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
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