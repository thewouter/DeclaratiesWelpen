<html>
 <head>
  <title>Declareren Welpen Scouting dedemsvaart </title>
	<link rel="stylesheet" type="text/css" href="base.css">
 </head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

define('EOL',(PHP_SAPI == 'cli') ? PHP_EOL : '<br />');
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';


$speltak = htmlspecialchars($_POST['speltak']);

function thisYear($var) {
	if (strpos($var, "B".substr(date("Y"),2,3)) !== false){
		return true;
	}
	return false;
}

if($speltak == "both"){
	processBon("jongens", 0.5, true);
	processBon("meisjes", 0.5, true);
} else {
	processBon($speltak, 1, false);
}

function processBon($speltak, $factor, $both){
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
	$photodir = scandir(getcwd() . "/tmp/");
	$photo = getcwd() . "/tmp/" . end($photodir);
	
	$uploadName = explode(".", $photo, 9);
	$target_file = $target_dir . $filename . "." . end($uploadName);		//basename($_FILES["fileToUpload"]["name"]);
	
	$uploadOk = 1;
	$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
		if (sizeof($photodir) !== 2){
			unlink($photo);
			echo "Sorry, alleen JPG, JPEG, PNG & GIF bestanden zijn toegestaan.<br>";
		} else {
			echo "Geen foto gegeven.<br>";
		}
		$uploadOk = 0;
	}
	
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		return;
		// if everything is ok, try to upload file
	} elseif($both == false){
		if (rename($photo, $target_file)) {
			
			echo "<h3>Declaratie Ingediend.</h3>";
			 
			
			echo "Bonnetje met nummer ". $filename . " is ingediend.";
		} else {
			echo "Sorry, there was an error uploading your file." . $photo . "  " . $target_file;
		}
	} else {
		if (copy($photo, $target_file)) {
			
			echo "<h3>Declaratie Ingediend.</h3>";
			 
			
			echo "Bonnetje met nummer ". $filename . " is ingediend.";
		} else {
			echo "Sorry, there was an error uploading your file." . $photo . "  " . $target_file;
		}
	}
	//EXCEL
	$excelFile = getcwd() . "/" . $speltak . "/" . date("Y") . "/data.xlsx";
	
	
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
		}
	}
	
	$ea->getActiveSheet()->setCellValue("A".$newRow, $id);
	$ea->getActiveSheet()->setCellValue("B".$newRow, $_POST['name']);
	$ea->getActiveSheet()->setCellValue("C".$newRow, $_POST['iban']);
	$ea->getActiveSheet()->setCellValue("D".$newRow, $_POST['rekhouder']);
	$ea->getActiveSheet()->setCellValue("E".$newRow, $_POST['amount']);
	$ea->getActiveSheet()->setCellValue("F".$newRow, $_POST['comment']);
	$ea->getActiveSheet()->setCellValue("G".$newRow, $factor);
	
	$objWriter = new PHPExcel_Writer_Excel2007($ea);
	$objWriter->save($excelFile);
}
?>
</body>