<?php
    include './config.php';
    include './adminfunctions.php';

    adminLogout();
    header('Location: login.php');
?>