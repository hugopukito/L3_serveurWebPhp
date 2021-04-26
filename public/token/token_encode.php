<?php

//auto load

require '../vendor/autoload.php';
use \Firebase\JWT\JWT;

            $secret_key = "YOUR_SECRET_KEY";
            $issuer_claim = "pukito_boi"; // this can be the servername
            $audience_claim = "my";
            $issuedat_claim = time(); // issued at
            $notbefore_claim = $issuedat_claim; //not before in seconds
            $expire_claim = $issuedat_claim + 3600; // expire time in seconds
            $token = array(
                "iss" => $issuer_claim,
                "aud" => $audience_claim,
                "iat" => $issuedat_claim,
                "nbf" => $notbefore_claim,
                "exp" => $expire_claim,
                "data" => array(
                    "id" => $id,
                    "pseudo" => $pseudo,
                    "role" => $role
            ));

            $jwt = JWT::encode($token, $secret_key);
            setcookie('token', $jwt, time() + 3600, null, null, false, true);

?>