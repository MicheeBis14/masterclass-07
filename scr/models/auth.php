<?php
session_start();
$_SESSION['error'] = [];

// require_once "../../data/connexion.php";


function Connexion($dbname, $host = "127.0.0.1", $root = "root", $key = "")
{

    $pdo = new PDO("mysql:host={$host}; dbname={$dbname}; charset=UTF8", "{$root}", "{$key}");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}
/**
 * @param {string} $fullName c'est le nom complet de l'utilsateur
 * @param {string} $email c'est l'adresse mail de l'utilisateur 
 * @param {string} $password mot de passe de l'utilsateur
 * @param {string} $register variable boolean qui renvoit true so un utilisateur est ajouté et non au cas contraire
 */
function registerUser($fullName, $email, $username, $password)
{
    $db = Connexion("session_data");

    $query = "INSERT INTO users(nom,email,username,pass) VALUES(?,?,?,?)";
    $stmnt = $db->prepare($query);
    $stmnt->execute(array($fullName,$email,$username,$password));

    // $stmnt->execute([$fullName,$email,$username,$password]);

    if ($stmnt) {

        $_SESSION['user'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['email'] = $email;
        $_SESSION['name'] = $fullName;

        // echo "<script> alert('Utilisateur ajouté avec succès')</script>";
        echo "<script> alert('Utilisateur ajouté avec succès'),window.location='../../pages/profil.php'</script>";
    } else {
        echo "<script> alert('Echec'),window.location='../../index.php'</script>";
    }


    // $_SESSION['name'] = $fullName;
    // $_SESSION['email'] = $email;
    // $_SESSION['password'] = password_hash($password, PASSWORD_BCRYPT);
    // $_SESSION['user'] = $username;

    // $_SESSION["error"] = [];

    // $_SESSION["PASS"] = password_hash($password, PASSWORD_BCRYPT);
    // $_SESSION["USER"] = $username;

    // echo " Enregistrement reussi ";
    // header('location:../../pages/profil.php');

    return $stmnt;
}
/**
 * @param {string} $username nom d'utilisateur
 * @param {string} $password mot de passe utilsateur
 * 
 */

function loginUser($username, $password)
{

    $db = Connexion("session_data");
    $query  = "SELECT * FROM users WHERE username = ?";
    $stmnt = $db->prepare($query);
    $stmnt->execute(array($username));

    if ($stmnt->rowCount() > 0) {

        $data = $stmnt->fetch();

        if (password_verify($password, $data['pass'])) {

            $_SESSION['user'] = $username;
            $_SESSION['email'] = $password;
            $_SESSION['name'] = $data['nom'];

            header('location:../../pages/profil.php');
        } else {
            echo "<script>alert('Mot de passe incorrect'),window.location.href='../../index.php'</script>";
        }
    } else {
        echo "<script>alert('Username incorrect')</script>";
    }

    // if ($stmnt["username"] === $username) {

    //     if (password_verify($password, $stmnt["pass"])) {

    //         header('location:../../pages/profil.php');
    //     } else {
    //         // echo "<script>alert('Mot de passe incorrect'),window.location.href='../../index.php'</script>";
    //         echo $_SESSION["error"] = 'Mot de passe incorrect';
    //         header('location:../../index.php');
    //     }
    // } else {
    //     // echo "<script> alert('Username incorrect'),window.location.href='../../index.php'</script>";
    //     // header('location:../../index.php');
    //     echo $_SESSION["error"] = 'Username incorrect';
    //     header('location:../../index.php');
    // }
}
