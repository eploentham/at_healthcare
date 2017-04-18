<?php
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//$hostDB="localhost";
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
}else if($_GET["flagPage"] === "vendor"){
    $vend_id=$_GET["vend_id"];
    $vend_code=$_GET["vend_code"];
    $vend_name_t=$_GET["vend_name_t"];
    $vend_address_t=$_GET["vend_address_t"];
    $tele=$_GET["tele"];
    $email=$_GET["email"];
    $tax_id=$_GET["tax_id"];
    $prov_id=$_GET["prov_id"];
    $amphur_id=$_GET["amphur_id"];
    $district_id=$_GET["district_id"];
    $zipcode=$_GET["zipcode"];
    if(($_GET["vend_id"]==="-")|| ($_GET["vend_id"]==="")){
        $sql="Insert Into b_vendor(vend_id, vend_code, vend_name_t, vend_address_t, tele, email, tax_id, active, date_create) "
                ."Values(UUID(),'".$vend_code."','".$vend_name_t."','".$vend_address_t."','".$tele."','".$email."','".$tax_id."','1',now())";
    }else{
        $sql="Update b_vendor "
                ."Set vend_code = '".$vend_code."' "
                .", vend_name_t = '".$vend_name_t."' "
                .", vend_address_t = '".$vend_address_t."' "
                .", tele = '".$tele."' "
                .", email = '".$email."' "
                .", tax_id = '".$tax_id."' "
                .", prov_id = '".$prov_id."' "
                .", amphur_id = '".$amphur_id."' "
                .", district_id = '".$district_id."' "
                .", zipcode = '".$zipcode."' "
                .", date_modi = now() "
                ."Where vend_id = '".$vend_id."'";
    }
}else if($_GET["flagPage"] === "goodsType"){
    $goods_type_id=$_GET["goods_type_id"];

    $goods_type_name=$_GET["goods_type_name"];

    if(($_GET["goods_type_id"]==="-")|| ($_GET["goods_type_id"]==="")){
        $sql="Insert Into b_goods_type(goods_type_id, goods_type_name, active, date_create) "
                ."Values(UUID(),'".$goods_type_name."','1',now())";
    }else{
        $sql="Update b_goods_type "
                ."Set  "
                ." goods_type_name = '".$goods_type_name."' "                
                .", date_modi = now() "
                ."Where goods_type_id = '".$goods_type_id."'";
    }
}else if($_GET["flagPage"] === "goodsCatagory"){
    $goods_cat_id=$_GET["goods_cat_id"];
    $goods_cat_name=$_GET["goods_cat_name"];
    if(($_GET["goods_cat_id"]==="-")|| ($_GET["goods_cat_id"]==="")){
        $sql="Insert Into b_goods_catagory(goods_cat_id, goods_cat_name, active, date_create) "
                ."Values(UUID(),'".$goods_cat_name."','1',now())";
    }else{
        $sql="Update b_goods_catagory "
                ."Set  "
                ." goods_cat_name = '".$goods_cat_name."' "                
                .", date_modi = now() "
                ."Where goods_cat_id = '".$goods_cat_id."'";
    }
}else if($_GET["flagPage"] === "unit"){
    $unit_id=$_GET["unit_id"];
    $unit_name=$_GET["unit_name"];
    if(($_GET["unit_id"]==="-")|| ($_GET["unit_id"]==="")){
        $sql="Insert Into b_unit(unit_id, unit_name, active, date_create) "
                ."Values(UUID(),'".$unit_name."','1',now())";
    }else{
        $sql="Update b_unit "
                ."Set  "
                ." unit_name = '".$unit_name."' "                
                .", date_modi = now() "
                ."Where unit_id = '".$unit_id."'";
    }
}else if($_GET["flagPage"] === "goods"){
    $goods_id=$_GET["goods_id"];
    $goods_name=$_GET["goods_name"];
    $goods_name_ex=$_GET["goods_name_ex"];
    $goods_code=$_GET["goods_code"];
    $goods_type_id= $_GET["goods_type_id"];
    $goods_cat_id= $_GET["goods_cat_id"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $holes=$_GET["holes"];
    $side=$_GET["side"];
    $dia_meter=$_GET["dia_meter"];
    $length=$_GET["length"];
    $unit_id=$_GET["unit_id"];
    if(($_GET["goods_id"]==="-")|| ($_GET["goods_id"]==="")){
        $sql="Insert Into b_goods(goods_id, goods_code, goods_name, goods_name_ex, "
                ."price, cost, holes, side, dia_meter, length, unit_id, goods_type_id, goods_cat_id, active, date_create) "
                ."Values(UUID(),'".$goods_code."','".$goods_name."','".$goods_name_ex."','"
                .$price."','".$cost."','".$holes."','".$side."','".$dia_meter."','".$length."','".$unit_id."','".$goods_type_id."','".$goods_cat_id."','1',now())";
    }else{
        $sql="Update b_goods "
                ."Set  "
                ." goods_code = '".$goods_code."' "
                .", goods_name = '".$goods_name."' "
                .", goods_name_ex = '".$goods_name_ex."' "
                .", goods_type_id = '".$goods_type_id."' "
                .", goods_cat_id = '".$goods_cat_id."' "
                .", price = '".$price."' "
                .", cost = '".$cost."' "
                .", holes = '".$holes."' "
                .", side = '".$side."' "
                .", dia_meter = '".$dia_meter."' "
                .", length = '".$length."' "
                .", unit_id = '".$unit_id."' "
                .", date_modi = now() "
                ."Where goods_id = '".$goods_id."'";
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