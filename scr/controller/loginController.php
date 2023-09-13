<?php

include_once '../models/auth.php';

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (isset($_POST['btn-Submit'])) {

        if (isset($_POST["username"]) && isset($_POST["password"])) {

            $username;
            $password;

            if (empty($_POST["username"])) {

                //    echo "entre username";
                echo "<script>alert('veuillez ecrire votre username'),window.location.href='../../index.php'</script>";
            } else {

                $username = htmlspecialchars($_POST["username"]);
            }

            if (empty($_POST["password"])) {

                // echo "entre password";
                echo "<script>alert('veuillez ecrire votre mot de passe'),window.location.href='../../index.php'</script>";
            } else {

                $password = htmlspecialchars($_POST['password']);
            }
            loginUser($username, $password);
        } else {
            echo "<script>alert('Entrez vos informations'),window.location.href='../../index.php'</script>";
        }
    }
}
