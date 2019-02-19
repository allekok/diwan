<?php

function make_list ($path = ".") {

    $not = [".", "..", "list.txt", "list.php", "list.php~", "image", "index.html", "index.html~", ".git", "LICENSE", "README.md", "google0a141cc724bea402.html", "sw.js", "sitemap.xml", "sitemap.xml~", "sitemap.php", "sitemap.php~", "download.php~", "download.php", "sw.js~", "README.md~", ".gitignore", "1-list.php", "desc", "list-filenames.php", "list-filenames.txt"];
    $dir = opendir($path);
    $files = [];
    
    while (false !== ($e = readdir($dir))) {

        if (! in_array($e, $not) ) {

            if( is_dir("$path/$e") ) {

                make_list ("$path/$e");
            }

            $files[] = "\"{$e}\"";
        }
    }

    sort($files);
    
    $list = "(list\n" . implode("\n", $files) . "\n)";

    $f = fopen("$path/list-filenames.txt", "w");
    fwrite($f, $list);
    fclose($f);

    return true;
}

// run
echo make_list() . "\n";
