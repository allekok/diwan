<?php
/* Function */
function make_list_filenames ($path = ".") {
    $not = [".", "..", "list.txt", "list.php", ".git",
	    "LICENSE", "README.md", ".gitignore", "desc",
	    "list-filenames.php", "list-filenames.txt"];
    $files = [];
    $dir = opendir($path);
    
    while (false !== ($e = readdir($dir))) {
	
        if(! in_array($e, $not) ) {
	    
            $files[] = $e;
	}
    }

    sort($files);
    
    $list = implode("\n", $files);
    file_put_contents("$path/list-filenames.txt", $list);
}

/* Run */
make_list_filenames();
?>
