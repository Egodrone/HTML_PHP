<?php
error_reporting(-1);              // Report all type of errors
ini_set("display_errors", 1);     // Display all errors
// Function to connect to the database
function dbConn() 
{
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
    return $db;
}

function dispPic()
{
    $db = dbConn();
    $sql = "SELECT * FROM Object";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $countAllImgs = 0;
    $rows = null;
    foreach ($res as $row) {
        $countAllImgs++; 
    }
    foreach ($res as $row) {
        $rows .= "<tr>";
        //$rows .= "<td>{$row['id']}</td>";
        $rows .= "<td><label id='categoryGallery'>{$row['category']}</label></td>";
        $rows .= "<td>{$row['text']}</td>";
        $rows .= "<td> <a href='incl/image.php?id={$row['id']}'><img id='picHov' src='{$row['image']}'/> </a></td>";
        //$rows .= "<td>{$row['owner']}</td>";
        $rows .= "</tr>\n";
    }
    echo "<div class='articleDiv'>";
    echo "<img src='img/galleri35.png' alt=''>";
    echo "<h4>Samtliga bilder är från Ronny Holms samling:</h4>";
    // Print out the result as a HTML table using PHP heredoc
    echo <<<EOD
<table>
$rows
</table>
EOD;
    echo "</div>";
    return $countAllImgs;
}

// Function to display about information
function aboutDisp()
{
    $db = dbConn();
    $sql = "SELECT content FROM Article WHERE id = 4";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetch(PDO::FETCH_ASSOC);
    echo "<div class='articleDiv'>";
    echo "<img src='img/ombmo.png'>";
    foreach ($res as $row) {
        print($row);   
    }
    echo "</div>";
}

//Articles from db
function articlesDisp()
{
    $db = dbConn();
    $sql = "SELECT id, category, title, content, author, pubdate FROM Article WHERE title IN ('Begravningskonfekt', 'Minnestavlor', 'Pärlkransar')";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $rows = null;
    $countTitle = "";
    $idVektor = array();
    $idString = "";
    //$getAround = "1, ";
    $sql3 = "SELECT image FROM Object WHERE id IN (1, 2)";
    $stmt3 = $db->prepare($sql3);
    $stmt3->execute();
    $res3 = $stmt3->fetchAll(PDO::FETCH_ASSOC);
    $countRows = 0;
    $imgArray = ["<img id='imgRight' src='img/250/begravningskonfekt_madonna_maria_o_jesus.jpg'>", "<img id='imgRight' src='img/250/minnestavla_pas.jpg'>", "<img id='imgRight' src='img/250/parlkrans_jesus_golgata.jpg'>"];
    foreach ($res3 as $row3) {
        $strUrl = $row3['image'];
        $strUrl2 = substr($strUrl, 8);
        //echo "<img id='biggerImg' src='img/550x550/$strUrl2'>";
    }
    foreach ($res as $row) {
        $rows .= "<tr>";
        if ($row['title'] != $countTitle) {
            $countTitle = $row['title'];
            array_push($idVektor, $row['id']);
            //print($row['title']);
        }
        //$rows .= "<td>{$row['category']}</td>";
        //$rows .= "<td>{$row['title']}</td>";
        $rows .= "<td><b>{$row['title']}</b>{$row['content']}</td>";
        //Criminal
        //$rows .= "<td>$imgArray[$countRows]{$row['author']}</td>";
        $rows .= "<td>$imgArray[$countRows]</td>";
        //$rows .= "<td> <img src='{$row['image']}'/> {$row['image']}</td>";
        //Criminal add to eto below
        //$rows .= "<td>{$row['pubdate']}</td>";
        $rows .= "</tr>\n";
        //print("<br>$countRows<br>");
        $countRows++;
    }
    for ($grep=0; $grep < sizeof($idVektor); $grep++) {
        if ($grep != 0) {
            $idString = $idString.", ".$idVektor[$grep];
        } else {
            $idString = $idVektor[$grep];
        }
    }
    //print($idString)."<br>";
    $sql2 = "SELECT image FROM Object WHERE id IN ($idString)";
    $stmt2 = $db->prepare($sql2);
    $stmt2->execute();
    $res2 = $stmt2->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res2 as $row2) {
        $strUrl = $row2['image'];
        $strUrl2 = substr($strUrl, 8);
        //echo "<img id='biggerImg' src='img/550x550/$strUrl2'>";
        //$sirImage .= "<img id='biggerImg' src='img/550x550/$strUrl2'>";
        //echo $strUrl2;
    }

    $sqlMaggy = "SELECT category, title, content FROM Article WHERE category='maggy'";
    $stmtMaggy = $db->prepare($sqlMaggy);
    $stmtMaggy->execute();
    $resMaggy = $stmtMaggy->fetchAll(PDO::FETCH_ASSOC);
    $rowsMaggy = null;
    foreach ($resMaggy as $rowMaggy) {
        //print($rowMaggy['content']);
        $rowsMaggy .= "<tr>";
        $rowsMaggy .= "<td><b>{$rowMaggy['title']}</b>{$rowMaggy['content']}</td>";
        //$rowsMaggy .= "<td>$imgArray[$countRows]</td>";
        $rowsMaggy .= "</tr>\n";
    }
    //var_dump($idVektor);
    // Print out the result as a HTML table using PHP heredoc
    echo "<div class='articleDiv'>";
    echo <<<EOD
