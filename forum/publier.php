<?php
session_start();
if (!isset($_SESSION['id'])) {
    echo "<script type='text/javascript'>document.location.replace('../login.php');</script>";
}
$db = mysqli_connect('localhost' , "root" , "" , "isitc");
$id = $_SESSION['id'] ;
if($_SESSION['role']=='admin'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM admin  WHERE id= '$id' "));
}
if($_SESSION['role']=='etudiant'){
    $info = mysqli_fetch_assoc(mysqli_query($db , "SELECT * FROM users  WHERE id= '$id' "));
}
if (isset($_POST['validate'])){
    if(!empty($_POST['titre']) AND !empty($_POST['description']) AND !empty($_POST['contenu'])){
        
        //Les données de la question
        $titre = htmlspecialchars($_POST['titre']);
        $description =nl2br(htmlspecialchars($_POST['description']));
        $contenu = nl2br(htmlspecialchars($_POST['contenu']));
        $date = date('d/m/Y');
        if($_SESSION['role']=='admin'){
            $is_admin=1;
            $is_user=0;
            $approved=1;
        }
        else{
            $is_admin=0;
            $is_user=1;
            $approved=0;
        }
        $id_auteur = $_SESSION['id'];
        //Insérer la question sur la question
        $sql = "INSERT INTO questions (titre, description,contenu, is_admin, is_user, id_auteur, approved, date) 
				VALUES ('$titre','$description','$contenu','$is_admin','$is_user','$id_auteur','$approved','$date')";
        mysqli_query($db , $sql);
        $successMsg = "Votre question a bien été publiée sur le site";
    }else{
        $errorMsg = "Veuillez compléter tous les champs...";
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
    <link rel="stylesheet" href="../css/forum.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../css/navbar-forum.css?v=<?php echo time(); ?>">
    <title>N'hésitcom | publier un article</title>
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

<form action="publier.php" method="POST" class="container py-5" >
        
        <div class="mb-3">
            <label for="titre" class="form-label">Titre de la question</label>
            <input id="titre" type="text" class="form-control" name="titre">
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Description de la question</label>
            <textarea id="description" class="form-control" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="contenu" class="form-label">Contenu de la question</label>
            <textarea id="contenu" type="text" class="form-control" name="contenu"></textarea>
        </div>

        <button type="submit" class="btn btn-primary" name="validate">Publier la question</button>
        <?php 
            if(isset($errorMsg)){ 
                echo '<p class="text-danger fw-bold py-3">'.$errorMsg.'</p>'; 
            }elseif(isset($successMsg)){ 
                echo '<p class="text-success fw-bold py-3">'.$successMsg.'</p>'; 
            }
        ?>
</form>

    <!-- JS -->
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>