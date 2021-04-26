<?php

function getArticles()
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT * FROM articles ORDER BY id DESC');
    $reponse->execute();
    $donnees = $reponse->fetchALL(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function getArticle($id_article)
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT * FROM articles WHERE id = ?');
    $reponse->execute(array($id_article));
    $donnees = $reponse->fetch(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function getComment($id_comment)
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT * FROM comments WHERE id = ?');
    $reponse->execute(array($id_comment));
    $donnees = $reponse->fetch(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function getComments($id_article)
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT * FROM comments WHERE id_article = ? ORDER BY id DESC');
    $reponse->execute(array($id_article));
    $donnees = $reponse->fetchALL(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function getUsers()
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT id, pseudo, role, date FROM users ORDER BY id DESC');
    $reponse->execute();
    $donnees = $reponse->fetchALL(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function getUser($id_user)
{
    require('bdd/connBdd.php');
    $reponse = $pdo->prepare('SELECT id, pseudo, role, date FROM users WHERE id = ?');
    $reponse->execute(array($id_user));
    $donnees = $reponse->fetch(PDO::FETCH_OBJ);
    return $donnees;
    $reponse->closeCursor();
}

function putDroits($id_user, $taskOption)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('UPDATE users SET role = ? WHERE id = ?');
    $movedLines = $req->execute(array($taskOption, $id_user));
    return $movedLines;
}

function postComment($pseudo, $content, $id_article)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('INSERT INTO comments (pseudo, content, date, id_article) VALUES(?, ?, NOW(), ?)');
    $movedLines = $req->execute(array($pseudo, $content, $id_article)); 
    return $movedLines;
}

function postArticle($title, $content, $pseudo)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('INSERT INTO articles (title, content, date, pseudo) VALUES(?, ?, NOW(), ?)');
    $movedLines = $req->execute(array($title, $content, $pseudo));
    return $movedLines;
}

function putArticle_content($content, $Newpseudo, $id_article)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('UPDATE articles SET content = ?, pseudo_content_modif = ?, date_modif = NOW() WHERE id = ?');
    $movedLines = $req->execute(array($content, $Newpseudo, $id_article));
    return $movedLines;
}

function putArticle_title($title, $Newpseudo, $id_article)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('UPDATE articles SET title = ?, pseudo_title_modif = ?, date_title_modif = NOW() WHERE id = ?');
    $movedLines = $req->execute(array($title, $Newpseudo, $id_article));
    return $movedLines;
}

function putComment($content, $Newpseudo, $id_comment)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('UPDATE comments SET content = ?, pseudo_user_modif = ?, date_modif = NOW() WHERE id = ?');
    $movedLines = $req->execute(array($content, $Newpseudo, $id_comment));
    return $movedLines;
}

function deleteArticle($id_article)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('DELETE FROM articles WHERE id = ?');
    $movedLines = $req->execute(array($id_article));
    return $movedLines;
}

function deleteArticle_comments($id_article)
{
    require('bdd/connBdd.php');
    $req2 = $pdo->prepare('DELETE FROM comments WHERE id_article = ?');
    $movedLines2 = $req2->execute(array($id_article));
    return $movedLines2;
}

function deleteComment($id_comment)
{
    require('bdd/connBdd.php');
    $req = $pdo->prepare('DELETE FROM comments WHERE id = ?');
    $movedLines = $req->execute(array($id_comment));
    return $movedLines;
}