<table>
<tr>
<th></th>
<th></th>
</tr>
$rows
</table>
EOD;
    echo "</div>";
}

function searchDisp()
{
    $db = dbConn();
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search = $_GET['search'];
        //$test = "";
        // Prepare the SQL statement
        $sql = "SELECT category, title, content, author, pubdate FROM article WHERE category LIKE ? OR title LIKE ?";
        $stmt = $db->prepare($sql);
        $params = [$search, $search];
        $stmt->execute($params);
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $rows = null;
        echo "<div class='articleDiv'>";
        foreach ($res as $row) {
            $rows .= "<tr>";
            //$rows .= "<td>{$row['category']}</td>";
            //$rows .= "<td>{$row['title']}</td>";
            $rows .= "<td>{$row['content']}</td>";
            $rows .= "<td>{$row['author']}</td>";
            //$rows .= "<td> <img src='{$row['image']}'/> {$row['image']}</td>";
            $rows .= "<td>{$row['pubdate']}</td>";
            $rows .= "</tr>\n";
        }
        // Print out the result as a HTML table using PHP heredoc
        echo <<<EOD
<table>
<tr>
<th>Resultat av sökning</th>
<th>Av</th>
<th>Datum</th>
</tr>
$rows
</table>
EOD;
        echo "</div>";
    }
}

//Display big image
function zoomImg($imageIdArg)
{
    if ($imageIdArg < 30 && $imageIdArg != 0) {
        $imageIdArgMinus = $imageIdArg - 1;
        $imageIdArgPlus = $imageIdArg + 1;
    } elseif ($imageIdArg > 30) {
        $imageIdArgPlus = 1;
        $imageIdArgMinus = 30;
        $imageIdArg = 1;
    } elseif ($imageIdArg == 0) {
        $imageIdArgMinus = 30;
        $imageIdArg = 30;
        $imageIdArgPlus = 1;
    } elseif ($imageIdArg == 30) {
        $imageIdArgPlus = 1;
        $imageIdArgMinus = 30;
        print("Slut på bilder");
    }
    $countAll = 0;
    $db = dbConn();
    $imageIdArgmod = $imageIdArg;
    //print($imageIdArgmod);
    $sql = "SELECT image FROM Object WHERE id = $imageIdArgmod";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($res as $row) {
        $countAll++;
    }
    //print($countAll);
    echo "<br>";
    echo "<a id='back' href='../gallery.php'><img id='backIco' src='../img/gal.png'>Galleri </a>";
    echo "<a id='back' href='image.php?id=$imageIdArgMinus'><img id='backIco' src='../img/back.ico'>Föregående</a>";
    echo "<a id='back' href='image.php?id=$imageIdArgPlus'>| Nästa<img id='backIco' src='../img/forward.ico'></a>";
    echo "<br><br>";

    foreach ($res as $row) {
        $strUrl = $row['image'];
        $strUrl2 = substr($strUrl, 8);
        echo "<img id='biggerImg' src='../img/550x550/$strUrl2'>";
    }
}
