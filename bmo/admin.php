<?php
$title = "Admin";
require __DIR__ . "/config.php";
require __DIR__ . "/src/functions.php"; 
require __DIR__ . "/incl/header.php";
$username=$password="";
$passwordErr = "";
if (isset($_SESSION['loggedIn']) && !empty($_SESSION['loggedIn'])) {
    //print("Du är inloggad<br>");
    echo "<div class='articleDiv'>";
    echo "<img src='img/inloggad.png'><br>";
    echo "<div class='articleDiv2'>";
    echo "<aside>";
    echo "<a href='edit.php'>Uppdatera databasen</a>";
    echo "</aside>";
    echo "</div>";
    echo "<div class='articleDiv3'>";
    echo "<img id='adminBurns' src='img/admin.gif'><br>";
    echo "</div>";
    echo "</div>";
} else {
    require __DIR__ . "/incl/adminform.php";
    if (isset($_GET['msg']) && $_GET['msg'] == "dxdydz") {
        $passwordErr = "Fel lösenord eller användarnamn";
        echo "<span class='error'>".$passwordErr."<span>";
    }
}

require __DIR__ . "/incl/footer.php";
