<?php

require('model/model.php');

function listArticles()
{
    $articles = getArticles();
    require('view/IndexView.php');
}

function oneArticle()
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    else
    {
        $comments = getComments($_GET['id']);
        require('view/articleView.php');
    }
}

function oneComment()
{
    $article = getArticle($_GET['id']);
    $comment = getComment($_GET['id_comment']);

    if ($comment === false)
    {
        throw new Exception('404 (comment)');
    }
    elseif ($article === false)
    {
        throw new Exception('404 (article with comment)');
    }
    else
    {
        require('view/commentView.php');
    }
}

function getDroits()
{
    $users = getUsers();
    require('view/droitView.php');
}

function get_user()
{
    $user = getUser($_GET['id_user']);

    if ($user === false)
    {
        throw new Exception('404 (user)');
    }
}

function put_Droits($taskOption)
{
    $user = getUser($_GET['id_user']);

    if ($user === false)
    {
        throw new Exception('404 (user)');
    }
    else
    {
        $movedLines = putDroits($_GET['id_user'], $taskOption);

        if ($movedLines === false)
        {
            throw new Exception('put_droits');
        }
        else
        {
            header("Location: /index.php?action=Droits");
        }
    }
}

function getLogin()
{
    require('view/loginView.php');
}

function postLogin($postPseudo, $postPwd)
{
    require('model/modelLogin.php');

    $returnedJwt = Login($postPseudo, $postPwd);

    if (isset($returnedJwt))
    {
        header("Location: index.php");
    }
    else
    {
        $error = "mauvais pseudo ou mdp";
        require('view/loginView.php');
    }
}

function getInscription()
{
    require('view/inscriptionView.php');
}

function postInscription($postPseudo, $postPwd, $postPwd2)
{
    require('model/model_inscription.php');
    Inscription($postPseudo, $postPwd, $postPwd2);
}

function getError($e)
{
    require('view/error.php');
}

function add_article($title, $content, $pseudo)
{
    $movedLines = postArticle($title, $content, $pseudo);

    if ($movedLines === false)
    {
        throw new Exception('add_article');
    }
    else
    {
        header("Location: /index.php?action=Articles");
    }
}

function add_comment($pseudo, $content)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    else
    {
        $movedLines = postComment($pseudo, $content, $_GET['id']);

        if ($movedLines === false)
        {
            throw new Exception('add_comment');
        }
        else
        {
            $id_article = $_GET['id'];
            header("Location: /index.php?action=Article&id=$id_article");
        }
    }
}

function put_article_content($content, $Newpseudo)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    else
    {
        $movedLines = putArticle_content($content, $Newpseudo, $_GET['id']);

        if ($movedLines === false)
        {
            throw new Exception('put_article_content');
        }
        else
        {
            $id_article = $_GET['id'];
            header("Location: /index.php?action=Article&id=$id_article");
        }
    }
}

function put_article_title($title, $Newpseudo)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    else
    {
        $movedLines = putArticle_title($title, $Newpseudo, $_GET['id']);

        if ($movedLines === false)
        {
            throw new Exception('put_article_title');
        }
        else
        {
            $id_article = $_GET['id'];
            header("Location: /index.php?action=Article&id=$id_article");
        }
    }
}

function put_comment($content, $Newpseudo)
{
    $article = getArticle($_GET['id']);
    $comment = getComment($_GET['id_comment']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    elseif ($comment === false)
    {
        throw new Exception('404 (comment)');
    }
    else
    {
        $movedLines = putComment($content, $Newpseudo, $_GET['id_comment']);

        if ($movedLines === false)
        {
            throw new Exception('put_comment');
        }
        else
        {
            $id_article = $_GET['id'];
            $id_comment = $_GET['id_comment'];
            header("Location: /index.php?action=Get_comment&id=$id_article&id_comment=$id_comment");
        }
    }
}

function delete_article()
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    else
    {
        $movedLines = deleteArticle($_GET['id']);
        $movedLines2 = deleteArticle_comments($_GET['id']);

        if ($movedLines === false && $movedLines2 === false)
        {
            throw new Exception('delete_article');
        }
        else
        {
            header("Location: /index.php?action=Articles");
        }
    }
}

function delete_comment()
{
    $article = getArticle($_GET['id']);
    $comment = getComment($_GET['id_comment']);

    if ($article === false)
    {
        throw new Exception('404 (article)');
    }
    elseif ($comment === false)
    {
        throw new Exception('404 (comment)');
    }
    else
    {
        $movedLines = deleteComment($_GET['id_comment']);

        if ($movedLines === false)
        {
            throw new Exception('delete_comment');
        }
        else
        {
            $id_article = $_GET['id'];
            header("Location: /index.php?action=Article&id=$id_article");
        }
    }
}
