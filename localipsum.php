<?php


function loadData($fname = "localities/Cleveland.txt") {
	$dir = "./";

	if (file_exists($dir.$fname)) {
		$fs=fopen($dir.$fname, "r");
		while (!feof($fs)) {
		    $array[] = trim(fgets($fs));
		}
		fclose($fs);
	} else {
		echo "Unrecoverable error: <tt>" . $dir.$fname. "</tt> could not be found.";
		return false;
	}

	$title = array_splice($array, 0, 1)[0];
	$locale = array_splice($array, 0, 1)[0];

	for ($a = 0; $a < count($array); $a++) {
		$string = $array[$a];
		$cmtp = strpos($string,'//');
		if ($cmtp !== false) {
			$string = substr($string,0,$cmtp);
			$array[$a] = $string;
		}
		if ($string == '') {
			array_splice($array, $a, 1);
			$a--;
		}
	}

	return array("title" => $title, "locale" => $locale, "local" => $array, "ipsum" => "Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero eros et accumsan et iusto odio dignissim qui blandit praesent luptatum zzril delenit augue duis dolore te feugait nulla facilisi. Nam liber tempor cum soluta nobis eleifend option congue nihil imperdiet doming id quod mazim placerat facer possim assum. Typi non habent claritatem insitam; est usus legentis in iis qui facit eorum claritatem. Investigationes demonstraverunt lectores legere me lius quod ii legunt saepius. Claritas est etiam processus dynamicus, qui sequitur mutationem consuetudium lectorum. Mirum est notare quam littera gothica, quam nunc putamus parum claram, anteposuerit litterarum formas humanitatis per seacula quarta decima et quinta decima. Eodem modo typi, qui nunc nobis videntur parum clari, fiant sollemnes in futurum.");

}


function makeText($pc = 5, $pl = 2, $sl = 2, $ln = 2, $data) {
	global $debug, $start;  // yeah, yeah

	$array = $data["local"];
	$ipsum_array = explode(" ", preg_replace("/[.,;]/","",$data["ipsum"]));

	while (count($ipsum_array) < count($array)) {
		$ipsum_array = array_merge($ipsum_array,$ipsum_array);
	}
	array_splice($ipsum_array,count($array));

	if ($debug) {
		echo "<p class=\"debug\"><a href=\"local.txt\">Input</a>: ";
		echo count($array);
		echo " • Filler: ";
		echo count($ipsum_array);
	}

//	$mc = 1;	// 0 = no filler; 5 = almost all filler; 10 = WTF
	for ($m = 0; $m < $ln; $m++) {
		$array = array_merge($array, $ipsum_array);
	}

	if ($debug) {
		echo " • Source: ";
		echo count($array);
	}

	shuffle($array);
	reset($array);

	$output = '';

//	$pc = rand(4,7);
	
	for ($p = 0; $p < $pc; $p++) {
		$output .= "<p>";
		$sc = rand($pl,$pl*2)*3;
		for ($s = 0; $s < $sc; $s++) {
			$wc = rand($sl,$sl*3)*2;
			for ($w = 0; $w < $wc; $w++) {
				if (!current($array)) {
					shuffle($array);
					reset($array);
					if ($debug) {
						echo " <span class=\"array-reset\">↺</span>";
						$output .= " <b class=\"array-reset\">↺</b> ";
					}
				}
				$word = strtolower(trim(current($array)));
				if ($w == 0) $word = ucfirst($word);
				if ($w > $wc/4 && $w < $wc*3/4) {
					$cp = 8;
					if (!(rand(0,$cp))) $word .= ",";
				}
				$output .= $word . " ";
				next($array);	
			}
		$output = rtrim($output) . ". ";
		}
	$output = rtrim($output) . "</p>\n";
	}

	if ($debug) {
		$end = microtime(true);
		$creationtime = ($end - $start);
		printf(" • %.5f sec", $creationtime);
		echo "</p>\n\n";
	}

	echo "<div class=\"output\">\n";

	echo $output;
	
	echo "</div>\n";

	if ($debug) {
		// echo "<pre>" . var_dump($array) . "</pre>";
	}

}


?>
