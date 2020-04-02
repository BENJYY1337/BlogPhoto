<?php

/**
 * This file is part of Blogphoto-master.
 *
 * (c) Benjamin Pernot <pernot.benjamin@outlook.fr>
 *     Carlos Alvarez  <carlosalvarez8@gmail.com>
 *
 * For the full copyright and license information, please view
 * the license that is located at the bottom of this file.
 */

session_start();

// $old_sessionid = session_id();

// session_regenerate_id();

// $new_sessionid = session_id();

// echo "Ancienne Session: $old_sessionid<br />";
// echo "Nouvelle Session: $new_sessionid<br />";

// print_r($_SESSION);

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
} catch (PDOException $e) {
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Chino</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Droid+Sans:400,700" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.css">
    <link rel="stylesheet" href="gallery-clean.css">
</head>

<body>

    <!-- Trigger the modal with a button -->
    <button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Qui est Chino ?</button>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Biographie</h4>
                </div>
                <div class="modal-body">
                    <p> Chino, de son vrai nom Jean-François de la rive droite, se passionne pour la photographie dès ses 8 ans. <br /> <br />

                        Chino car cet éternel globe-trotter parcoure régulièrement les cinq continents afin de chiner pour vous des perles de beauté numériques introuvables ailleurs. <br /> <br />

                        Après un passage remarqué aux Beaux-Arts de Paris où il en sortit diplômé avec les honneurs et Major de sa promotion en 2012, il voulut sortir du chemin tout tracé auquel ses études prestigieuses l’avaient tout naturellement préparé. <br /> <br />

                        Ainsi, il entama plusieurs tours du monde dont vous trouverez sur ce site un aperçu de sa toute nouvelle collection sobrement baptisée « World of Faces ».<br /> <br />

                        Éclectique ! Tel est le qualificatif qui sied à merveille à cette brillante collection qui, cliché après cliché, vous transportera, vous emmènera loin des sentiers battus et autres pièges à touristes ; à la rencontre même de l’âme des habitants des pays qu’il a parcourus. <br /> <br />

                        Coupez votre téléphone, prenez une profonde respiration et préparez-vous à faire le voyage de votre vie à la découverte de vous-mêmes à travers le reflet du regard des autres…</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

    <!-- Button trigger modal -->
    <?php if (!(isset($_SESSION['mail']))) {
    ?>

        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop">
            Sign in
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">SIGN IN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="controller/create_ctrl.php" method="POST">
                            <div>
                                <label for="emailinput">Votre email</label>
                                <input type="email" name="mail" id="emailinput" placeholder="contact@mail.fr" required autofocus>
                            </div>
                            <div>
                                <label for="passwordinput">Votre mot de passe</label>
                                <input type="password" name="mot_de_passe" id="passwordinput" placeholder="password" required autofocus>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->
        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#staticBackdrop1">
            Log in
        </button>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop1" data-backdrop="static" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">LOG IN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="controller/read_ctrl.php" method="POST">
                            <div>
                                <label for="emailinput">Votre email</label>
                                <input type="email" name="mail" id="emailinput" placeholder="contact@mail.fr" required autofocus>
                            </div>
                            <div>
                                <label for="passwordinput">Votre mot de passe</label>
                                <input type="password" name="mot_de_passe" id="passwordinput" placeholder="password" required autofocus>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Envoyer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } else {
        setcookie("TestCookie", $_SESSION['mail'], time() + 1800);
    ?>
        <a href="controller/logout.php" type="button" class="btn btn-primary btn-sm">Log out</a>
        <span><?php echo $_SESSION['mail']; ?></span>
    <?php } ?>
    <div class="container gallery-container main">
        <h1>World of faces</h1>
        <p class="page-description text-center">Chino</p>

        <div class="tz-gallery">
            <div class="row">
                <?php
                foreach ($result as $row) {
                ?>
                    <div class="col-sm-6 col-md-4">
                        <?php if (isset($_SESSION['mail'])) {
                        ?>
                            <button type="button" type="hidden" class="btn btn-secondary center-block">Achat</button>
                        <?php } ?>
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

    <media>
        <div class="Chinotheme text-center">
            <audio controls>
                <source src="audio/Chinotheme.mp3" type="audio/mpeg">
            </audio>
        </div>
    </media>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/baguettebox.js/1.8.1/baguetteBox.min.js"></script>
    <script>
        baguetteBox.run('.tz-gallery');
    </script>
</body>
<footer class="text-center">©Chino, World of Faces sont des marques déposées. Les photos et textes de ce site ne sont pas libres de droit. </footer>

</html>

<?php

/**
 * (c) Benjamin Pernot <pernot.benjamin@outlook.fr>
 *     Carlos Alvarez  <carlosalvarez8@gmail.com>
 *
 * For the full copyright and license information, please see below:
 *
 * Copyright (c) 2020, Benjamin Pernot & Carlos Alvarez
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without modification,
 * are permitted provided that the following conditions are met:
 *
 *     * Redistributions of source code must retain the above copyright notice,
 *       this list of conditions and the following disclaimer.
 *
 *     * Redistributions in binary form must reproduce the above copyright notice,
 *       this list of conditions and the following disclaimer in the documentation
 *       and/or other materials provided with the distribution.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR CONTRIBUTORS BE LIABLE FOR
 * ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON
 * ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */
?>