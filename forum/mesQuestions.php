<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('../login.php');</script>";
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
if($_SESSION['role']=='admin'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM admin  WHERE id= '$id' "));
    $questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='1' AND is_user='0' ORDER BY id DESC"),  MYSQLI_ASSOC);
}
if($_SESSION['role']=='etudiant'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id' "));
    $questions = mysqli_fetch_all(mysqli_query($db , "SELECT * FROM questions WHERE id_auteur='$id ' AND is_admin='0' AND is_user='1' ORDER BY id DESC"),  MYSQLI_ASSOC);
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
    <link rel="stylesheet" href="../css/forum.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar-forum.css?v=<?php echo time(); ?>">

    <title>N'hésitcom | mes articles</title>
</head>
<body>
    <!-- Nav-bar -->
<nav class="navbar navbar-dark bg-dark navbar-expand-lg">
    <div class="container">
        <a class="navbar-brand" href="#"><i class="fa-solid fa-comments"></i> FORUM</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
            <i class="icon fa-solid fa-bars"></i>
        </button>
        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav mb-2 mb-lg-0 ">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Les articles</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="publier.php">Publier un articles</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link active" href="mesQuestions.php"><i class="fa-solid fa-user"></i>
                    Mes articles
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../index.php"><i class="fa-solid fa-house"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="../php/logout.php"><i class="fa-solid fa-arrow-right-from-bracket"></i>  </a>
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- Nav-bar -->

<div class="container">
    <?php foreach($questions as $question): ?>
            <div class="card my-3">
            <div class="card-header d-flex justify-content-between">
                <div class="titre">
                    <?=  $question['titre'] ?>
                </div> 
                <div class="span-card">
                    <?php if($question['approved']==1){?>
                        <span class="text-success"><i class="fa-solid fa-check"></i> Publié</span>
                    <?php } else{ ?>
                        <span class="text-danger"><i class="fa-solid fa-clock"></i> En attente</span>
                    <?php } ?>
                </div>
            </div>
            <div class="card-body">
                <p class="card-text">
                    <?=  $question['contenu']; ?>
                </p>
                <a href="modif.php?id=<?= $question['id'] ?>" class="btn me-2 btn-primary rounded-pill"><i class="fa-solid fa-pen"></i> Modifer</a>
                <a onclick="return confirm('Voulez-vous vraimet supprimer cet article ?')" href="../php/supp-question.php?id=<?= $question['id'] ?>" class="btn btn-danger rounded-pill"><i class="fa-solid fa-trash-can"></i> Supprimer</a>
            </div>
        </div>
    <?php endforeach; ?>
</div>

</body>
</html>