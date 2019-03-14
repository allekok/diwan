<?php

function make_list ($path = ".") {

    $not = [".", "..", "list.txt", "list.php", ".git", "LICENSE", "README.md", ".gitignore", "desc", "list-filenames.php", "list-filenames.txt"];
    $dir = opendir($path);
    $files = [];
    
    while (false !== ($e = readdir($dir))) {

        if (! in_array($e, $not) ) {

            $files[] = $e;
        }
    }

    sort($files);
    
    $list = implode("\n", $files);

    $f = fopen("$path/list-filenames.txt", "w");
    fwrite($f, $list);
    fclose($f);

    return true;
}

// run
echo make_list() . "\n";

?>
