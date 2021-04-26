<?php $title = 'Twitter 2'; ?>
<?php $title2 = 'Commentaire'; ?>

<?php ob_start(); ?>

<?php

if (isset($_COOKIE['token'])) 
{
    require('token/token_decode.php');

?>


    <h2> Profil de <?= $pseudo ?> (<?= $role ?>) </h2>
    </br> </br>
    <p>Deconnexion ici: <a href="/index.php?action=Deconnexion">deconnexion</a></p>

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

<h4> 

    <?= $comment -> pseudo ?> a commenté: <?= $comment -> content ?> le: <?= $comment -> date ?>

    <?php 
    if(($comment -> pseudo_user_modif) && ($comment -> date_modif) != NULL)
    { 
    ?>
        (modifié par: <?= $comment -> pseudo_user_modif ?>, le: <?= $comment -> date_modif ?>) 
                    
    <?php 
    } 
    ?> 
                    
</h4>

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

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>