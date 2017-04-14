<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$databaseName="at_healthcare";
$userDB="root";
$passDB="";
$hostDB="localhost";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="";
if($_GET["flagPage"] === "company"){
    $comp_id=$_GET["comp_id"];
    $comp_code=$_GET["comp_code"];
    $comp_name_t=$_GET["comp_name_t"];
    $comp_address_t=$_GET["comp_address_t"];
    $tele=$_GET["tele"];
    $email=$_GET["email"];
    $tax_id=$_GET["taxid"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    if($_GET["comp_id"]=="-"){
        $sql="Insert Into b_company(comp_id, comp_code, comp_name_t, comp_address_t, tele, email, tax_id, date_create) "
                ."Values(UUID(),'".$comp_code."','".$comp_name_t."','".$comp_address_t."','".$tele."','".$email."','".$tax_id."',now())";
    }else{
        $sql="Update b_company "
                ."Set comp_code = '".$comp_code."' "
                .", comp_name_t = '".$comp_name_t."' "
                .", comp_address_t = '".$comp_address_t."' "
                .", tele = '".$tele."' "
                .", email = '".$email."' "
                .", tax_id = '".$tax_id."' "
                .", prov_id = '".$prov_id."' "
                .", amphur_id = '".$amphur_id."' "
                .", district_id = '".$district_id."' "
                .", zipcode = '".$zipcode."' "
                .", date_modi = now() "
                ."Where comp_id = '".$comp_id."'";
    }
}
$response = array();
$resultArray = array();
$err = "";



$result = mysqli_query($conn,$sql);
header('Content-Type: application/json');
if(!$result){
    $response["success"] = 0;
    $response["message"] = "insert Order success";
    $response["error"] = mysqli_error();
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}else{
    $response["success"] = 1;
    $response["message"] = "insert Order success";
    $response["error"] = $err;
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}
//echo mysql_error();
mysqli_close($conn);
?>