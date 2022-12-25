<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
if($_SESSION['role']=='admin'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM admin  WHERE id= '$id' "));
}
if($_SESSION['role']=='etudiant'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id' "));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- BOOTSTRAP -->
    <link rel="stylesheet" href="css/all.min.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/bootstrap.min.css?v=<?php echo time(); ?>">
    <!-- CSS -->
    <link rel="stylesheet" href="css/navbar.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="css/index-log.css?v=<?php echo time(); ?>">
    <title>N'hésitcom | Accueil</title>
</head>
<body>
    <button onclick="topFunction()" id="myBtn" class="rounded-pill">
        <i class="fa-solid fa-arrow-up"></i>
    </button>
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
                            <a class="nav-link active" aria-current="page" href="home.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#formation">Formation</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#clubs">Clubs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="forum/index.php">Forum</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-auto">
                        <li class="nav-item dropdown">
                            <div class="dropdown">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="profil" data-bs-toggle="dropdown" aria-expanded="false">
                                <?=   $info['Prenom'].' '.$info['Nom'] ; ?>
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="profil">
                                    <li>
                                        <a class="dropdown-item" href="php/select-dashboard.php">
                                            <?php 
                                                if($_SESSION['role']=='admin'){
                                                    echo 'Dashboard';
                                                }
                                                else echo'Profile';  
                                            ?>
                                        </a>
                                    </li>
                                    <li><a class="dropdown-item" href="php/logout.php">Déconnexion</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Nav-bar -->

        <!-- landing -->
        <div class="landing ">
            <div class="container d-flex justify-content-center">
                <div class="row align-items-center">
                    <div class="col-md-7">
                        <table class="table table-borderless">
                            <tr class="">
                                <td class="prefix">Prenom: </td>
                                <td class="data"><?= $info['Prenom'] ?></td>
                            </tr>
                            <tr class="">
                                <td class="prefix">Nom: </td>
                                <td class="data"><?= $info['Nom'] ?></td>
                            </tr>
                            <tr class="">
                                <td class="prefix">Email: </td>
                                <td class="data"><?= $info['Email'] ?></td>
                            </tr>
                            <tr class="">
                                <td class="prefix">Statut: </td>
                                <td class="role"><?=   $_SESSION['role'] ; ?></td>
                            </tr>
                        </table>
                    </div>
                    <div class="col-md-5">
                        <img src="imgs/home.svg" class="img-fluid" alt="">
                    </div>
                </div>
                
            </div>
            
            </div>
        </div>
        <!-- landing -->
    </main>

    <!-- Formation  -->
    <section id="formation">
        <div class="stuff text-center pt-5">
            <div class="container">
                <div class="main-title position-relative">
                    <img class="mb-4" style="width : 65px" src="imgs/formation.png" alt="">
                    <h2>Formation</h2>
                </div>
                <div class="row  align-items-center">
                    
                    <!-- IOT  -->
                    <div class="col-lg-4 text-md-start">
                        <div class="text ">
                            <h4 class="mb-5" style="color: #fd786f;">Internet des objets</h4>
                            <p class="fd-6 text-black-50">Développer chez les apprenants la faculté de transformer et faire évoluer l’architecture entreprise en fonction des besoins stratégiques et des objectifs métiers. Développer chez les apprenants la faculté d’exécuter les plans de tests afin de garantir la qualité d’un programme informatique et de ses fonctionnalités. Développer les techniques de mise en place et d'intégration des solutions préconisées. Développer les techniques de développement et de la mise en œuvre des applications informatiques. Développer la compétence identification des besoins des utilisateurs afin de construire des programmes sur mesure en fonction des supports et des outils de développement utilisés.</p>
                            <p class="fd-6 text-black-50">Développer les techniques d’Optimisation du code, After Design/Motion Effect/Outils Adobe/Outils d'animation, User Interface et Méthodologie (Agile, etc,). Développer les habiletés en communication, travail en équipe, orientation du client, prise de décision et gestion des problèmes.</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="image">
                            <img class="img-fluid" src="imgs/iot.jpg" width="600px" alt="">
                        </div>
                    </div>
                    <!-- IOT  -->
                    <hr style="background-color: #E0CD2B; height: 3px;">
                    <!-- Multimedia  -->
                    <div class="col-lg-8  mb-5">
                        <div class="image">
                            <img class="img-fluid" src="imgs/multimedia.jpg"  alt="">
                        </div>
                    </div>
                    <div class="col-lg-4 mb-5 mt-5 text-md-start">
                        <div class="text ">
                            <h4 class="mb-5" style="color: #07b7e9;">Science Informatique</h4>
                            <p class="fd-6 text-black-50">Développer la faculté d’interpréter et d’exploiter une conception chez les apprenants. Développer les techniques de développement et de la mise en œuvre des applications informatiques embarquées (synchronisation, programmation temps réel). Développer la compétence analyse des besoins des utilisateurs afin de construire des programmes sur mesure en fonction des supports et des outils de développement utilisés. Développer la compétence Tests</p>
                            <p class="fd-6 text-black-50">Développer les compétences planification des produits et/ou services, analyse statistique des données et veille technologique. Développer les techniques de représentation des signaux multidimensionnels, l’architecture des codeurs et les techniques de codage standards multimédia afin d’intégrer des solutions IoT en exploitant des plateformes (dans des cas réels). Développer les habiletés en communication, travail en équipe, orientation du client, prise de décision et gestion des problèmes.</p>
                            
                        </div>
                    </div>
                    <!-- Multimedia  -->
                    <hr style="background-color: #E0CD2B; height: 3px;">
                    <!-- Telecom  -->
                    <div class="col-lg-4 mt-5 text-md-start">
                        <div class="text ">
                            <h4 class="mb-5" style="color: #616161;">Télecommunication</h4>
                            <p class="fd-6 text-black-50">Former les étudiants aux fondamentaux des sciences de télécommunications et renforcer leur appréhension des évolutions technologiques atteintes en vue de promouvoir leur potentiel d’innovation et d’entreprenariat</p>
                            <p class="fd-6 text-black-50">Etendre les connaissances acquises sur les réseaux de télécommunications usuelles aux avancées atteintes en la matière. − Renforcer la compréhension des avancées technologiques des systèmes embarqués en matière de conception électronique et de programmation informatique. − Promouvoir l’appréhension des technologies émergentes dans le domaine des télécommunications et les enjeux à relever.</p>
                            
                        </div>
                    </div>
                    <div class="col-lg-8 mt-5">
                        <div class="image">
                            <img class="img-fluid" src="imgs/telecom.jpg" width="600px" alt="">
                        </div>
                    </div>
                    <!-- Telecom  -->
                </div>
            </div>
        </div>
    </section>
    <!-- Formation  -->

    <!-- Clubs -->
    <section id="clubs">
        <div id="carousel-club" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-controls">
                <div class="carousel-indicators">
                    <button style="background-image:url('imgs/club_carousel/indicateur-google.png')" type="button" data-bs-target="#carousel-club" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                    <button style="background-image:url('imgs/club_carousel/indicateur-enactus.png')" type="button" data-bs-target="#carousel-club" data-bs-slide-to="1" aria-label="Slide 2"></button>
                    <button style="background-image:url('imgs/club_carousel/indicateur-securinet.png')" type="button" data-bs-target="#carousel-club" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    <button style="background-image:url('imgs/club_carousel/indicateur-tunivision.png')" type="button" data-bs-target="#carousel-club" data-bs-slide-to="3" aria-label="Slide 4"></button>
                </div>
                <button class="carousel-control-prev d-none d-md-block" type="button" data-bs-target="#carousel-club" data-bs-slide="prev">
                    <img class="img-fluid" src="imgs/club_carousel/left-arrow.svg" alt="">
                </button>
                <button class="carousel-control-next d-none d-md-block" type="button" data-bs-target="#carousel-club" data-bs-slide="next">
                    <img class="img-fluid" src="imgs/club_carousel/right-arrow.svg" alt="">
                </button>
            </div>
            <div class="carousel-inner text-white">
                <!-- IGC  -->
                <div class="carousel-item active" style="background-image:url('imgs/club_carousel/bg-igc.jpg')">
                    <div class="container">
                        <h2>Isitcom Google Club</h2>
                        <p class="lead">Créé le 17 février 2018.</p>
                        <p>Notre club vise à rassembler de jeunes étudiants qui partagent leur passion pour le développement.</p>
                        <p>Nous proposons des formations, des workshops, nous organisons et participons à des événements et challenges technologiques</p>
                        <div class="social-media">
                            <a target="_blank" class="text-light" href="https://www.facebook.com/GoogleClubIsitcom"><i style="font-size: 30px;" class="fa-brands fa-facebook"></i></a>   
                            <a target="_blank" class="text-light" href="https://www.instagram.com/isitcomgoogleclub/"><i style="font-size: 30px;" class="fa-brands fa-instagram px-3"></i></a>
                            <a target="_blank" class="text-light" href="https://www.linkedin.com/company/isitcom-google-club/mycompany/"><i style="font-size: 30px;" class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <!-- IGC  -->

                <!-- Enactus -->
                <div class="carousel-item" style="background-image:url('imgs/club_carousel/bg-enactus.jpg')">
                    <div class="container">
                        <h2>Enactus</h2>
                        <p class="lead">Créé le 3 Avril 2021.</p>
                        <p>Notre club vise à Développer les talents des étudiants grâce au travail d'équipe et améliorer leurs capacités grâce à nos expériences</p>
                        <p>Nous proposons des formations, des workshops, nous organisons et participons à des événements et challenges technologiques</p>
                        <div class="social-media">
                            <a target="_blank" class="text-light" href=""><i style="font-size: 30px;" class="fa-brands fa-facebook"></i></a>   
                            <a target="_blank" class="text-light" href=""><i style="font-size: 30px;" class="fa-brands fa-instagram px-3"></i></a>
                            <a target="_blank" class="text-light" href=""><i style="font-size: 30px;" class="fa-brands fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <!-- Enactus -->

                <!-- Securinet  -->
                <div class="carousel-item" style="background-image:url('imgs/club_carousel/bg-securinet.jpg')">
                    <div class="container">
                        <h2>Sécurinet</h2>
                        <p class="lead">Créé le 3 Avril 2018.</p>
                        <p>Notre club vise à Développer les talents des étudiants grâce au travail d'équipe et améliorer leurs capacités grâce à nos expériences</p>
                        <p>Nous proposons des formations, des workshops, nous organisons et participons à des événements et challenges technologiques</p>
                        <div class="social-media">
                            <a target="_blank" class="text-light" href="https://www.facebook.com/SecurinetsClub/?ref=page_internal"><i style="font-size: 30px;" class="fa-brands fa-facebook"></i></a>   
                        </div>
                    </div>
                </div>
                <!-- Securinet  -->

                <!-- Tunivision -->
                <div class="carousel-item" style="background-image:url('imgs/club_carousel/bg-tunivision.jpg')">
                    <div class="container">
                        <h2 class="tunivision">Tunivision</h2>
                        <p class="lead">Créé le 9 Novembre 2017.</p>
                        <p>Notre club vise à Impliquer le plus possible l'étudiant dans la vie sociale et collective afin de sculpter une personnalité sociale plus intégrée</p>
                        <p>Nous proposons des formations, des workshops, nous organisons et participons à des événements et challenges technologiques</p>
                        <div class="social-media">
                            <a target="_blank" class="text-light" href="https://www.facebook.com/Club-Tunivisions-Isitcom-1996061107274823/"><i style="font-size: 30px;" class="fa-brands fa-facebook"></i></a>   
                        </div>
                    </div>
                </div>
                <!-- Tunivision -->
            </div>
            
        </div>
    </section>
    <!-- Clubs -->



    <footer class="bg-dark text-center text-white">
        <!-- Copyright -->
        <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
            &copy; 2022 Copyright: Projet Fédérer
        </div>
        <!-- Copyright -->
    </footer>

    <!-- JS -->
    <script src="js/all.min.js?v=<?php echo time(); ?>"></script>
    <script src="js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>
    <script src="js/main.js?v=<?php echo time(); ?>"></script>
</body>
</html>