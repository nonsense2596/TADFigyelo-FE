<?php
    // TODO az opendir-t kicserélni a tényleges dirre, ahol majd a fileok lesznek
    // akár változóba menteni, mert sokszor használom
    function ListItems() {
        if ($handle = opendir('.')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if(strpos($entry,"diff")!==false){ // azaz ha true, azaz van benne diff
                        //////
                        ///  kiirandó név meghatározása diff file mutatása
                        $doc = new DOMDocument();
                        @$doc->loadHTML(@file_get_contents($entry));
                        $titlelist = $doc->getElementsByTagName("title");
                        $title = null;
                        if($titlelist->length > 0){
                            $title = substr($titlelist->item(0)->nodeValue,12); // magic number
                        }

                        echo "<div class='col-sm-6 mb-4'><div class='card'>";
                        echo "<h5 class='card-header bg-primary text-white'><a class='text-white' href='$entry'>$title</a></h5>";
                        //echo "<li class='list-group-item'><a href='$entry'>$title</a><br>";
                        echo "<div class='card-body'>";

                        // TODO originál verzió kész
                        $parts = explode('.',$entry);
                        $original = $parts[0].'.html';
                        echo "<a class='card-text' href='$original'>Original: $original</a><br>";



                        //////
                        /// itt megfogni a nem diff-es filet, és azt is feldolgozni
                        /// TODO az összeset vagy legújabbat vagy valamit megfogni ebből szépen szisztematikusan
                        if($handle2 = opendir('.')){
                            while (false !== ($entry2 = readdir($handle2))) {
                                if ($entry2 != "." && $entry2 != "..") {

                                    $parts = explode('.',$entry);

                                    if(strpos($entry2,$parts[0])!==false && strpos($entry2,'_')!==false){
                                        //echo $entry2.'<br>'; ez KELL
                                        // itt akkor mar tudjuk az adott fileok datumat
                                        if(file_exists($entry2)){
                                            echo "<a class='card-text' href='$entry2'>$entry2</a> was last modified: ".date("F d Y H:i:s.", filemtime($entry2))."<br>";
                                        }
                                    }
                                }
                            }
                        }
                        //////


                        echo "</div>";
                        //echo "</li>";
                        //echo "<li class='list-group-item'><a href='$entry'>$title</a></li>";
                        echo "</div></div>";
                    }

                }
            }
            closedir($handle);
        }
    };
?>
<html lang="en">
<head>
    <title>placeholder</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>
<h1>G<i>i</i><b>[</b>T<b>]</b>AD</h1>
<ul class="list-group-flush">
    <?php /*ListItems();*/ ?>
</ul>

<div class="container">
    <div class="row">
        <?php ListItems(); ?>
    </div>
</div>


</body>
</html>