<?php $title = 'Erreur'; ?>
<?php $title2 = ''; ?>

<?php ob_start(); ?>


<?php
if (($e -> getMessage()) == '404 (article)')
{
?>  

    <h2> Erreur 404  <h2>
    <p> pas d'article trouvé veuillez changez l'id dans l'url <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == '404 (comment)')
{
?>  

    <h2> Erreur 404  <h2>
    <p> pas de commentaire trouvé veuillez changez l'id_comment dans l'url <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == '404 (article with comment)')
{
?>  

    <h2> Erreur 404  <h2>
    <p> pas de commentaire trouvé à cause de l'article inexistant veuillez changez l'id dans l'url <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'add_article')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Article non ajouté, le titre, le pseudo et/ou le contenu étai(ent) érroné(s) <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'add_comment')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Commentaire non ajouté, le pseudo et/ou le contenu étai(ent) érroné(s) ou déjà pris <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'pseudo && pwd')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Il vous manque un paramètre <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'put_article_content')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Mise à jour de l'article non faite, le pseudo et/ou le contenu étai(ent) érroné(s) <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'put_article_title')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Mise à jour de l'article non faite, le pseudo et/ou le titre étai(ent) érroné(s) <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'put_comment')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Mise à jour du commentaire non faite, le pseudo et/ou le contenu étai(ent) érroné(s) <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'delete_article')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Suppression de l'article non faite, l'id d'article ne convenait pas à la supression de celui-ci dans la base de donnée <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'delete_comment')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Suppression du commentaire non faite, l'id du commantaire ne convenait pas à la supression de celui-ci dans la base de donnée <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'put_droits')
{
?>  

    <h2> Erreur 418  <h2>
    <p> Mise à jour des droits de l'utilisateur non faite, l'option prise sur les trois droits possibles est érroné <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == '404 (user)')
{
?>  

    <h2> Erreur 404  <h2>
    <p> pas d'utilisateur trouvé veuillez changez l'id_user dans l'url <p>

<?php
}
?>

<?php
if (($e -> getMessage()) == 'Permission denied')
{
?>  

    <h2> Erreur 403  <h2>
    <p> Vous n'avez pas les droits suffisants pour faire cette action, veuillez contactez un administrateur si vous voulez modifiez vos droits d'accès <p>

<?php
}
?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>