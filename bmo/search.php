<?php
$title = "Sök";
require __DIR__ . "/config.php";
require __DIR__ . "/src/functions.php"; 
require __DIR__ . "/incl/header.php";
$search = null;
?>
<div class="searchDiv">
    <img src="img/sph30.png">
    <p>Ange ett ord eller fras, till exempel: Begravningskonfekt, alternativt %begr% eller något liknande</p>
    <form id="searchF" action = "">
        <input id="searchText" type="search" name="search" value="<?=$search?>" placeholder="Sökord">
        <span class="arrowSearch">
            <input id="submit_b" type="submit" value="Sök">
        </span>
    </form>
</div>

<?php
    $search = searchDisp();
               require __DIR__ . "/incl/footer.php";
?>
