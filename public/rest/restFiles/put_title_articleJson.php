<?php

function put_article_titleJson($Newpseudo)
{

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($title = $data -> title) && !empty($Newpseudo))
        {
            $movedLines = putArticle_title($title, $Newpseudo, $_GET['id']);

            if ($movedLines === false)
            {
                http_response_code(418);
            }
            else
            {
                http_response_code(200);
                echo json_encode(["message" => "Article mis à jour"]);
            }
        }
        else
        {
            http_response_code(418);
        }
    }
    else
    {
        http_response_code(405);
        echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du PUT"]);
    }
}
