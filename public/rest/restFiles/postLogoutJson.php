<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require('token/token_unset.php');
        http_response_code(200);
        echo json_encode(["message" => "Vous êtes déconnecté !"]);
    }
    else
    {
        http_response_code(405);
        echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du POST"]);
    }

