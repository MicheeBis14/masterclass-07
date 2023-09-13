<?php
include_once '../models/auth.php';
if ($_SERVER['REQUEST_METHOD'] === "POST") {

    if (isset($_POST['btn-Validate'])) {


        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['username']) && isset($_POST['password'])) {

            if (!empty($_POST['name']) && !empty($_POST['email']) && !empty($_POST['username']) && !empty($_POST['password'])) {
                $name = htmlentities($_POST['name']);
                $email = htmlentities($_POST['email']);
                $username = htmlentities($_POST['username']);
                // $password = htmlentities($_POST['password']);
                $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

                registerUser($name, $email, $username, $password);

            } else {
                echo "<script> alert('ERROR,Veuillez remplir tous les champs'),window.location.href='../../pages/register.php'</script>";
            }
        }
    }
}
