<?php
session_start();
//include("include/config.php");

//use config\db\abybaby as config;  //use namespace from config file's class

//$obj_db = new config\DB;           //object create for db class
//$obj_api = new config\API;         //objecrt create for api class


// (A) CONNECT TO DATABASE
// ! CHANGE THESE SETTINGS TO YOUR OWN !

$dbhost = "localhost";
$dbname = "abybabyevents_hfdelux-canter";
$dbchar = "utf8";
$dbuser = "abybabyevents_hfdelux_canter";
$dbpass = "?(0^5l$!1!vD";
$pdo = new PDO(
  "mysql:host=$dbhost;charset=$dbchar;dbname=$dbname",
  $dbuser, $dbpass, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_NAMED
  ]
);

// (B) LOAD PHPSPREADSHEET
require "vendor/autoload.php";
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;



?>





<?php

// (C) CREATE A NEW SPREADSHEET + WORKSHEET
$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Users');


// (D) FETCH USERS + WRITE TO SPREADSHEET
$stmt = $pdo->prepare("SELECT * FROM `tbl_data`");
$stmt->execute();
$i = 2;
  $sheet->setCellValue('A1', 'Date');
  $sheet->setCellValue('B1', 'Dealership Name');
  $sheet->setCellValue('C1', "Location");
  $sheet->setCellValue('D1', 'Customer Name');
  $sheet->setCellValue('E1', 'Contact No');
  $sheet->setCellValue('F1', 'Current Vehicle');
  $sheet->setCellValue('G1', 'Intrested Vehicle');
  $sheet->setCellValue('H1', 'Exchange');
  $sheet->setCellValue('I1', "Test Ride");
  $sheet->setCellValue('J1', 'HWC');
  

while ($row = $stmt->fetch()) {
  $sheet->setCellValue('A'.$i, $row['date1']);
  $sheet->setCellValue('B'.$i, $row['dealership']);
  $sheet->setCellValue('C'.$i, $row['location']);
  $sheet->setCellValue('D'.$i, $row['customer_name']);
  $sheet->setCellValue('E'.$i, $row['contact_no']);
  $sheet->setCellValue('F'.$i, $row['current_vehicle']);
  $sheet->setCellValue('G'.$i, $row['intrested_vehicle']);
  $sheet->setCellValue('H'.$i, $row['exchange']);
  $sheet->setCellValue('I'.$i, $row['testride']);
  $sheet->setCellValue('J'.$i, $row['hwc']);


  $i++;
}
   

// (E) SAVE FILE
$writer = new Xlsx($spreadsheet);
$writer->save('report.xlsx');
?>
<script>
    window.location.assign('https://businessenquiry.co.in/hf-deluxe-cantar/abybaby-admin/report.xlsx');
    setTimeout(function(){ 
    window.location.assign('https://businessenquiry.co.in/hf-deluxe-cantar/abybaby-admin/');
        
    }, 3000);
</script>
