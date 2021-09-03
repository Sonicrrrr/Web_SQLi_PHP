<?php
    session_start();
    require_once "config.php";
    if(!isset($_SESSION['login']) && !isset($_SESSION['admin'])){
        header("Location: login.php");
    }
?>

<html>
<head></head>
<body>
    <div class="container">
        <h1>SQL INJECTION</h1>
        <p><a href="sqli_1.php">SQL Injection (GET/SEARCH) </a></p>
        <p><a href="sqli_2.php">SQL Injection (GET/SELECT) </a></p>
        <p><a href="sqli_3.php">SQL Injection (POST/SELECT) </a></p>
        <p><a href="sqli_4.php">SQL Injection (POST/SEARCH) </a></p>
        <p><a href="sqli_5.php">SQL Injection - Stored (Blog) </a></p>
    </div>
    <div>
        <p><a href="logout.php">Logout</a></p>
    </div>
</body>
</html>
