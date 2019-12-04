<?php
ob_start();
session_start();
if (isset($_SESSION['loggedIn'])) {
    //echo $_SESSION['loggedIn'];
    //echo "Hello";
}
