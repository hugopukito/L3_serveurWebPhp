<?php $title = 'Inscription'; ?>

<?php ob_start(); ?>


        <div align="center">
            <h2> Inscription </h2>
            </br> </br>

            <form action="index.php?action=PostInscription" method="post">
                <table>
                    <tr>
                        <td align="right">
                            <label for="pseudo"> Pseudo :</label> 
                        </td>
                        <td>
                            <input type="text" name="pseudo" id="pseudo" value="<?php if(isset($pseudo)) {echo $pseudo;} ?>"/><br />  
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
                        <td align="right">
                            <label for="password2"> Confirmation Mot de passe :</label> 
                        </td>
                        <td>
                            <input type="password" name="password2" id="password2" /><br />
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                        <td align="center">
                        <input type="submit" name="inscription" value="Envoyer"/><br />
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

