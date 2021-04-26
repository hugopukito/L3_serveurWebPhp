<?php

// clef secrète d'encodage des tokens JWT

//auto load

require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

$secret_key = "YOUR_SECRET_KEY";

    try
    {
        $jwt = $_COOKIE['token'];
        $token = JWT::decode($jwt, $secret_key, array('HS256'));
        $tokenArray = (array) $token;
        $id_user = $tokenArray['data'] -> id;
        $pseudo = $tokenArray['data'] -> pseudo;
        $role = $tokenArray['data'] -> role;
    }
    catch (Exception $e)
    {
        $error = $e->getMessage();
        echo 'Accès refusé mauvais token jwt';
        echo $error;
    }

?>