<?php

function Login($postPseudo, $postPwd)
{
    require('bdd/connBdd.php');
    
    $pseudo = htmlspecialchars($postPseudo);
    $password = sha1($postPwd);

    $requsr = $pdo -> prepare('SELECT * FROM users WHERE pseudo = ? AND password = ?');
    $requsr -> execute(array($pseudo, $password));

    $usrExist = $requsr -> rowCount();
    if($usrExist == 1)
    {
        $row = $requsr -> fetch();

        $id = $row['id'];
        $pseudo = $row['pseudo'];
        $role = $row['role'];

        require('token/token_encode.php');
        return $jwt;
    }
}
