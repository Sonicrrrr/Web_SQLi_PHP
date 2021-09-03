<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['login'])){
    header("Location: login.php");
}
if(isset($_POST["blog"])) {
    $entry = $_POST["entry"];
    $owner = $_SESSION["login"];
    if($entry == "")
    {
        $_SESSION['error'] =  "Please enter some text...";

    }
    else {
        $sql = "INSERT INTO blog (date, entry, owner) VALUES (now(),'" . $entry . "','" . $owner . "')";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $_SESSION['success'] =  "The entry was added to our blog!";
    }
}
?>
<html>
<head></head>
<body>
    <div class="container">
        <h1>SQL Injection - Stored (Blog)</h1>
        <form method="POST">
            <p>
                <label for="entry">Add an entry to our blog :</label> <br>
                <textarea id="entry" name="entry" cols="80" rows="3"></textarea>
            </p>
            <button type="submit" name="blog" value="add">Add Entry</button>
            <?php
                if(isset($_SESSION['error'])){
                    echo('<a style="color:red;">').$_SESSION['error'].("</a>\n");
                }
                if(isset($_SESSION['success'])){
                    echo('<a style="color:green;">').$_SESSION['success'].("</a>\n");
                }
            ?>
        </form>
        <br>
        <table id="table_yellow">
            <tbody>
            <tr height="30" bgcolor="#ffb717" align="center">
                <td width="20">#</td>
                <td width="100"><b>Owner</b></td>
                <td width="100"><b>Date</b></td>
                <td width="445"><b>Entry</b></td>
            </tr>
            <?php
                $sql = "SELECT * FROM blog";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if($rows == TRUE){
                    foreach ($rows as $row){
                        echo('<tr height="40">');
                        echo('<td align="center">').$row['id'].('</td>');
                        echo('<td>').$row['owner'].('</td>');
                        echo('<td>').$row['date'].('</td>');
                        echo('<td>').$row['entry'].('</td>');
                        echo('</tr>');
                    }
                }
            ?>
            </tbody>
        </table>
    </div>
</body>
</html>
