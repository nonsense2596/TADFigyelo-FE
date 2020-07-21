<?php
    // TODO az opendir-t kicserélni a tényleges dirre, ahol majd a fileok lesznek
    // akár változóba menteni, mert sokszor használom
    function ListItems() {
        if ($handle = opendir('.')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if(strpos($entry,"diff")!==false){  // igy csak azokat mutattja amit érdemes, amiből van diff file
                        //////
                        ///  kiirandó név meghatározása diff file mutatása
                        $doc = new DOMDocument();
                        $parts = explode('.',$entry);
                        @$doc->loadHTML(@file_get_contents($parts[0].'.'.$parts[2]));   // ne! a diff filet nezzuk az eredeti nev utan
                        $titlelist = $doc->getElementsByTagName("title");
                        $title = "";
                        if($titlelist->length > 0){
                            $title = substr($titlelist->item(0)->nodeValue,10); // magic number
                        }



                        // originál verzió kész

                        $original = $parts[0].'.html';


                        // diff verziok kilistazasa egyesevel
                        $diffprint = "";
                        if($handle2 = opendir('.')){
                            while (false !== ($entry2 = readdir($handle2))) {
                                if ($entry2 != "." && $entry2 != "..") {
                                    $parts = explode('.',$entry);
                                    if(strpos($entry2,$parts[0])!==false && strpos($entry2,'_')!==false){
                                        if(file_exists($entry2)){
                                            $diffprint = $diffprint."<a class='card-text' href='$entry2'>$entry2</a> was last modified: ".date("F d Y H:i:s.", filemtime($entry2))."<hr class='my-1'>";
                                        }
                                    }
                                }
                            }
                        }

                        echo "<div class='col-sm-6 mb-4'><div class='card'>";
                        echo "<h5 class='card-header bg-primary text-white'>$title</h5>";
                        echo "<div class='card-body'>";
                        echo "<h6 class='card-text'><a class='card-text' href='$original'>Original: $original </a></h6><hr class='mt-3 mb-1'>";
                        echo $diffprint;
                        echo "</div>";
                        echo "<div class='card-footer'><a href='$entry'>Show latest diff</a></div>";
                        echo "</div></div>";
                    }

                }
            }
            closedir($handle);
        }
    };
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Gi[T]AD</title>
    <link rel="icon" href="https://vik.hk/wp-content/uploads/2018/08/cropped-BMEVIK_HK_logo_small-1-32x32.png" sizes="32x32">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
</head>
<body>


<div class="container">
    <h1>G<i>i</i><b>[</b>T<b>]</b>AD</h1>
    <div class="row mt-4">
        <?php ListItems(1); ?>
    </div>
</div>


</body>
</html>