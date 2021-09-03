<?php
session_start();
require_once "config.php";
if(isset($_POST["form"]))
{

    $login = $_POST["login"];
    $password = $_POST["password"];
    $password = hash("sha1", $password, false);

    $sql = "SELECT * FROM users WHERE login = '" . $login;
    $sql.= "' AND BINARY password = '" . $password . "'";
    $sql.= " AND activated = 1";

    $stmt = $pdo->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if($row)
    {
        $_SESSION["login"] = $row['login'];
        $_SESSION["admin"] = $row['admin'];
        header("Location: index.php");
        return;
    }
    else
    {
        $message = '<p style="color:red;">Invalid credentials or user not activated!</p>';
    }
}
?>
<html>
<head>
    <style>
        h1::after,h1::before{
            content:"/";
            color:#ff4500;
        }
    </style>
</head>
<body>
    <div id="main">
        <h1>Login</h1>
        <p>Enter your credentials
            <i>(bee/bug)</i>
        </p>
        <form method="POST">
            <p><label for="login">Login:</label><br />
                <input type="text" id="login" name="login" size="20" autocomplete="off"></p>
            <p><label for="password">Password:</label><br />
                <input type="password" id="password" name="password" size="20" autocomplete="off"></p>
            <button type="submit" name="form" value="submit">Login</button>
        </form>
    </div>
</body>
</html>
