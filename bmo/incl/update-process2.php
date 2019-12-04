<?php
session_start();
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    if (isset($_GET['id'])) {
        $idToDel = $_GET['id'];
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
        $category   = $_POST['category'];
        $title   = $_POST['title'];
        $content = $_POST['content'];
        $author = $_POST['author'];
        $pubdate = $_POST['pubdate'];
        $sql = "UPDATE Article SET category = ?, title = ?, content = ?, author = ?, pubdate = ? WHERE id = $idToDel";
        $params = [$category, $title, $content, $author, $pubdate];
        $stmt = $db->prepare($sql);
        $stmt->execute($params);
        header("Location: ../edit.php?updated=true");
    }
}
