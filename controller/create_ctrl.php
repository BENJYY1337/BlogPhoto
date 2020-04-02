<?php
session_start();
if (!(isset($_POST['Envoyer']))) {
    //var_dump($_POST);
    $mail = htmlspecialchars($_POST['mail']);
    $password = htmlspecialchars(hash('Whirlpool', $_POST['mot_de_passe'])); // hash pour la sécurité du pw
    /**
     * fonction create_user dans la bdd
     *
     * @param  mixed $mail
     * @param  mixed $password
     * @return void
     */
    function create_user($mail, $password)
    {
        //connexion à la base de données
        $DB_NAME = "blog_photo"; //database_name
        $DB_DSN = "mysql:host=127.0.0.1:3308;dbname=" . $DB_NAME; //database_datasourcename
        $DB_USER = "root"; //database_user
        $DB_PASSWORD = ""; //database_mot_de_passe
        try {
            $bdd = new PDO($DB_DSN, $DB_USER, $DB_PASSWORD);
            $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Configure un attribut PDO
            //insertion dans la base de données
            $query = $bdd->prepare("SELECT mail FROM user WHERE mail=:mail");
            $query->execute(array(':mail' => $mail));
            $val = $query->fetch();
            if ($val != null) {
                $query->closeCursor();
                return (-1);
            }
            $query->closeCursor();
            $query = $bdd->prepare("INSERT INTO user (mail, password) VALUES (:mail, :password)");
            $query->execute(array(':mail' => $mail, ':password' => $password));
            return (0);
        } catch (PDOException $e) {
        }
    }
    if (($val = create_user($mail, $password)) == -1) {
        echo "mail already exist !";
    } else {
        $_SESSION['mail'] = $mail;
        header('Location: ../index.php');
    }
}
