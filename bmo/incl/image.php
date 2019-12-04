<?php
$title = "Bild";
require __DIR__ . "/../config.php";
require __DIR__ . "/../src/functions.php"; 
require __DIR__ . "/header2.php";
?>
<div class="articleDiv">
    <?php
    $imgId = $_GET['id'];
    zoomImg($imgId);
    require __DIR__ . "/footer2.php";
    ?>
</div>
