<?php

function post_commentJson($pseudo)
{

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($content = $data -> content) && !empty($pseudo))
        {
            $movedLines = postComment($pseudo, $content, $_GET['id']);

            if ($movedLines === false)
            {
                http_response_code(418);
            }
            else
            {
                http_response_code(200);
                echo json_encode(["message" => "Commentaire créé"]);
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
        echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du POST"]);
    }
}
