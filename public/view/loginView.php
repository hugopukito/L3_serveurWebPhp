<?php $title = 'Login'; ?>


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
            <p>Modifiez les droits ici: <a href="/index.php?action=Droits">droits</a></p>                    <?php    
        }
        ?>
        <?php
    }
    else
    {
    ?>
        <p><a href="/index.php?action=Inscription">inscription</a></p>
        <p><a href="/index.php">Menu Principal</a></p>
        <?php
    }
    ?>
<?php $menu = ob_get_clean(); ?>


<?php ob_start(); ?>

        <div align="center">
            <h2> Connexion </h2>
            </br> </br>

            <form action="index.php?action=PostLogin" method="post">
                <table>
                    <tr>
                        <td align="right">
                            <label for="pseudo"> Pseudo :</label> 
                        </td>
                        <td>
                            <input type="text" name="pseudo" id="pseudo"/><br />  
                        </td>
                    </tr>
                    <tr>
                        <td align="right">
                            <label for="password"> Mot de passe :</label> 
                        </td>
                        <td>
                            <input type="password" name="password" id="password" /><br />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                        <input type="submit" name="connexion" value="Connexion"/><br />
                        </td>
                    </tr>
                </table>
            </form>

            <?php
                if(isset($error))
                {
                    echo $error;
                }
            ?>
        </div>

<?php $formulaire = ob_get_clean(); ?>

<?php require('template.php'); ?>