<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('index.php');</script>";
}
if ($_SESSION['role'] != 'admin' ) {
    header("Location: ../error.php");
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
$info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM admin  WHERE id= '$id' "));
$pub_questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='1' AND is_user='0'AND approved='1' ORDER BY id DESC"),  MYSQLI_ASSOC);
$att_questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='1' AND is_user='0'AND approved='0' ORDER BY id DESC"),  MYSQLI_ASSOC);

$social_media = mysqli_query($db , "SELECT * FROM social_media  WHERE id_auth= '$id' ");
$links = mysqli_fetch_assoc($social_media);

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
    <title>N'hésitcom | Dashboard</title>
</head>
<body>
<div class="container">
    <div class="main-body">
        <!-- Top-links -->
        <nav aria-label="breadcrumb" class="main-breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </nav>
        <!-- /Top-links -->

        <div class="row gutters-sm">
            <div class="col-md-4 mb-3">

                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-column align-items-center text-center">
                            <img src="../imgs/avatar.jpg" alt="Admin" class="rounded-circle" width="150">
                            <div class="mt-3">
                                <h4><?= $info['Prenom'].' '.$info['Nom'] ?></h4>
                                <p class="text-secondary mb-1"><?= $_SESSION['role'] ?>(e)</p>
                            </div>
                        </div>
                    </div>
                </div>

                
            </div>

            <div class="col-md-8">
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Nom et Prénom</h6></div>
                            <div class="col-sm-9 text-secondary"><?= $info['Prenom'].' '.$info['Nom'] ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">Email</h6></div>
                            <div class="col-sm-9 text-secondary"><?= $info['Email'] ?></div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-sm-3"><h6 class="mb-0">CIN</h6></div>
                            <div class="col-sm-9 text-secondary"><?= $info['CIN'] ?></div>
                        </div>
                        <hr>
                        
                    </div>
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
                                        <hr>
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