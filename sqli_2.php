<?php
session_start();
require_once "config.php";
if(!isset($_SESSION['login'])){
    header("Location: login.php");

}
?>
<html>
<head>
</head>
<body>
<div class="container">
    <h1>SQL Injection (GET/Select)</h1>
    <form method="GET">
        <label for="title">Select a movie</label>
        <select name="movie">
            <option value="1">G.I. Joe: Retaliation</option>
            <option value="2">Iron Man</option>
            <option value="3">Man of Steel</option>
            <option value="4">Terminator Salvation</option>
            <option value="5">The Amazing Spider-Man</option>
            <option value="6">The Cabin in the Woods</option>
            <option value="7">The Dark Knight Rises</option>
            <option value="8">The Fast and the Furious</option>
            <option value="9">The Incredible Hulk</option>
            <option value="10">World War Z</option>
        </select>
        <button type="submit" name="action" value="go">Go</button>
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
            if(isset($_GET["movie"])) {
                $id = $_GET['movie'];
                if($id) {
                    $sql = "SELECT * FROM movies WHERE id =" . $id;
                }
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
