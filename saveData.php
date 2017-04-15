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
    $tax_id=$_GET["tax_id"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    if($_GET["comp_id"]==="-"){
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
}else if($_GET["flagPage"] === "branch"){
    $branch_id=$_GET["branch_id"];
    $branch_code=$_GET["branch_code"];
    $branch_name=$_GET["branch_name"];
    $branch_address=$_GET["branch_address"];
    $tele=$_GET["tele"];
    if(($_GET["branch_id"]==="-") || ($_GET["branch_id"]==="")){
        $sql="Insert Into b_branch(branch_id, branch_code, branch_name, branch_address, tele, active, date_create) "
                ."Values(UUID(),'".$branch_code."','".$branch_name."','".$branch_address."','".$tele."','1',now())";
    }else{
        $sql="Update b_branch "
                ."Set branch_code = '".$branch_code."' "
                .", branch_name = '".$branch_name."' "
                .", branch_address = '".$branch_address."' "
                .", tele = '".$tele."' "
                .", date_modi = now() "
                ."Where branch_id = '".$branch_id."'";
    }
}else if($_GET["flagPage"] === "customer"){
    $cust_id=$_GET["cust_id"];
    $cust_code=$_GET["cust_code"];
    $cust_name_t=$_GET["cust_name_t"];
    $cust_address_t=$_GET["cust_address_t"];
    $tele=$_GET["tele"];
    $email=$_GET["email"];
    $tax_id=$_GET["tax_id"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    if(($_GET["cust_id"]==="-")|| ($_GET["cust_id"]==="")){
        $sql="Insert Into b_customer(cust_id, cust_code, cust_name_t, cust_address_t, tele, email, tax_id, active, date_create) "
                ."Values(UUID(),'".$cust_code."','".$cust_name_t."','".$cust_address_t."','".$tele."','".$email."','".$tax_id."','1',now())";
    }else{
        $sql="Update b_customer "
                ."Set cust_code = '".$cust_code."' "
                .", cust_name_t = '".$cust_name_t."' "
                .", cust_address_t = '".$cust_address_t."' "
                .", tele = '".$tele."' "
                .", email = '".$email."' "
                .", tax_id = '".$tax_id."' "
                .", prov_id = '".$prov_id."' "
                .", amphur_id = '".$amphur_id."' "
                .", district_id = '".$district_id."' "
                .", zipcode = '".$zipcode."' "
                .", date_modi = now() "
                ."Where cust_id = '".$cust_id."'";
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