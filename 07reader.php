<?php
require_once("inc/init.php");
/** PHPExcel */
require_once 'Classes/PHPExcel.php';

/** PHPExcel_IOFactory - Reader */
include 'Classes/PHPExcel/IOFactory.php';
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error($conn);
    echo "<script>alert(".mysqli_error($conn).");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");


$inputFileName = "uploads/11111.xlsx";  
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

//$objWorksheet = $objPHPExcel->setActiveSheetIndex(0);
$objWorksheet = $objPHPExcel->getActiveSheet();
$highestRow = $objWorksheet->getHighestRow();
$highestColumn = $objWorksheet->getHighestColumn();
echo $highestColumn;
$headingsArray = $objWorksheet->rangeToArray('A1:'.$highestColumn.'1',null, true, true, true);

$headingsArray = $headingsArray[1];

$r = -1;
$namedDataArray = array();
$col=0;
for ($row = 2; $row <= $highestRow; ++$row) {
    $dataRow = $objWorksheet->rangeToArray('A'.$row.':'.$highestColumn.$row,null, true, true, true);
//    if ((isset($dataRow[$row]['A'])) && ($dataRow[$row]['A'] > '')) {
        ++$r;
        $col=0;
        foreach($headingsArray as $columnKey => $columnHeading) {
            $col++;
//            $namedDataArray[$r][$columnHeading] = $dataRow[$row][$columnKey];
            $namedDataArray[$r][$col] = $dataRow[$row][$columnKey];
        }
//    }
}


$sql="";
$row1=0;
$aaa= "";
//foreach ($namedDataArray as $result) {
//    $row1++;
//    $aaa = str_replace($result[7], "'", "''");
//    $sql = "Insert Into lab_t_data(data_id, branch_id, month_id, year_id, period_id"
//            .", row1, doc_code, lab_date, hn, full_name"
//            .", paid_type_name, lab_code, lab_name, price1, price2"
//            .", price3, price4, price5, active) "
//            ."Values(UUID(), '','','','' "
//            .", '".$row1."', '".$result[1]."', '".$result[2]."', '".$result[3]."', '".$result[4]."' "
//            .", '".$result[5]."', '".$result[6]."', '".str_replace($result[7], "'", "''")."', '".$result[8]."', '".$result[9]."' "
//            .", '".$result[10]."', '".$result[11]."', '".$result[12]."', '1')";
//    if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
//        
//    }
//}



//$result->free();
mysqli_close($conn);


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
		<td><?php echo $result[1];?></td>
		<td><?php echo $result[2];?></td>
		<td><?php echo $result[3];?></td>
		<td><?php echo $result[4];?></td>
		<td><?php echo $result[5];?></td>
		<td><?php echo $result[6];?></td>
	  </tr>
<?php
}
?>
</table>