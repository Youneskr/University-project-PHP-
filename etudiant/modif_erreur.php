<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
if ($_SESSION['role'] != 'etudiant' ) {
    header("Location: ../error.php");
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
$info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id' "));
$pub_questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='0' AND is_user='1'AND approved='1' ORDER BY id DESC"),  MYSQLI_ASSOC);
$att_questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='0' AND is_user='1'AND approved='0' ORDER BY id DESC"),  MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="../css/profil.css?v=<?php echo time(); ?>">
    <title>N'hésitcom | Modifier Profile</title>
</head>
<body>
<div class="container">
    <div class="main-body">
        <!-- Top-links -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="../home.php">Accueil</a></li>
                <li class="breadcrumb-item"><a href="profil"><a href="profil.php">Profile</a></li>
                <li class="breadcrumb-item active" aria-current="page">Modifier le profile</li>
            </ol>
        </nav>
        <!-- /Top-links -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $info['Prenom'].' '.$info['Nom'] ?></h4>
                                <p class="text-secondary mb-1"><?= $_SESSION['role'] ?>(e)</p>
                                <button class="btn btn-outline-primary">Changer la Photo de profile</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook mr-2 icon-inline text-primary"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>Facebook</h6>
                            <span class="text-secondary">Aucun compte associé</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-instagram mr-2 icon-inline text-danger"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line></svg>Instagram</h6>
                            <span class="text-secondary">Aucun compte associé</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
                            <h6 class="mb-0"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter mr-2 icon-inline text-info"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>Twitter</h6>
                            <span class="text-secondary">Aucun compte associé</span>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <form action="../php/modif_user.php" method="POST">
                        <div class="card-body">
                            <!-- Nom Prenom -->
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">Nom et Prénom</h6></div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Nom" type="text" class="form-control mb-1" value="<?= $info['Nom'] ?>">
                                    <input name="Prenom" type="text" class="form-control" value="<?= $info['Prenom'] ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- Nom Prenom -->

                            
                            <!-- Email -->
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Email" type="text" class="form-control" value="<?= $info['Email'] ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- Email -->
                            
                            <!-- Fil -->
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">Filliére</h6></div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Fil" type="text" class="form-control" value="<?= $info['Fil'] ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- Fil -->

                            <!-- Niveau -->
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">Niveau</h6></div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="Niveau" type="text" class="form-control" value="<?= $info['Niveau'] ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- Niveau -->
                            
                            <!-- CIN -->
                            <div class="row">
                                <div class="col-sm-3"><h6 class="mb-0">CIN</h6></div>
                                <div class="col-sm-9 text-secondary">
                                    <input name="CIN" type="text" class="form-control" value="<?= $info['CIN'] ?>">
                                </div>
                            </div>
                            <hr>
                            <!-- CIN -->
                            
                            <!-- Mot de passe -->
                            <div class="row">
                                <div class="input-group">
                                    <div class="col-sm-3"><h6 class="mb-0">Mot de passe</h6></div>
                                    <input type="password" name="Password" id="Password" class="form-control" placeholder="Confirmation">
                                </div>
                                <div class="form-text text-danger mb-2">Confirmation de mot de passe incorrect</div>
                            </div>
                            <hr>
                            <!-- Mot de passe -->
                            
                            <!-- Buttons -->
                            <div class="row">
                                <div class="col-sm-12">
                                    <input class="btn btn-success" name="modif" type="submit" value="Appliquer">
                                    <input class="btn btn-danger" type="reset" value="Annuler">
                                </div>
                            </div>
                            <!-- Buttons -->
                        </div>
                    </form>
                </div>

                <div class="row gutters-sm">
                    <div class="col-sm-12 mb-3">
                        <div class="card h-100">
                            <div class="card-body">
                                <h6 class="d-flex align-items-center mb-3">Mes activités</h6>
                                <!-- Pub-Article -->
                                <div class="pub-article">
                                    <i class="material-icons text-success mr-2">Article Publié(s)</i>
                                    <hr>
                                    <?php foreach($pub_questions as $pub_question): ?>
                                        <div class="article">
                                            <div class="article-title text-secondary fw-bold">
                                                <?=  $pub_question['titre'] ?>
                                            </div>
                                            <?=  $pub_question['contenu']; ?>                                        
                                        </div>
                                    <?php endforeach; ?>
                                    <hr>
                                </div>
                                <!-- Pub-Article -->
                                <br>
                                <div class="progress mb-3" style="height: 5px">
                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 100%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <!-- Att-Article -->
                                <div class="att-article">
                                    <i class="material-icons text-danger mr-2">Article en attentes(s)(s)</i>
                                    <hr>
                                    <?php foreach($att_questions as $att_question): ?>
                                        <div class="article">
                                            <div class="article-title text-secondary fw-bold">
                                                <?=  $att_question['titre'] ?>
                                            </div>
                                            <?=  $att_question['contenu']; ?>                                        
                                        </div>
                                    <?php endforeach; ?>
                                    <hr>
                                </div>
                                <!-- Att-Article -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>    
    <!-- JS -->
    <script src="../js/all.min.js?v=<?php echo time(); ?>"></script>
    <script src="../js/bootstrap.bundle.min.js?v=<?php echo time(); ?>"></script>
</body>
</html>