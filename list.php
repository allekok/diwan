<?php

function make_list ($path = ".") {

    $not = [".", "..", "list.txt", "list.php", ".git", "LICENSE", "README.md", ".gitignore", "desc", "list-filenames.php", "list-filenames.txt"];
    $dir = opendir($path);
    $files = [];
    
    while (false !== ($e = readdir($dir))) {

        if (! in_array($e, $not) ) {
            // get desc
            $desc = "";
            if(file_exists("$path/desc/$e.txt")) {
                $desc = file_get_contents("$path/desc/$e.txt");
            }

            $files[] = [
		"path" => $e,
		"size" => number_format(filesize("$path/$e")/1000000, 1) . "MB",
		"desc" => substr($desc,0,strlen($desc)-1),
            ];
        }
    }

    sort($files);
    for($i = 0; $i<count($files); $i++) {
	$files[$i] = implode("\t\t", $files[$i]);
    }
    $list = implode("\n\n", $files);

    $f = fopen("$path/list.txt", "w");
    fwrite($f, $list);
    fclose($f);

    return true;
}

// run

echo make_list() . "\n";

exec("php list-filenames.php");

?>
