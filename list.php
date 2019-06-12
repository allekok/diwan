<?php
/* Function */
function make_list ($path = ".")
{
    $not = [".", "..", "list.txt", "list.php", ".git",
	    "LICENSE", "README.md", ".gitignore", "desc"];
    $files = [];
    $dir = opendir($path);
    
    while (false !== ($e = readdir($dir)))
    {
        if(in_array($e, $not))
	    continue;	
        // Get book description
        $desc = "";
        if(file_exists("$path/desc/$e.txt"))
	{
            $desc = trim(file_get_contents("$path/desc/$e.txt"));
	}
        $files[] = [
	    "path" => $e,
	    "size" => number_format(filesize("$path/$e")/1000000, 1) . "MB",
	    "desc" => $desc,
        ];
    }
    sort($files);
    for($i = 0; $i<count($files); $i++)
    {
	$files[$i] = implode("\t\t", $files[$i]);
    }    
    $list = implode("\n\n", $files);
    file_put_contents("$path/list.txt", $list);
}

/* Run */
make_list();
?>
