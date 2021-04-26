<?php

setcookie('token');
unset($_COOKIE['token']);
header("Location: index.php");

?>