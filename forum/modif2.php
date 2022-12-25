<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('../login.php');</script>";
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_GET['id'] ;
$info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM questions  WHERE id= '$id' "));


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
    <title>N'hésitcom | Forum</title>
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
                    <a class="nav-link active" href="publier.php">Publier un articles</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 ms-auto">
                <li class="nav-item">
                    <a class="nav-link " href="mesQuestions.php"><i class="fa-solid fa-user"></i>
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

<form action="../php/modif-question2.php?id=<?= $id ?>" method="POST" class="container py-5" >
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de la question</label>
            <input id="titre" value="<?= $info['titre'] ?>" type="text" class="form-control" name="titre">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description de la question</label>
            <textarea id="description" class="form-control" name="description"><?= $info['description'] ?></textarea>
        </div>
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu de la question</label>
            <textarea id="contenu"  type="text" class="form-control" name="contenu"><?= $info['contenu'] ?></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="modif">Modifier l'article</button>
        
</form>

    <!-- JS -->
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>