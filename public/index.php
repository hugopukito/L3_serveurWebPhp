<?php
require('controller/controller.php');
require('rest/restController/restController.php');

if (isset($_COOKIE['token'])) 
{
    require('token/token_decode.php');
}

try
{
    // M V C simple

    if (isset($_GET['action'])) 
    {
        if ($_GET['action'] == 'Articles') 
        {
            listArticles();
        }

        elseif ($_GET['action'] == 'Article') 
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0) 
            {
                oneArticle();
            }
            else 
            {
                throw new Exception('404 (article)');
            }
        }

        elseif ($_GET['action'] == 'Droits')
        {
            if($role == 'Admin')
            {
                getDroits();
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif ($_GET['action'] == 'Put_droits')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id_user']) && $_GET['id_user'] >= 0)
                {
                    if (!empty($_POST['taskOption']))
                    {
                        put_Droits(htmlspecialchars($_POST['taskOption']));
                    }
                    else
                    {
                        throw new Exception('put_droits');
                    }
                } 
                else
                {
                    throw new Exception('404 (user)');
                }
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif ($_GET['action'] == 'Login')
        {
            getLogin();
        }

        elseif ($_GET['action'] == 'PostLogin')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']))
            {
                postLogin($_POST['pseudo'], $_POST['password']);
            }
            else
            {
                $error = "Tous les champs doivent être remplis";
                require('view/loginView.php');
            }
        }

        elseif ($_GET['action'] == 'Inscription')
        {
            getInscription();
        }

        elseif ($_GET['action'] == 'PostInscription')
        {
            if (!empty($_POST['pseudo']) && !empty($_POST['password']) && !empty($_POST['password2']))
            {
                postInscription($_POST['pseudo'], $_POST['password'], $_POST['password2']);
            }
            else
            {
                $error = "Tous les champs doivent être remplis";
                require('view/inscriptionView.php');
            }
        }

        elseif ($_GET['action'] == 'Add_article')
        {
            if(isset($role) && $role != 'Banned')
            {
                if (!empty($_POST['title']) && !empty($_POST['content']) && !empty($_POST['pseudo']))
                {
                    add_article(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['content']), htmlspecialchars($_POST['pseudo']));
                }
                else
                {
                    throw new Exception("add_article");
                }
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif ($_GET['action'] == 'Add_comment')
        {
            if(isset($role) && $role != 'Banned')
            {
               if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    if (!empty($_POST['pseudo']) && !empty($_POST['content']))
                    {
                        add_comment(htmlspecialchars($_POST['pseudo']), htmlspecialchars($_POST['content']));
                    }
                    else
                    {
                        throw new Exception("add_comment");
                    }
                }
                else
                {
                    throw new Exception('404 (article)');
                } 
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif ($_GET['action'] == 'Put_article')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_POST['modif_content']))
                {
                    if (isset($_GET['id']) && $_GET['id'] >= 0) 
                    {
                        if (!empty($_POST['content']) && !empty($_POST['newPseudo']))
                        {
                            put_article_content(htmlspecialchars($_POST['content']), htmlspecialchars($_POST['newPseudo']));
                        }
                        else
                        {
                            throw new Exception("put_article_content");
                        }
                    }
                    else
                    {
                        throw new Exception('404 (article)');
                    }
                }
                if (isset($_POST['modif_title']))
                {
                    if (isset($_GET['id']) && $_GET['id'] >= 0) 
                    {
                        if (!empty($_POST['title']) && !empty($_POST['newPseudo']))
                        {
                            put_article_title(htmlspecialchars($_POST['title']), htmlspecialchars($_POST['newPseudo']));
                        }
                        else
                        {
                            throw new Exception("put_article_title");
                        }
                    }
                    else
                    {
                        throw new Exception('404 (article)');
                    }
                }
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif($_GET['action'] == 'Delete_article')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0)
            {
                if(isset($role) && $role == 'Admin')
                {
                    delete_article();
                }
                else
                {
                    throw new Exception('Permission denied');
                }
            }
            else
            {
                throw new Exception('404 (article)');
            }
        }

        elseif($_GET['action'] == 'Get_comment')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0) 
            {
                if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0) 
                {
                    oneComment();
                }
                else
                {
                    throw new Exception('404 (comment)');
                }
            }
            else
            {
                throw new Exception('404 (article)');
            }
            
        }

        elseif($_GET['action'] == 'Put_comment')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0)
                    {
                        if (!empty($_POST['content']) && !empty($_POST['newPseudo']))
                        {
                            put_comment(htmlspecialchars($_POST['content']), htmlspecialchars($_POST['newPseudo']), $_GET['id_comment']);
                        }
                        else
                        {
                            throw new Exception("put_comment");
                        }
                    }
                    else
                    {
                        throw new Exception('404 (comment)');
                    }   
                }
                else
                {
                    throw new Exception('404 (article)');
                }
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif($_GET['action'] == 'Delete_comment')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0)
                {
                    if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0)
                    {
                        delete_comment();
                    }
                    else
                    {
                        throw new Exception('404 (comment)');
                    }
                }
                else
                {
                    throw new Exception('404 (article)');
                }
            }
            else
            {
                throw new Exception('Permission denied');
            }
        }

        elseif($_GET['action'] == 'Deconnexion')
        {
            require('token/token_unset.php');
        }

        else
        {
            listArticles();
        }
    }

    // SANDBOX JSON, pour faire des requêtes nécessitant des droits, générer le token de session avec 'PostLoginJson' 
    // qui se stockera dans un cookie (pseudo: admin, pwd: admin | slt si le compte admin est créé en bdd) 

    elseif(isset($_GET['rest']))
    {

        // GET

        if ($_GET['rest'] == 'Get_ArticlesJson')
        {
            getArticlesJson();
        }

        elseif ($_GET['rest'] == 'Get_ArticleJson')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0) 
            {
                getOneArticleJson();
            }
            else 
            {
                http_response_code(404);
            }
        }

        elseif($_GET['rest'] == 'Get_commentsJson')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0) 
            {
                getCommentsJson();
            }
            else 
            {
                http_response_code(404);
            }
        }

        elseif($_GET['rest'] == 'Get_one_commentJson')
        {
            if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0) 
            {
                getOneCommentJson();
            }
            else
            {
                http_response_code(404);
            }
        }

        elseif($_GET['rest'] == 'Get_droits_usersJson')
        {
            if(isset($role) && $role == 'Admin')
            {
                getDroitsUsersJSON();
            }
            else
            {
                http_response_code(403);
            }
        }

        // POST

        elseif($_GET['rest'] == 'post_articleJson')
        {
            if(isset($role) && $role != 'Banned')
            {
                if (!empty($pseudo))
                {
                    postArticleJson($pseudo);
                }
                else
                {
                    http_response_code(418);
                }
            }
            else
            {
                http_response_code(403);
            }
        }

        elseif ($_GET['rest'] == 'PostLoginJson')
        {
            postLoginJson();
        }

        elseif ($_GET['rest'] == 'PostInscriptionJson')
        {
            postInscriptionJson();
        }

        elseif ($_GET['rest'] == 'PostLogoutJson')
        {
            postLogoutJson();
        }

        elseif ($_GET['rest'] == 'Post_commentJson')
        {
            if(isset($role) && $role != 'Banned')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    postCommentJson($pseudo);
                }
                else
                {
                    http_response_code(404);
                    // header("Content-Type: application/json; charset=UTF-8");
                    // echo json_encode(["message" => "Article non trouvé, changez d'id"]);
                } 
            }
            else
            {
                http_response_code(403);
            }
        }

        // PUT

        elseif($_GET['rest'] == 'Put_droits_usersJson')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id_user']) && $_GET['id_user'] >= 0)
                {
                    PutDroitsUsersJSON();
                }
                else
                {
                    http_response_code(404);
                }
            }
            else
            {
                http_response_code(403);
            }
        }

        elseif ($_GET['rest'] == 'Put_article_contentJson')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    putArticleContentJson($pseudo);
                }
                else
                {
                    http_response_code(404);
                }
            }    
            else
            {
                http_response_code(403);
            }
        }

        elseif ($_GET['rest'] == 'Put_article_titleJson')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    putArticleTitleJson($pseudo);
                }
                else
                {
                    http_response_code(404);
                }
            }    
            else
            {
                http_response_code(403);
            }
        }

        elseif ($_GET['rest'] == 'Put_commentJson')
        {
            if(isset($role) && $role == 'Admin')
            {
                if (isset($_GET['id']) && $_GET['id'] >= 0) 
                {
                    if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0)
                    {
                        putCommentJson($pseudo);
                    }
                    else
                    {
                        http_response_code(404);
                    }
                }
                else
                {
                    http_response_code(404);
                }
            }    
            else
            {
                http_response_code(403);
            }
        }

        // DELETE

        elseif($_GET['rest'] == 'Delete_articleJson')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0)
            {
                if(isset($role) && $role == 'Admin')
                {
                    delete_articleJson();
                }
                else
                {
                    http_response_code(403);
                }
            }
            else
            {
                http_response_code(404);
            }
        }

        elseif($_GET['rest'] == 'Delete_commentJson')
        {
            if (isset($_GET['id']) && $_GET['id'] >= 0)
            {
                if (isset($_GET['id_comment']) && $_GET['id_comment'] >= 0)
                {
                    if(isset($role) && $role == 'Admin')
                    {
                        delete_commentJson();
                    }
                    else
                    {
                        http_response_code(403);
                    }
                }
                else
                {
                    http_response_code(404);
                }
            }
            else
            {
                http_response_code(404);
            }
        }
    }

    else 
    {
        listArticles();
    }
}

catch (Exception $e)
{
    getError($e);
}