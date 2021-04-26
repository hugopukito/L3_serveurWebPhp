<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'DELETE')
    {
        $movedLines = deleteComment($_GET['id_comment']);

        if ($movedLines === false)
        {
            http_response_code(418);
        }
        else
        {
            http_response_code(200);
            echo json_encode(["message" => "Commentaire supprimé"]);
        }
    }
    else
    {
        http_response_code(405);
        echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du DELETE"]);
    }

