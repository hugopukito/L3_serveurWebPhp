<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $tbArticle = [];
    $tbArticle['article'] = [];

    $art = [
        "id" => $article -> id,
        "title" => $article -> title,
        "content" => $article -> content,
        "date" => $article -> date,
        "pseudo" => $article -> pseudo,
        "pseudo_content_modif" => $article -> pseudo_content_modif,
        "date_modif" => $article -> date_modif,
        "pseudo_title_modif" => $article -> pseudo_title_modif,
        "date_title_modif" => $article -> date_title_modif
    ];

    $tbArticle['article'][] = $art;

    http_response_code(200);
    echo json_encode($tbArticle);
}
else
{
    http_response_code(405);
    echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du GET"]);
}

?>