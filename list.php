<?php
/* Function */
function make_list($path = ".") {
	$not = [".", "..", "list.txt", "list.php", ".git",
		"LICENSE", "README.md", ".gitignore", "desc"];
	$files = [];

	$dir = opendir($path);
	while(false !== ($file = readdir($dir))) {
		if(in_array($file, $not))
			continue;	

		$size = number_format(filesize("$path/$file") / 1e6, 1) . "MB";
		
		$desc = file_exists("$path/desc/$file.txt") ?
			trim(file_get_contents("$path/desc/$file.txt")) :
			"";

		$files[] = [
			"path" => $file,
			"size" => $size,
			"desc" => $desc,
		];
	}
	closedir($dir);
	
	sort($files);
	
	for($i = 0; $i < count($files); $i++)
		$files[$i] = implode("\t\t", $files[$i]);
	
	$list = implode("\n\n", $files);
	file_put_contents("$path/list.txt", $list);
}

/* Run */
make_list();
?>
