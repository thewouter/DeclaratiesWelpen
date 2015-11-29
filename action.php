<html>
 <head>
  <title>Declareren Welpen Scouting dedemsvaart </title>
  <style type="text/css">
    .form {
        width: 100%;
        clear: both;
    }
    .form input {
        width: 60%;
        clear: both;
        float: right;
    }
    .form textarea {
        width: 60%;
        clear: both;
        float: right;
    }
    .container {
    	width: 700px;
    	margin:0 auto;
    }
    h1 {
    	text-align: center;
    }
    body{
    	background-color: #00cc65;
    }
    
    </style>
 </head>
<body>
<div class='container' >
<h1>Aanvraag ontvangen.</h1>

<?php
//echo htmlspecialchars($_POST['name']) . "</br>";
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

function thisYear($var) {
	if (strpos($var, "B".substr(date("Y"),2,3)) !== false){
		return true;
	}
	return false;
}

$speltak = htmlspecialchars($_POST['speltak']);
$target_dir = getcwd() . "/" . $speltak ."/" . date("Y") . "/uploads/";

if (!file_exists($target_dir)) {
	mkdir($target_dir, 0777, true);
}

// Determine file name
$all_files = scandir($target_dir);

$filename = "B" . substr(date("Y"),2,3);
if($all_files !== false){
	$files = array_filter($all_files, "thisYear");
	
	usort($files, 'strnatcmp');
	$prevnum = intval(substr(end($files), 3, 2));
	$curnum = $prevnum + 1;
} else {
	$curnum = 1;
}

$format = "%1$02d";
$filename = $filename . sprintf($format, $curnum);
$id = $filename;

echo "</br>";
$uploadName = explode(".", basename($_FILES["fileToUpload"]["name"]), 9);
$target_file = $target_dir . $filename . "." . end($uploadName);		//basename($_FILES["fileToUpload"]["name"]);

$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
/*
echo "</br>";
echo "target: " . $target_file;
echo "</br>";
/*
// Check if file already exists
if (file_exists($target_file)) {
	echo "Sorry, file already exists.</br>";
	$uploadOk = 0;
} else {
	//echo "File doesn't exist jet. </br>";
}
*/
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
	echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.</br>";
	echo $imageFileType . "</br>";
	//$uploadOk = 0;
}

// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
	echo "Sorry, your file was not uploaded.";
	// if everything is ok, try to upload file
} else {
	if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
		echo "Bonnetje met nummer ". $filename . " is ingediend.";
	} else {
		echo "Sorry, there was an error uploading your file.";
	}
}
echo "</br></br></br></br>";

//EXCEL
$excelFile = getcwd() . "/" . $speltak . "/" . date("Y") . "/data.xlsx";

echo $excelFile;

if (!file_exists($excelFile)){
	if(!copy(getcwd() . "/templates/" . "data.xlsx", $excelFile));
}

$ea = PHPExcel_IOFactory::load($excelFile);

$newRow = 0;

for($i = 1;;$i++) {
	$cell = $ea->getActiveSheet()->getCell('A'. sprintf("%d", $i));
	if($cell->getValue() === NULL || $cell->getValue() === ''){
		$newRow = $i;
		break;
	} else {
		echo $cell->getValue()."<br>";
	}
}
echo $newRow;

$ea->getActiveSheet()->setCellValue("A".$newRow, $id);
$ea->getActiveSheet()->setCellValue("B".$newRow, $_POST['name']);
$ea->getActiveSheet()->setCellValue("C".$newRow, $_POST['iban']);
$ea->getActiveSheet()->setCellValue("D".$newRow, $_POST['rekhouder']);
$ea->getActiveSheet()->setCellValue("E".$newRow, $_POST['amount']);
$ea->getActiveSheet()->setCellValue("F".$newRow, $_POST['comment']);

$objWriter = new PHPExcel_Writer_Excel2007($ea);
$objWriter->save($excelFile);

?>
</div>
</body>