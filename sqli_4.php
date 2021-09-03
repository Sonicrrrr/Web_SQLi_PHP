<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['login']) && !isset($_SESSION['admin'])){
    header("Location: login.php");

}
?>
<html>
<head>
</head>
<body>
<div class="container">
    <h1>SQL Injection (POST/Search)</h1>
    <form method="POST">
        <label for="title">Search for a movie</label>
        <input id="title" type="text" name="title" size="25">
        <button type="submit" name="action" value="search">Search</button>
        <table id="table_yellow">
            <tbody>
            <tr height="30" bgcolor="#ffb717" align="center">
                <td width="200"><b>Title</b></td>
                <td width="80"><b>Release</b></td>
                <td width="140"><b>Character</b></td>
                <td width="80"><b>Genre</b></td>
                <td width="80"><b>IMDb</b></td>
            </tr>
            <?php
            if(isset($_POST["title"])) {
                $title = $_POST["title"];
                $sql = "SELECT * FROM movies WHERE title LIKE '%" . $title . "%'";
                $stmt = $pdo->query($sql);
                $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
                if ($rows == TRUE) {
                    foreach ($rows as $row) {
                        echo('<tr height="30"><td>');
                        echo($row['title']);
                        echo('</td><td align="center">');
                        echo($row["release_year"]);
                        echo('</td><td>');
                        echo($row["main_character"]);
                        echo('</td><td align="center">');
                        echo($row["genre"]);
                        echo('</td><td align="center">');
                        echo ('<a href="http://www.imdb.com/title/') . ($row["imdb"]) . ('target="_blank">Link</a></td>');
                        echo('</tr>');
                    }
                } else {
                    echo('<tr height="30">
                    <td colspan="5" width="580">No movies were found!</td>
                    </tr>');
                }
            }
            ?>
            </tbody>
        </table>
    </form>
</div>
</body>
</html>
