<?php
	$url = 'http://node1.metadisk.org/api/download/facb981c0df9b96b681849bcc8955c4e228625ef7f01e4358dce877d3476c404?key=a286790cfb84b13e4c7fff9c01043cbd94d1bc016c513166935ecf4b6102458c&token=UqaWt2Pckt0sAHhV';
	$filelist = file_get_contents($url);

	$files = explode("\n", $filelist);
	
	$page = $_GET["page"];
	if (empty($page)) {
		$page = "index.html";
	}

	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		if ($fileandurl[0] == $page) {
			echo file_get_contents("http:" . $fileandurl[2]);
			echo "http:" . $fileandurl[2] . "<br \>" . "Showing file: " . $fileandurl[0];
		}
	}

	echo "<br/><br/>File list:<br />";
	foreach ($files as $file) {
		$fileandurl = explode(":", $file);

		echo "<a href='/?page=" . $fileandurl[0] . "'>" . $fileandurl[0] . "</a><br />";
	}
?>