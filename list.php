<?php

function make_list ($path = ".") {

    $not = [".", "..", "list.txt", "list.php", "list.php~", "image", "index.html", "index.html~", ".git", "LICENSE", "README.md", "google0a141cc724bea402.html", "sw.js", "sitemap.xml", "sitemap.xml~", "sitemap.php", "sitemap.php~"];
    $dir = opendir($path);
    $files = [];
    
    while (false !== ($e = readdir($dir))) {

        if (! in_array($e, $not) ) {

            if( is_dir("$path/$e") ) {

                make_list ("$path/$e");
            }

            $files[] = [
            "path" => $e,
            "size" => number_format(filesize("$path/$e")/1000000, 1) . "MB",
            ];
        }
    }

    sort($files);
    for($i = 0; $i<count($files); $i++) {
    $files[$i] = implode("\t", $files[$i]);
    }
    $list = implode("\n", $files);

    $f = fopen("$path/list.txt", "w");
    fwrite($f, $list);
    fclose($f);

    return true;
}

// run

echo make_list() . "\n";
