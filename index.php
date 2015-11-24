<?php

$debug = true;
if ($debug) {
	error_reporting(E_ALL);
	ini_set('display_errors', '1');
	$start = microtime(true);
}

if (isset($_GET['pc'])) {
	$pc = $_GET['pc'];
	$submitted = true;
} else {
	$pc = 5;
	$submitted = false;
}
(isset($_GET['pl']) ? $pl = $_GET['pl'] : $pl = 2);
(isset($_GET['sl']) ? $sl = $_GET['sl'] : $sl = 2);
(isset($_GET['ln']) ? $ln = $_GET['ln'] : $ln = 2);
(isset($_GET['lf']) ? $lf = $_GET['lf'] : $lf = '');
(isset($_GET['l']) ? $l = $_GET['l'] : $l = 'Cleveland');

include("localipsum.php");
$array = ($l ? loadData('localities/' . $l . '.txt') : Array('title'=> 'Local Ipsum'));

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php if ($array["title"]) echo $array["title"]; else echo "Local Ipsum"; ?></title>
<style type="text/css">

body {padding: 2em;	font: 95% Helvetica, sans-serif;}
body h1 {margin: 0; padding: 0.5em 0.25em 0;
	background: rgba(0,0,0,0.25);
	font-size: 175%;}
body ol {margin: 0 0 1em; padding: 0;}
body li {margin-top: 0.5em; list-style: none;}

form {border: 0.25em solid silver;
	margin-bottom: -0.25em; padding: 1em 2em;
	background: rgba(0,0,0,0.05);}

.debug {position: absolute; top: 0; right: 0;
	margin: 0; padding: 0.5em;
	border: 1px solid rgba(204,0,0,0.5); border-width: 0 0 1px 1px;
	color: #633; background: rgba(204,0,0,0.05);
	font-size: 90%;}
.array-reset {color: maroon; background: yellow;}

.output {border: 0.25em solid gray;
	padding: 1em 2em;
	font: medium/1.3 Georgia, serif;}

footer {position: absolute; top: 5em; right: 5em;
	margin: 0; padding: 0;
	font-style: italic; font-size: small; text-align: right;
	opacity: 0.5;}

/*
ol {display: flex;}
li {justify-content: stretch; flex-grow: 1;}
ol label {display: block; background: silver; padding: 0.5em 0.5em 0.25em; margin: 0 0.1em 0.33em;}
ol + p {text-align: center; margin: 0;}
ol + p input {font-weight: bold;}
*/
</style>
</head>
<body>

<?php if ($array["title"]) { echo "<h1>" . $array["title"] . "</h1>"; ?>

<form method="get">

<ol>
<li><label for="l">What city do you want?</label>
<select id="l" name="l">
<?php
foreach(glob('localities/*.txt') as $localityFile){
	$locality = basename($localityFile, '.txt');
?>
	<option<?php if($l === $locality){ echo " selected"; } ?>><?=$locality?></option>
<?php } ?>
</select>
</li>
<li><label for="pc">How many paragraphs do you want?</label>
<input type="text" value="<?php echo $pc; ?>" size="3" maxlength="2" name="pc" id="pc"></li>
<li>How long should paragraphs be?
<label><input type="radio" name="pl" value="1"<?php if ($pl == 1) echo " checked" ?>>Short</label>
<label><input type="radio" name="pl" value="2"<?php if ($pl == 2) echo " checked" ?>>Moderate</label>
<label><input type="radio" name="pl" value="3"<?php if ($pl == 3) echo " checked" ?>>Long</label>
<label><input type="radio" name="pl" value="4"<?php if ($pl == 4) echo " checked" ?>>Epic</label>
<label><input type="radio" name="pl" value="5"<?php if ($pl == 5) echo " checked" ?>>Joycean</label>
</li>
<li>How long should sentences be?
<label><input type="radio" name="sl" value="1"<?php if ($sl == 1) echo " checked" ?>>Short</label>
<label><input type="radio" name="sl" value="2"<?php if ($sl == 2) echo " checked" ?>>Moderate</label>
<label><input type="radio" name="sl" value="3"<?php if ($sl == 3) echo " checked" ?>>Long</label>
<label><input type="radio" name="sl" value="4"<?php if ($sl == 4) echo " checked" ?>>Run-on</label>
<label><input type="radio" name="sl" value="5"<?php if ($sl == 5) echo " checked" ?>>Faulkneresque</label>
</li>
<li>How local do you want to get?
<label><input type="radio" name="ln" value="0"<?php if ($ln == 0) echo " checked" ?>>All local, all the time!</label>
<label><input type="radio" name="ln" value="1"<?php if ($ln == 1) echo " checked" ?>>Very local</label>
<label><input type="radio" name="ln" value="2"<?php if ($ln == 2) echo " checked" ?>>Kind of local</label>
<label><input type="radio" name="ln" value="3"<?php if ($ln == 3) echo " checked" ?>>Not very local</label>
<label><input type="radio" name="ln" value="4"<?php if ($ln == 4) echo " checked" ?>>Regional</label>
<label><input type="radio" name="ln" value="5"<?php if ($ln == 5) echo " checked" ?>>Remote</label>
</li>
<!-- li><label>Where’s your city data? (optional)</label> <input type="file" name="cd" id="cd"></li -->
</ol>
<p>
<input type="submit" value="Let’s do this!">
</p>

</form>

<?php

	if ($submitted) makeText($pc, $pl, $sl, $ln, $array);
}

?>

<footer>
Local Ipsum (beta.01) • A <a href="http://meyerweb.com/">meyerweb</a> joint
</footer>

</body>
</html>
