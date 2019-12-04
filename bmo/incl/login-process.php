<?php
session_start();
echo "Login process";
if (!isset($_SESSION['loggedIn']) || empty($_SESSION['loggedIn'])) {
    $displayInfo = "<strong>Login</strong> to the website by using doe:doe or admin:admin as user and password.";
    $styleIn = "username";
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (htmlentities($_POST["username"]) != null && htmlentities($_POST["password"]) != null) {
            $username = $_POST["username"];
            $password = $_POST["password"];
            if ($username === "admin" && $password === "admin") {
                //correct username and password
                //$name = "loggedIn";
                $randomNumbers = intval("0" . rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
                $randomStr =  chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
                $randomUserId = $randomNumbers.$randomStr;
                $_SESSION['loggedIn'] = "Admin";
                $displayInfo = "";
                echo "<label class='noEroor'>You are logged in as a user $username: </label> ".$_SESSION['loggedIn']."<br><a href='session.php'>Click</a>";
                echo "<b> Display admin pannel here </b>";
                $styleIn = "usernameSet";
                $_SESSION["dude"] = $username;
                //send to the processing side that create a session
                //header("Location: ../edit.php");
                header("Location: ../admin.php");
            } elseif ($username === "doe" && $password === "doe") {
                $randomNumbers = intval("0" . rand(1, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9) . rand(0, 9));
                $randomStr =  chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90)) . chr(rand(65, 90));
                $randomUserId = $randomNumbers.$randomStr;
                $_SESSION['loggedIn'] = "Doe";
                $displayInfo = "";
                echo "<label class='noEroor'>You are logged in as a user $username: </label> ".$_SESSION['loggedIn']."<br><a href='session.php'>Click</a>";
                echo "<b> Display admin pannel here </b>";
                $styleIn = "usernameSet";
                $_SESSION["dude"] = $username;
                header("Location: ../admin.php");
                //header("Location: ../edit.php");
            } else {
                header("Location: ../admin.php?msg=dxdydz");
            }

        } elseif (empty(htmlentities($_POST["username"])) || empty(htmlentities($_POST["password"]))) {
            header("Location: ../admin.php?msg=dxdydz");
        } else {
            header("Location: ../admin.php?msg=dxdydz");
            $username = "";
            $password = "";       
        }
    }
} else {
    $displayInfo = "<label class='noEroor'>You are logged in as a user ".$_SESSION["dude"].": </label> ".$_SESSION['loggedIn']."<br><a href='session.php'>Click</a>";
    $styleIn = "usernameSet";
}
