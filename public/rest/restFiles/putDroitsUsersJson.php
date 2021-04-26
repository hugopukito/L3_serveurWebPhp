<?php


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: PUT");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'PUT')
    {
        $data = json_decode(file_get_contents("php://input"));

        if (!empty($role = $data -> role))
        {
            if ($role == 'Admin' || $role == 'Banned' || $role == 'Subscriber')
            {
                $movedLines = putDroits($_GET['id_user'], $role);

                if ($movedLines === false)
                {
                    http_response_code(418);
                }
                else
                {
                    http_response_code(200);
                    echo json_encode(["message" => "Mise à jour de l'utilisateur faite"]);
                }
            }
            else
            {
                echo json_encode(["message" => "test"]);
                http_response_code(418);
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

