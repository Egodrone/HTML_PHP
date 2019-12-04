<?php
$title = "Update";
require __DIR__ . "/../config.php";
require __DIR__ . "/../src/functions.php";
require __DIR__ . "/header2.php";
//echo $_GET['id'];
$idToUpd = $_GET['id'];
$fileName = __DIR__ . "/../db/bmo.sqlite";
$dsn = "sqlite:$fileName";
// Open the database file and catch the exception if it fails.
try {
    $db = new PDO($dsn);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Failed to connect to the database using DSN:<br>$dsn<br>";
    throw $e;
}
$sql = "SELECT category, title, content, author, pubdate FROM Article WHERE id = $idToUpd";
$stmt = $db->prepare($sql);
$stmt->execute();
$res = $stmt->fetchAll(PDO::FETCH_ASSOC);
foreach ($res as $row) {
    $rows1 = $row['category'];
    $rows2 = $row['title'];
    $rows3 = $row['content'];
    $rows4 = $row['author'];
    $rows5 = $row['pubdate'];
}
//print($rows1);
?>
<form method="post" action="update-process2.php?id=<?php echo $idToUpd;?>">
    <fieldset>
        <legend>Redigera innehåll:</legend>
        <p><label>Kategori<br><input id="insertText" type="text" value="<?= $rows1 ?>" name="category"></label></p>
        <p><label>Titel<br><input id="insertText" type="text" value="<?= $rows2 ?>" name="title"></label></p>
        <p><label>Artikel<br><input id="insertText" type="text" value="<?= $rows3 ?>" name="content"></label></p>
        <p><label>Författare<br><input id="insertText" type="text" value="<?= $rows4 ?>" name="author"></label></p>
        <p><label>Datum<br><input id="insertText" type="text" value="<?= $rows5 ?>" name="pubdate"></label></p>
        <p><input id="submit_b" type="submit" name="add" value="Update"></p>
    </fieldset>
</form>
<?php

require __DIR__ . "/footer2.php";
?>
