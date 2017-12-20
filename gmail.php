<?php
/**
 * This example shows settings to use when sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'phpmailer/PHPMailerAutoload.php';
require 'phpmailer/class.phpmailer.php';
require_once("inc/init.php"); 
//require 'config.php';
$uuid = "";
//if($_GET['flagPage']=="regis"){
//    $con = mysqli_connect("localhost",'root','Ekartc2c5','manit');
//    mysqli_set_charset($con, "UTF8");
//    $obj = mysqli_query($con, "Select uuid() as uuid");
//    $row = mysqli_fetch_array($obj);
//    $uuid = $row["uuid"];
//    //$resultArray = array();
//    $objQuery = mysqli_query($con,"Insert into b_customer(cust_id, user_login, cust_name_t, cust_lastname_t, password, email, tele, status_regis, date_create) "
//        ."Value ('".$uuid."', '".$_GET['reUsername']."','".$_GET['reName']."','".$_GET['reLastname']."','".$_GET['rePassword']."','".$_GET['reEmail']."','".$_GET['reTele']."','1',NOW())");
////    $cnt=0;
////    while($row = mysqli_fetch_array($objQuery)){
////        //$tmp = array();
////        $cnt++;
////        $resultArray[$cnt] = $row["email"];
////        //$tmp["prov_name"] = $row["prov_name"];
////        //array_push($resultArray,$tmp);
////    }
//    mysqli_close($con);
//}
if(isset($_GET["branch_id"])){
    $brId = $_GET["branch_id"];
}else{
    $brId = "";
}
if(isset($_GET["year_id"])){
    $yearId = $_GET["year_id"];
}else{
    $yearId = "";
}
if(isset($_GET["month_id"])){
    $monthId = $_GET["month_id"];
}else{
    $monthId = "";
}
if(isset($_GET["period_id"])){
    $periodId = $_GET["period_id"];
}else{
    $periodId = "";
}
$data="";
$name = $brId."_".$yearId."_".$monthId."_".$periodId.".txt";
$storeFolder = 'textfiles'; 
$ds          = DIRECTORY_SEPARATOR;
$targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
$targetFile =  $targetPath.$name;

$where="Where branch_id = '".$brId."' and year_id = '".$yearId
    ."' and month_id = '".$monthId."' and period_id = '".$periodId."' and active = '1' ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select *  From lab_t_data "
    .$where;
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $data .= $aRec["doc_code"]."|".$aRec["lab_date"]."|".$aRec["hn"]."|".$aRec["full_name"]."|".$aRec["paid_type_name"]."|".$aRec["price3"]."|".$aRec["netprice"]."|".$aRec["lab_code"]."|".$aRec["lab_name"]."\n";
    }
}
$labEmailTo="";
$labEmailFrom="";
$labEmailSubject="";
$brname="";
$monthname="";
$periodname="";
$sql = "Select * from b_customer;";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $labEmailTo=$aRec["lab_email_address_to"];
        $labEmailFrom=$aRec["lab_email_address_from"];
        $labEmailSubject=$aRec["lab_email_subject_to"];
    }
}
if($brId==="1"){
    $brname="บางนา 1";
}else if($brId==="2"){
    $brname="บางนา 2";
}else if($brId==="5"){
    $brname="บางนา 5";
}
$brname = getBranchName($brId);
$monthname = getMonthName($monthId);
$periodname = getPeriodName($periodId);
$labEmailSubject.= " ".$brname." ประจำ ปี ".$yearId." เดือน ".$monthname." งวด ".$periodname;
$rComp->free();
mysqli_close($conn);

$Handle = fopen($targetFile, 'w');
fwrite($Handle, $data); 
fclose($Handle);


//require_once ("phpmailer/class.phpmailer.php");
//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();
$mail->CharSet = "UTF-8";
//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 0;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
//$mail->Host = 'smtp-relay.gmail.com';
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
//$mail->Port = 587;
$mail->Port = 465;

//Set the encryption system to use - ssl (deprecated) or tls
//$mail->SMTPSecure = 'tls';
$mail->SMTPSecure = 'ssl';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
//$mail->Username = "ekapop@nakoyagarden.com";
$mail->Username = "eploentham@gmail.com";

//Password to use for SMTP authentication
//$mail->Password = "eploentham";
$mail->Password = "Tiriris1*";

//Set who the message is to be sent from
$mail->setFrom('eploentham@gmail.com', 'บริษัท เอทีทีเอ2016 จำกัด');

//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');

//Set who the message is to be sent to
$mail->addAddress($labEmailTo);
//$mail->addAddress('janenaja77@gmail.com', 'janenaja77@gmail.com');
//$mail->addAddress('onelove-oil@hotmail.com', 'onelove-oil@hotmail.com');

//Set the subject line
$mail->Subject = $labEmailSubject;

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body  ท่านได้สมัคร
$html = file_get_contents('email_regis.html');
$html = str_replace("nakoyasoft.com/manit/email_confirm.php", "nakoyasoft.com/manit/email_confirm.php?cust_id=".$uuid,$html);
//$html = str_replace("ท่านได้สมัคร", "คุณ ".$_GET['reName']." ".$_GET['reLastname']." ได้สมัคร",$html);
$mail->msgHTML($html, dirname(__FILE__));

//Replace the plain text body with one created manually
$mail->AltBody = 'Manit Insurance ';

//Attach an image file
$mail->addAttachment($targetFile);
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/icons/icon_support.png');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/block_img/picture_one.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/block_img/picture_two.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/headliner/headliner_blue.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/block_img/middle_picture.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/block_img/right_picture.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/block_img/left_picture.jpg');
//$mail->addAttachment('http://nakoyasoft.com/tavon_web_site/assets/img/logo/logo_blue.png');

//send the message, check for errors
$response = array();
$resultArray = array();
if(!$mail->send()){
    //echo "Password " .$mail->Password."<br>";
    $response["success"] = 1;
    $response["message"] = "Success";
    $response["error"] = $err;
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
    echo "Mailer Error: " . $mail->ErrorInfo."<br>"."reEmail ".$_GET['reEmail']."<br>reUsername ".$_GET['reUsername']."<br>uuid=".$uuid;
}else{
    $response["success"] = 0;
    $response["message"] = "Error";
    $response["error"] = mysqli_error($conn);
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
    echo "Message sent!". get_client_ip();
}
