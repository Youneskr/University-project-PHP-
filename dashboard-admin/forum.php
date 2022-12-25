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
    
    $questions_pub = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE approved='1' "),  MYSQLI_ASSOC);
    $questions_att = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE is_user='1' AND approved='0' "),  MYSQLI_ASSOC);
    $nb_question_pub = mysqli_num_rows(mysqli_query($db , "SELECT * FROM questions WHERE approved='1'"));
    $nb_question_att = mysqli_num_rows(mysqli_query($db , "SELECT * FROM questions WHERE is_user='1' AND approved='0'"));



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
                <li class="nav-item rounded-pill active"><a class="nav-link" href="forum.php"><i class="fa-solid fa-comments"></i> Forum</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="administration.php"><i class="fa-solid fa-school"></i> Administration</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiants.php"><i class="fa-solid fa-graduation-cap"></i> Etudiants</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="admin.php"><i class="fa-solid fa-user-plus"></i> admin</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="etudiant.php"><i class="fa-solid fa-user-plus"></i> étudiant</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="profil.php"><i class="fa-regular fa-user"></i> Profil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../home.php"><i class="fa-solid fa-house"></i> Accueil</a></li>
                <li class="nav-item rounded-pill"><a class="nav-link" href="../php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i> Déconnexion</a></li>            </ul>
            </ul>
        </nav>
    </div>
    <div class="content">
        <h2 class="text-center lead py-4">A propos de Forum</h2>
        <div class="container">
            <div class="row text-center">
                <div class="col-md-6 mb-5">
                    <div class=" card text-center py-3  ">
                        <h1 class="fw-bold text-white" ><?= $nb_question_pub ?> articles</h1>
                        <h2 class="fw-bold" >Publié(s)</h2>
                        <i class="fa-regular fa-circle-check text-success fs-2 mt-2"></i>
                    </div>
                </div>
                <div class="col-md-6 mb-5">
                    <div class=" card text-center  py-3 ">
                        <h1 class="fw-bold"><?= $nb_question_att ?> articles</h1>
                        <h2 class="fw-bold"  >En cours</h2>
                        <i class="fa-solid fa-arrows-rotate text-warning  fs-2 mt-2"></i>
                    </div>
                </div>
            </div>

            <h2 class=" py-4 text-warning">Articles en attentes</h2>
            <!-- Tableau des articles non publiés -->
            <table class="table text-white table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Auteur</th>
                        <th scope="col">Question</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($questions_att as $questions): ?>
                        <tr>
                            <td class="text-white">
                                <?php  
                                    $id_auteur=$questions['id_auteur'];
                                    $auteur = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id_auteur' "));
                                    echo $auteur['Prenom'].' '.$auteur['Nom'];
                                ?>
                            </td>
                            <td class="text-white"><?= $questions['contenu'] ?></td>
                            <td class="text-white">
                                <!-- Approuvee -->
                                <a onclick="return confirm('Voulez-vous vraimet publier cet article ?')"
                                    href="../php/approuve-question.php?id=<?= $questions['id'] ?>"
                                id="ajout-btn" type="button"  class="btn text-success fs-5 mr-2">
                                    <i class="fa-solid fa-check"></i>
                                </a>
                                <!-- Supprimer -->
                                <a onclick="return confirm('Voulez-vous vraimet supprimer cet article ?')"
                                    href="../php/supp-article.php?id=<?= $questions['id'] ?>"
                                    class='btn  text-warning fs-5 mr-2'>
                                    <i class="fa-solid fa-trash-can"></i>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <h2 class="py-4 text-success">Articles publiés</h2>
            <!-- Tableau des articles publiés -->
            <table class="table text-white table-striped table-sm">
                <thead>
                    <tr>
                        <th scope="col">Auteur</th>
                        <th scope="col">Question</th>
                        <th scope="col">Option</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($questions_pub as $questions): ?>
                        <tr>
                            <td class="text-white">
                                <?php  
                                    $id_auteur=$questions['id_auteur'];
                                    if($questions['is_user']==1){
                                        $auteur = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id_auteur' "));
                                    }
                                    else{
                                        $auteur = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM admin  WHERE id= '$id_auteur' "));
                                    }
                                    echo $auteur['Prenom'].' '.$auteur['Nom'];
                                ?>
                            </td>
                            <td class="text-white"><?= $questions['contenu'] ?></td>
                            <td class="text-white">
                                <?php if($questions['is_admin']==1){ ?>
                                    <span class="text-success fw-bold">Admin</span>
                                <?php }
                                    else { ?>
                                        <!-- Masquer -->
                                        <a onclick="return confirm('Cet article sera masquer du Forum')"
                                            href="../php/masquer-question.php?id=<?= $questions['id'] ?>"
                                            class='btn  text-primary fs-5 mr-2'>
                                            <i class="fa-solid fa-eye-slash"></i>
                                        </a>
                                <?php } ?>
                                <!-- Supprimer -->
                                <a onclick="return confirm('Voulez-vous vraimet supprimer cet article ?')"
                                    href="../php/supp-article.php?id=<?= $questions['id'] ?>"
                                    class='btn  text-danger fs-5 mr-2'>
                                    <i class="fa-solid fa-trash-can"></i>
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