<?php
    function ListItems() {
        if ($handle = opendir('.')) {
            while (false !== ($entry = readdir($handle))) {
                if ($entry != "." && $entry != "..") {
                    if(strpos($entry,"diff")!=false){
                        //////
                        $doc = new DOMDocument();
                        @$doc->loadHTML(@file_get_contents($entry));
                        $titlelist = $doc->getElementsByTagName("title");
                        if($titlelist->length > 0){
                            echo $titlelist->item(0)->nodeValue;
                        }

                        //////
                        echo "<li><a href='$entry'>$entry</a></li>";
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
</head>
<body>
<h1>lol</h1>
<ul>
    <?php ListItems(); ?>
</ul>
</body>
</html>