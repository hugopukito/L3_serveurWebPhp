<?php $title = 'Twitter 2'; ?>

<?php ob_start(); ?>

<?php

if (isset($_COOKIE['token'])) 
{
    require('token/token_decode.php');

?>
    <h2> Profil de <?= $pseudo ?> (<?= $role ?>) </h2>
    <p><a href="/index.php?action=Deconnexion">deconnexion</a></p>
    <p><a href="/index.php">Menu Principal</a></p>

    <?php
    if($role == 'Admin')
    {
    ?>
        <p>Modifiez les droits ici: <a href="/index.php?action=Droits">droits</a></p>

    <?php    
    }
    ?>

<?php
}
else
{
?>
        <p><a href="/index.php?action=Login">Login</a></p>        
        <p><a href="/index.php?action=Inscription">inscription</a></p>
        <p><a href="/index.php">Menu Principal</a></p>

<?php
}
?>
<?php $menu = ob_get_clean(); ?>
<?php ob_start(); ?>
<?php $title2 ='Article'; ?>
<h2> Titre: <?= $article -> title ?> 
            
            <?php 
            if(($article -> pseudo_title_modif) && ($article -> date_title_modif) != NULL)
            { 
            ?>
                (modifié par: <?= $article -> pseudo_title_modif ?>, le: <?= $article -> date_title_modif ?>) 
                    
            <?php 
            } 
            ?> 

            </h2>

            <h3> Auteur: <?= $article -> pseudo ?> </h2>
            <h3> <?= $article -> content ?> 
            
            <?php 
            if(($article -> pseudo_content_modif) && ($article -> date_modif) != NULL)
            { 
            ?>
                (modifié par: <?= $article -> pseudo_content_modif ?>, le: <?= $article -> date_modif ?>) 
                    
            <?php 
            } 
            ?> 

            </h3>
            <h3> <?= $article -> date ?> </h3>

            <?php
            if (isset($_COOKIE['token']) && $role == 'Admin') 
            {
            ?>
                <form action="index.php?action=Put_article&amp;id=<?= $article -> id ?>" method="post">
                    <input type="text" name="content" id="content" />
                    <input type="submit" name="modif_content" value= "Modifier l'article"/>
                    <input type="text" name="title" id="title" />
                    <input type="submit" name="modif_title" value= "Modifier le titre"/>
                    <input type="hidden" name="newPseudo" value="<?= "".$pseudo."" ?>" />
                </form>
            <?php
            }
            ?>

            <?php
            if (isset($_COOKIE['token']) && $role == 'Admin') 
            {
            ?>
                <form action="index.php?action=Delete_article&amp;id=<?= $article -> id ?>" method="post">
                    <input type="submit" name="supp" value= "Supprimer l'article"/>
                </form>
            <?php
            }
            ?>

            <?php 
            if (isset($_COOKIE['token']) && $role != 'Banned') 
            {
            ?>
            <form action="index.php?action=Add_comment&amp;id=<?= $article -> id ?>" method="post">
                <p>
                <label for="content">Commentaire</label> :  <input type="text" name="content" id="content" /><br />
                <input type="hidden" name="pseudo" value="<?= "".$pseudo."" ?>" />

                <input type="submit" value= "Envoyer"/>
                </p>
            </form>
            <?php
            }
            ?>

            <?php foreach($comments as $comment): 
                if(($comment -> id_article) == ($article -> id))  
                {
                ?>
                    <h4> <?= $comment -> pseudo ?> a commenté: <?= $comment -> content ?> 

                    <form action="index.php?action=Get_comment&amp;id=<?= $article -> id ?>&amp;id_comment=<?= $comment -> id ?>" method="post">
                        <input type="submit" name="view" value= "Voir"/>
                    </form>

                    <h6><?= $comment -> date ?></h6>

                    <?php 
                    if(($comment -> pseudo_user_modif) && ($comment -> date_modif) != NULL)
                    { 
                    ?>
                        (modifié par: <?= $comment -> pseudo_user_modif ?>, le: <?= $comment -> date_modif ?>) 
                    
                    <?php 
                    } 
                    ?> 
                    
                    </h4>
                    </br>

                    <?php
                    if (isset($_COOKIE['token']) && $role == 'Admin') 
                    {
                    ?>
                        <form action="index.php?action=Put_comment&amp;id=<?= $article -> id ?>&amp;id_comment=<?= $comment -> id ?>" method="post">
                            <input type="text" name="content" id="content" />
                            <input type="hidden" name="newPseudo" value="<?= "".$pseudo."" ?>" />
                            <input type="submit" name="modif" value= "Modifier"/>
                        </form>
                    <?php
                    }
                    ?>

                    <?php
                    if (isset($_COOKIE['token']) && $role == 'Admin') 
                    {
                    ?>
                        <form action="index.php?action=Delete_comment&amp;id=<?= $article -> id ?>&amp;id_comment=<?= $comment -> id ?>" method="post">
                            <input type="submit" name="supp" value= "Supprimer"/> 
                        </form>
                    <?php
                    }
                    ?>

            <?php
                }
            ?>     
            

            <?php endforeach; ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>