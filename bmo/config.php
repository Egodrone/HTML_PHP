<?php
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors
require __DIR__ . "/incl/session.php";
$dbFileName = __DIR__ . "/db/bmo.sqlite";
$dsn = "sqlite:$dbFileName";
