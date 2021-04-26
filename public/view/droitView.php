<?php $title = 'Droits'; ?>
<?php $title2 = 'Administration des droits'; ?>

<?php ob_start(); ?>
    <?php
    if (isset($_COOKIE['token'])) 
    {
        require('token/token_decode.php');

    ?>
        <?php foreach($users as $user): ?>
            <h2> Pseudo: <?= $user -> pseudo ?> </h2>
            <h3> Role: <?= $user -> role ?> </h2>
                <form action="index.php?action=Put_droits&amp;id_user=<?= $user -> id ?>" method="post">
                    <select name="taskOption">
                        <option value="Admin">isAdmin</option>
                        <option value="Banned">isBanned</option>
                        <option value="Subscriber">Subscriber</option>
                    </select>
                    <input type="submit" value="Modifier les droits" />
                </form>
        <?php endforeach; ?>

        </br>
    <?php
    }
    ?>

<?php $content = ob_get_clean(); ?>

<?php require('template.php'); ?>