<!-- Affichage de la page index -->

<?php $title ='Twitter 2'; ?>

<?php ob_start(); ?>
    <?php
    if (isset($_COOKIE['token'])) 
    {
        require('token/token_decode.php');?>
        <h2> Profil de <?= $pseudo ?> (<?= $role ?>) </h2>
        <p>Deconnexion ici: <a href="/index.php?action=Deconnexion ">deconnexion</a></p>
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
        <p>Inscription ici: <a href="/index.php?action=Inscription">inscription</a></p>
        <p>Connexion ici: <a href="/index.php?action=Login">connexion</a></p>
        <?php
    }
    ?>
<?php $menu = ob_get_clean(); ?>
<?php ob_start(); ?>
    <?php
    if (isset($_COOKIE['token']) && $role != 'Banned')
    {
    ?>
        <form action="index.php?action=Add_article" method="post">
            <p>
            <label for="title">Titre de l'article</label> : <input type="text" name="title" id="title" /><br />
            <label for="content">Contenu</label> :  <input type="text" name="content" id="content" /><br />
            <input type="hidden" name="pseudo" value="<?= "".$pseudo."" ?>" />

            <input type="submit" value="Envoyer" />
        </p>
        </form>
    <?php
    }
    ?>
<?php $formulaire = ob_get_clean(); ?>

<?php ob_start(); ?>
<?php $title2 ='Articles'; ?>
    <?php foreach($articles as $article): ?>

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

        <h4> Auteur: <?= $article -> pseudo ?> </h4>
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

        <p>Voir l'article avec ses commentaires ici: <a href="/index.php?action=Article&amp;id=<?= $article -> id ?>"> <?= $article -> title ?> </a></p> 
    
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

    <?php endforeach; ?>
    <?php $content = ob_get_clean(); ?>
<?php require('template.php'); ?>
  