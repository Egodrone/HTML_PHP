<?php
$title = "Ändra";
require __DIR__ . "/config.php";
require __DIR__ . "/src/functions.php"; 
require __DIR__ . "/incl/header.php";
if (isset($_GET['updated']) && $_GET['updated'] == "true") {
    echo "<br><h3>Tabbelen har blivit uppdaterad!</h3><br>";
}
function displayHtmlTableUpdate()
{
    if (isset($_SESSION['loggedIn'])) {
        $fileName = __DIR__ . "../db/bmo.sqlite";
        $dsn = "sqlite:$fileName";
        try {
            $db = new PDO($dsn);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Failed to connect to the database using DSN:<br>$dsn<br>";
            throw $e;
        }
        $sql = "SELECT * FROM Article";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rows = null;
        foreach ($res as $row) {
            $rows .= "<tr id='trup'>";
            $rows .= "<td id='tdup'>{$row['id']}</td>";
            $rows .= "<td id='tdup'>{$row['category']}</td>";
            $rows .= "<td id='tdup'>{$row['title']}</td>";
            $rows .= "<td id='tdup'>{$row['content']}</td>";
            $rows .= "<td id='tdup'>{$row['author']}</td>";
            $rows .= "<td id='tdup'>{$row['pubdate']}</td>";
            $rows .= "<td id='tdup'><a href='incl/update-process.php?id={$row['id']}'>Update</a></td>";
            //$rows .= "<td><a href='update.php?names='>Update</a></td>";
            $rows .= "</tr>\n";
        }
        // Print out the result as a HTML table using PHP heredoc
        echo <<<EOD
<table id='tableup'>
<tr id='trup'>
<th id='thup'>Id</th>
<th id='thup'>Category</th>
<th id='thup'>Title</th>
<th id='thup'>Content</th>
<th id='thup'>Author</th>
<th id='thup'>Pubdate</th>
<th id='thup'>Update</th>
</tr>
$rows
</table>
EOD;
    } else {
        echo "Du måste logga in";
    }
}

displayHtmlTableUpdate();
require __DIR__ . "/incl/footer.php";
