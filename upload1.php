<?php
header('Content-Type: charset=utf-8');
$ds          = DIRECTORY_SEPARATOR;  //1
 
$storeFolder = 'uploads';   //2
 
if (!empty($_FILES)) {
    $name = $_FILES['file']['name'];
    if(strpos($_FILES['file']['name'], ".xlsx")>0){
        $name = substr($name,strpos($_FILES['file']['name'], ".xlsx"));
    }
    if(strpos($_FILES['file']['name'], ".xls")>0){
        $name = substr($name,strpos($_FILES['file']['name'], ".xls"));
    }
    //$month=$_GET["cboMonth"];
    $year=date("Y")."-".date("m")."-".date("d")."-".date("h")."".date("m")."".date("s");
    $tempFile = $_FILES['file']['tmp_name'];          //3             
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds;  //4
     
    $targetFile =  $targetPath. $_FILES['file']['name'];  //5
    //$targetFile =  $targetPath. $year."".$name."@".$month;  //5
 
    move_uploaded_file($tempFile,$targetFile); //6
    echo "<P>FILE UPLOADED TO: $targetFile</P>";
}
?>
<!--- See more at: http://www.startutorial.com/articles/view/how-to-build-a-file-upload-form-using-dropzonejs-and-php#sthash.APTCQ8nP.dpuf-->