<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


    if($_SERVER['REQUEST_METHOD'] == 'POST')
    {
        require('bdd/connBdd.php');
        $data = json_decode(file_get_contents("php://input"));

        $postPseudo = $data -> pseudo;
        $pwd = sha1($data -> pwd);
        $pwd2 = sha1($data -> pwd2);

        if (!empty($postPseudo) && !empty($pwd) && !empty($pwd2))
        {
            $pseudolength = strlen($postPseudo);
            if ($pseudolength <= 255)
            {
                $reqPseudo = $pdo -> prepare('SELECT * FROM users WHERE pseudo = ?');
                $reqPseudo -> execute(array($postPseudo));
                $pseudoExist = $reqPseudo -> rowCount();

                if ($pseudoExist == 0)
                {
                    if ($pwd == $pwd2)
                    {
                        $req = $pdo -> prepare('INSERT INTO users (pseudo, password) VALUES(?, ?)');
                        $req -> execute(array($postPseudo, $pwd));
                        if ($req === false)
                        {
                            http_response_code(418);
                        }
                        else
                        {
                            http_response_code(200);
                            echo json_encode(["message" => "Compté créé"]);
                        }
                    }
                    else
                    {
                        http_response_code(418);
                        echo json_encode(["message" => "Mots de passes non égaux"]);
                    }
                }
                else
                {
                    http_response_code(418);
                    echo json_encode(["message" => "Pseudo déjà existant"]);
                }
            }
            else
            {
                http_response_code(418);
                echo json_encode(["message" => "Pas plus de 255 caractères pour le pseudo"]);
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

