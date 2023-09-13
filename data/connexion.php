<?php
    function Connexion($dbname,$host="127.0.0.1",$root="root",$key=""){

        $pdo = new PDO("mysql:host={$host}; dbname={$dbname}; charset=UTF8", "{$root}", "{$key}");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }
?> 