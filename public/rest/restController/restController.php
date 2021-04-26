<?php

// SANDBOX JSON //

// GET

function getArticlesJson()
{
    $articles = getArticles();
    require('rest/restFiles/getArticlesJson.php');
}

function getOneArticleJson()
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
    }
    else
    {
        require('rest/restFiles/getOneArticleJson.php');
    }
}

function getCommentsJson()
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
    }
    else
    {
        $comments = getComments($_GET['id']);
        require('rest/restFiles/getCommentsJson.php');
    }
}

function getOneCommentJson()
{
    $comment = getComment($_GET['id_comment']);

    if ($comment === false)
    {
        http_response_code(404);
    }
    else
    {
        require('rest/restFiles/getOneCommentJson.php');
    }
}

function getDroitsUsersJSON()
{
    $users = getUsers();

    if ($users === false)
    {
        http_response_code(404);
    }
    else
    {
        require('rest/restFiles/getDroitsUsersJson.php');
    }
}

// POST

function postArticleJson($pseudo)
{
    require('rest/restFiles/postArticleJson.php');
    add_article_json($pseudo);
}

function postLoginJson()
{
    require('rest/restFiles/postLoginJson.php');

    $returnedJwt = post_login_json();

    if (isset($returnedJwt))
    {
        http_response_code(200);
    }
    else
    {
        http_response_code(401);
    } 
}

function postInscriptionJson()
{
    require('rest/restFiles/postInscriptionJson.php');
}

function postCommentJson($pseudo)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article non trouvé, changez d'id"]);
    }
    else
    {
        require('rest/restFiles/post_commentJson.php');
        post_commentJson($pseudo);
    }
}

function postLogoutJson()
{
    require('rest/restFiles/postLogoutJson.php');
}

// PUT

function putDroitsUsersJSON()
{
    $user = getUser($_GET['id_user']);

    if ($user === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Utilisateur non trouvé"]);
    }
    else
    {
        require('rest/restFiles/putDroitsUsersJson.php');
    }
}

function putArticleContentJson($Newpseudo)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article non trouvé, changez d'id"]);
    }
    else
    {
        require('rest/restFiles/put_content_articleJson.php');
        put_article_contentJson($Newpseudo);
    }
}

function putArticleTitleJson($Newpseudo)
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article non trouvé, changez d'id"]);
    }
    else
    {
        require('rest/restFiles/put_title_articleJson.php');
        put_article_titleJson($Newpseudo);
    }
}

function putCommentJson($Newpseudo)
{
    $article = getArticle($_GET['id']);
    $comment = getComment($_GET['id_comment']);

    if ($article === false &&  $comment === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article ou commentaire non trouvé, changez les id"]);
    }
    else
    {
        require('rest/restFiles/put_commentJson.php');
        put_commentJson($Newpseudo);
    }
}

// DELETE

function delete_articleJson()
{
    $article = getArticle($_GET['id']);

    if ($article === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article non trouvé, changez d'id"]);
    }
    else
    {
        require('rest/restFiles/del_articleJson.php');
    }
}

function delete_commentJson()
{
    $article = getArticle($_GET['id']);
    $comment = getComment($_GET['id_comment']);

    if ($article === false &&  $comment === false)
    {
        http_response_code(404);
        header("Content-Type: application/json; charset=UTF-8");
        echo json_encode(["message" => "Article ou commentaire non trouvé, changez les id"]);
    }
    else
    {
        require('rest/restFiles/del_commentJson.php');
    }
}