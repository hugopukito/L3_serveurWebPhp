<?php

function post_login_json()
{

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

        if (!empty($postPseudo) && !empty($pwd))
        {
            $requsr = $pdo -> prepare('SELECT * FROM users WHERE pseudo = ? AND password = ?');
            $requsr -> execute(array($postPseudo, $pwd));

            $usrExist = $requsr -> rowCount();
            if($usrExist == 1)
            {
                $row = $requsr -> fetch();

                $id = $row['id'];
                $pseudo = $row['pseudo'];
                $role = $row['role'];

                require('token/token_encode.php');

                echo json_encode(["message" => $jwt]);
                echo json_encode(["message" => "Vous êtes connecté !"]);
                http_response_code(200);

                return $jwt;
            }
            else
            {
                echo json_encode(["message" => "Mauvais pseudo ou mdp"]);
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
