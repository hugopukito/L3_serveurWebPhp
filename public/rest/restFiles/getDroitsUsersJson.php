<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Method: GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

if($_SERVER['REQUEST_METHOD'] == 'GET')
{
    $tbUsers = [];
    $tbUsers['users'] = [];

    
    foreach ($users as $user)
    {
        $use = [
            "id" => $user -> id,
            "role" => $user -> role,
            "pseudo" => $user -> pseudo,
            "date" => $user -> date
        ];

        $tbUsers['users'][] = $use;
    }
    http_response_code(200);
    echo json_encode($tbUsers);
}
else
{
    http_response_code(405);
    echo json_encode(["message" => "Mauvaise méthode, ici on n'utilise que du GET"]);
}
