<?php
    session_start();

    if(isset($_SESSION['email']))
    {
        unset($_SESSION['id_users']);
        unset($_SESSION['email']);
        session_destroy();
        header('location:index.php?page=0');
    }
?>