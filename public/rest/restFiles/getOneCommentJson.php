<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $tbComment = [];
    $tbComment['comment'] = [];

    
        $comm = [
            "id" => $comment -> id,
            "pseudo" => $comment -> pseudo,
            "content" => $comment -> content,
            "date" => $comment -> date,
            "id_article" => $comment -> id_article,
            "pseudo_user_modif" => $comment -> pseudo_user_modif,
            "date_modif" => $comment -> date_modif
        ];

        $tbComment['comment'][] = $comm;
        
    http_response_code(200);
    echo json_encode($tbComment);
}
else
{
    http_response_code(405);
    echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du GET"]);
}

?>