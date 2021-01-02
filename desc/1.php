<?php
$fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];

function ck($str) {
	$fa = ["۰", "۱", "۲", "۳", "۴", "۵", "۶", "۷", "۸", "۹"];
	$ck = ["٠", "١", "٢", "٣", "٤", "٥", "٦", "٧", "٨", "٩"];
	$str = str_replace($fa, $ck, $str);
	return $str;
}

$files = array_diff(scandir("."), [".", "..", "1.php"]);

foreach($files as $file) {
	foreach($fa as $n) {
		if(strpos($file, $n) !== false) {
			echo $file . "\n";
			$new_file = ck($file);
			rename($file, $new_file);
			break;
		}
	}
}
?>
