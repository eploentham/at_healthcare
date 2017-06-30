<?php

/** PHPExcel */
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';


$inputFileName = "myData.xlsx";  
$inputFileType = PHPExcel_IOFactory::identify($inputFileName);  
$objReader = PHPExcel_IOFactory::createReader($inputFileType);  
$objReader->setReadDataOnly(true);  
$objPHPExcel = $objReader->load($inputFileName);  

/*
// for No header
$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$r = -1;
$namedDataArray = array();
for ($row = 1; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $namedDataArray[$r] = $dataRow[$row];
    }
}
*/

$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();

$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);
$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
        }
    }
}

echo '<pre>';
var_dump($namedDataArray);
echo '</pre><hr />';

?>
<table width="500" border="1">
  <tr>
    <td>CustomerID</td>
    <td>Name</td>
    <td>Email</td>
    <td>CountryCode</td>
    <td>Budget</td>
    <td>Used</td>
  </tr>
<?php
foreach ($namedDataArray as $result) {
?>
	  <tr>
		<td><?php echo $namedDataArray[0]["CustomerID"];?></td>
		<td><?php echo $namedDataArray[0]["Name"];?></td>
		<td><?php echo $namedDataArray[0]["Email"];?></td>
		<td><?php echo $namedDataArray[0]["CountryCode"];?></td>
		<td><?php echo $namedDataArray[0]["Budget"];?></td>
		<td><?php echo $namedDataArray[0]["Used"];?></td>
	  </tr>
<?php
}
?>
</table>