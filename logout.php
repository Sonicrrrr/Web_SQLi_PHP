<?php
    session_start();
    unset($_SESSION['admin']);
    unset($_SESSION['login']);
    header("Location: login.php");