<?php
session_start();
if (!(isset($_POST['Envoyer']))) {
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars(hash('Whirlpool', $_POST['mot_de_passe'])); // hash pour la sécurité du pw
}
/**
 * fonction log_user dans la bdd
 *
 * @param  mixed $mail
 * @param  mixed $password
 * @return void
 */
function log_user($mail, $password)
{
    // on se connecte a la base
    $DB_NAME = "blog_photo"; //database_name
    $DB_DSN = "mysql:host=127.0.0.1:3308;dbname=" . $DB_NAME; //database_datasourcename
    $DB_USER = "root"; //database_user
    $DB_PASSWORD = ""; //database_mot_de_passe
    try {
        $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
        $query = $bdd->prepare("SELECT mail FROM user WHERE mail=:mail AND password=:password"); // verifie que les données rentrées sont bonnes par rapport à la bdd
        $query->execute(array(':mail' => $mail, ':password' => $password)); // Exécute une requête préparée
        $val = $query->fetch(); // recupere les valeurs preparées
        if ($val == null) {
            $query->closeCursor();
            return (-1);
        }
        $query->closeCursor();
        echo 'Read success !', '<br>';
        return ($val);
    } catch (PDOException $e) {
    }
}
if (($val = log_user($mail, $password)) == -1) {
    echo "User not found";
} else {
    $_SESSION['mail'] = $val['mail'];
    header("Location: ../index.php");
}
