<?php

$file_name = "";
$title = "";
$text = "";

//On se connecte
$DB_NAME = "blog_photo"; //database_name
$DB_DSN = "mysql:host=127.0.0.1:3308;dbname=" . $DB_NAME; //database_datasourcename
$DB_USER = "root"; //database_user
$DB_PASSWORD = ""; //database_mot_de_passe

try {
    $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
    $query = $bdd->prepare("SELECT * FROM picture");
    $query->execute(); // Exécute une requête préparée
    $result = $query->fetchAll();
    //var_dump($result);
} catch (PDOException $e) {
}


?>





<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>World of Faces</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="gallery-clean.css">


</head>

<body>

    <div class="container gallery-container main">

        <h1>World of faces</h1>

        <p class="page-description text-center">Chino</p>

        <div class="tz-gallery">

            <div class="row">
                <?php
                foreach ($result as $row) {
                ?>
                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <a class="lightbox" href="images/<?php echo $row['file_name']; ?>">
                                <img src="images/<?php echo $row['file_name']; ?>" alt="Celtes">
                            </a>
                            <div class="caption">
                                <h3><?php echo $row['title'] ?></h3>
                                <p><?php echo $row['text'] ?></p>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>

        </div>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
</body>

</html>