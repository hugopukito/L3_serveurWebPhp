<?php

function Inscription($postPseudo, $postPwd, $postPwd2)
{
    require('bdd/connBdd.php');

    $pseudo = htmlspecialchars($postPseudo);
    $password = sha1($postPwd);
    $password2 = sha1($postPwd2);

        $pseudolength = strlen($pseudo);
        if ($pseudolength <= 255)
        {
            $reqPseudo = $pdo -> prepare('SELECT * FROM users WHERE pseudo = ?');
            $reqPseudo -> execute(array($pseudo));
            $pseudoExist = $reqPseudo -> rowCount();

            if ($pseudoExist == 0)
            {
                if ($password == $password2)
                {
                    $req = $pdo -> prepare('INSERT INTO users (pseudo, password) VALUES(?, ?)');
                    $req -> execute(array($pseudo, $password));
                    header("Location: index?action=Login");
                }
                else
                {
                    $error = "Mots de passes non égaux";
                    require('view/inscriptionView.php');
                }
            }
            else
            {
                $error = "Pseudo déjà existant";
                require('view/inscriptionView.php');
            }
        }
        else
        {
            $error = "Pas plus de 255 caractères pour le pseudo";
            require('view/inscriptionView.php');
        }
        
}
