<?php
//error_reporting(E_ALL);
//set_time_limit(0);
//
//date_default_timezone_set('Europe/London');
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//set_include_path(get_include_path() . PATH_SEPARATOR . '/Classes/');
//require_once dirname(__FILE__) . '/Classes/PHPExcel/IOFactory.php';
//$inputFileName = dirname(__FILE__) .'/uploads/11111.xlsx';
//$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
//$objReader = PHPExcel_IOFactory::createReader($inputFileType);
//$objReader->setReadDataOnly(true);
//$objPHPExcel = $objReader->load($inputFileName);
//$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
//$objWorksheet = $objPHPExcel->getActiveSheet();
//$highestRow = $objWorksheet->getHighestRow();
//$highestColumn = $objWorksheet->getHighestColumn();
//
//$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
//$headingsArray = $headingsArray[1];
//$r = -1;
//$namedDataArray = array();
////for ($row = 2; $row <= $highestRow; ++$row) {
////    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
////    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
////        ++$r;
////        foreach($headingsArray as $columnKey => $columnHeading) {
////            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
////        }
////    }
////}
header('Content-Type: application/json');
$response = array();
$resultArray = array();
$response["success"] = 0;
$response["message"] = "Error";
array_push($resultArray,$response);
echo json_encode($resultArray);
//$sheetData = $objPHPExcel->getActiveSheet()->toArray(null,true,true,true);


?>
