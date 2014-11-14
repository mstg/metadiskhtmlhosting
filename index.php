<?php
	$url = 'http://node1.metadisk.org/api/download/c3b347c10a932fc4f229c9d3da0908402ce9434ab1b9a5be7e1e8e093969ac18?key=a7fc7a7849c55ff8882917060c9fd37a4aaecee5df51c1525a274c7039f968ad&token=UqaWt2Pckt0sAHhV';
	$filelist = file_get_contents($url);

	$files = explode("\n", $filelist);
	
	$page = $_GET["page"];
	if (empty($page)) {
		$page = "index.html";
	}

	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		if ($fileandurl[0] == $page) {
			$html = file_get_contents("http:" . $fileandurl[2]);

			$html = $html . "<br />" . "http:" . $fileandurl[2] . "<br \>" . "Showing file: " . $fileandurl[0];
		}
	}

	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		$page = str_replace(".html", ".css", $page);

		if ($fileandurl[0] == $page) {
			$css = "<style type='text/css'>" . file_get_contents("http:" . $fileandurl[2]) . "</style>";
			$html = str_replace('$css', $css, $html);
		}
	}

	echo $html;

	echo "<br/><br/>File list:<br />";
	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		if (strpos($fileandurl[0], ".css") === false)
			echo "<a href='/?page=" . $fileandurl[0] . "'>" . $fileandurl[0] . "</a><br />";
	}

	echo "<br/>Stylesheet list:<br />";
	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		if (strpos($fileandurl[0], ".css") !== false)
			echo $fileandurl[0] . " - " . "http:" . $fileandurl[2];
	}
?>