<?php
$title = "Galleri";
require __DIR__ . "/config.php";
require __DIR__ . "/src/functions.php"; 
require __DIR__ . "/incl/header.php";
$totalImgs = dispPic();
require __DIR__ . "/incl/footer.php";
