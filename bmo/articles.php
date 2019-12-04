<?php
$title = "Artiklar";
require __DIR__ . "/config.php";
require __DIR__ . "/src/functions.php"; 
require __DIR__ . "/incl/header.php";
require __DIR__ . "/incl/maggy.php";
?>
<div class="articleDiv">
    <?php
    articlesDisp();
    ?>
</div>
<?php
require __DIR__ . "/incl/footer.php";
?>
