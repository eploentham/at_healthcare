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
    $goods_code_ex=$_GET["goods_code_ex"];
    $goods_type_id= $_GET["goods_type_id"];
    $goods_cat_id= $_GET["goods_cat_id"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $holes=$_GET["holes"];
    $side=$_GET["side"];
    $dia_meter=$_GET["dia_meter"];
    $length=$_GET["length"];
    $unit_id=$_GET["unit_id"];
    $purchase_point=$_GET["purchase_point"];
    $purchase_period=$_GET["purchase_period"];
    if(($_GET["goods_id"]==="-")|| ($_GET["goods_id"]==="")){
        $sql="Insert Into b_goods(goods_id, goods_code, goods_name, goods_name_ex, "
                ."price, cost, holes, side, "
                ."dia_meter, length, unit_id, goods_type_id, "
                ."goods_cat_id, goods_code_ex, purchase_point, purchase_period, active, date_create) "
                ."Values(UUID(),'".$goods_code."','".$goods_name."','".$goods_name_ex."','"
                .$price."','".$cost."','".$holes."','".$side."','"
                .$dia_meter."','".$length."','".$unit_id."','".$goods_type_id."','"
                .$goods_cat_id."','".$goods_code_ex."',".$purchase_point.",".$purchase_period.",'1',now())";
    }else{
        $sql="Update b_goods "
                ."Set  "
                ." goods_code = '".$goods_code."' "
                .", goods_code_ex = '".$goods_code_ex."' "
                .", goods_name = '".$goods_name."' "
                .", goods_name_ex = '".$goods_name_ex."' "
                .", goods_type_id = '".$goods_type_id."' "
                .", goods_cat_id = '".$goods_cat_id."' "
                .", price = ".$price." "
                .", cost = ".$cost." "
                .", holes = '".$holes."' "
                .", side = '".$side."' "
                .", dia_meter = '".$dia_meter."' "
                .", length = '".$length."' "
                .", unit_id = '".$unit_id."' "
                .", purchase_point = ".$purchase_point." "
                .", purchase_period = ".$purchase_period." "
                .", date_modi = now() "
                ."Where goods_id = '".$goods_id."'";
    }
}else if($_GET["flagPage"] === "goods_rec"){
    $rec_id=$_GET["rec_id"];
    $rec_doc=$_GET["rec_doc"];
    $inv_ex=$_GET["inv_ex"];
    $description=$_GET["description"];
    $rec_date=$_GET["rec_date"];
    $inv_ex_date=$_GET["inv_ex_date"];
    $comp_id=$_GET["comp_id"];
    $vend_id=$_GET["vend_id"];
    $branch_id=$_GET["branch_id"];
    $remark=$_GET["remark"];
    $flag_new=$_GET["flag_new"];
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
        $sql="Insert Into t_goods_rec(rec_id, rec_doc, inv_ex, description, "
                ."rec_date, inv_ex_date, comp_id, vend_id, "
                ."branch_id, remark, status_stock, active, date_create) "
                ."Values('".$rec_id."','".$rec_doc."','".$inv_ex."','".$description."','"
                .$rec_date."','".$inv_ex_date."','".$comp_id."','".$vend_id."','"
                .$branch_id."','".$remark."','0','1',now())";
    }else{
        $sql="Update t_goods_rec "
                ."Set  "
                ." rec_doc = '".$rec_doc."' "
                .", inv_ex = '".$inv_ex."' "
                .", description = '".$description."' "
                .", rec_date = '".$rec_date."' "
                .", inv_ex_date = '".$inv_ex_date."' "
                .", comp_id = '".$comp_id."' "
                .", vend_id = '".$vend_id."' "
                .", branch_id = '".$branch_id."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where rec_id = '".$rec_id."'";
    }
}else if($_GET["flagPage"] === "goods_rec_detail"){
    $rec_detail_id=$_GET["rec_detail_id"];
    $rec_id="";
    $rec_id=$_GET["rec_id"];
    $goods_id=$_GET["goods_id"];
    $qty=$_GET["qty"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $amt=$_GET["amt"];
    $unit_id=$_GET["unit_id"];
    if(($_GET["rec_detail_id"]==="-")|| ($_GET["rec_detail_id"]==="")){
        $sql="Insert Into t_goods_rec_detail(rec_detail_id, rec_id, goods_id, price, "
                ."cost, qty, amount, unit_id, "
                ."remark, status_stock, active, date_create) "
                ."Values(UUID(),'".$rec_id."','".$goods_id."','".$price."','"
                .$cost."','".$qty."','".$amt."','".$unit_id."','"
                .$remark."','0','1',now())";
//        $sql="Insert Into t_goods_rec_detail(rec_detail_id, active, date_create) "
//                ."Values(UUID(),'1',now())";
    }else{
        $sql="Update t_goods_rec_detail "
                ."Set  "
                ." rec_id = '".$rec_id."' "
                .", goods_id = '".$goods_id."' "
                .", price = '".$price."' "
                .", cost = '".$cost."' "
                .", qty = '".$qty."' "
                .", amount = '".$amount."' "
                .", unit_id = '".$unit_id."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where rec_detail_id = '".$rec_detail_id."'";
    }
}else if($_GET["flagPage"] === "rec_detail_void"){
    $rec_detail_id=$_GET["rec_detail_id"];
    $sql="Update t_goods_rec_detail "
                ."Set  "
                ." active = '3' "
                .", date_cancel = now() "
                ."Where rec_detail_id = '".$rec_detail_id."'";
}else if($_GET["flagPage"] === "aa"){
    $rec_id=$_GET["rec_id"];
    
}else if($_GET["flagPage"] === "goods_draw"){
    $draw_id=$_GET["draw_id"];
    $draw_doc=$_GET["draw_doc"];
    //$inv_ex=$_GET["inv_ex"];
    $description=$_GET["description"];
    $draw_date=$_GET["draw_date"];
    //$inv_ex_date=$_GET["inv_ex_date"];
    $comp_id=$_GET["comp_id"];
    //$vend_id=$_GET["vend_id"];
    $branch_id_draw=$_GET["branch_id_draw"];
    $branch_id_rec=$_GET["branch_id_rec"];
    $remark=$_GET["remark"];
    $flag_new=$_GET["flag_new"];
    if(($_GET["flag_new"]==="-")|| ($_GET["flag_new"]==="new")){
        $sql="Insert Into t_goods_draw(draw_id, draw_doc, description, "
                ."draw_date, comp_id, branch_id_draw, "
                ."branch_id_rec, remark, status_stock, active, date_create) "
                ."Values('".$draw_id."','".$draw_doc."','".$description."','"
                .$draw_date."','".$comp_id."','".$branch_id_draw."','"
                .$branch_id."','".$remark."','0','1',now())";
    }else{
        $sql="Update t_goods_draw "
                ."Set  "
                ." rec_doc = '".$draw_doc."' "
                //.", inv_ex = '".$inv_ex."' "
                .", description = '".$description."' "
                .", draw_date = '".$draw_date."' "
                //.", inv_ex_date = '".$inv_ex_date."' "
                .", comp_id = '".$comp_id."' "
                .", branch_id_draw = '".$branch_id_draw."' "
                .", branch_id_rec = '".$branch_id_rec."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where draw_id = '".$draw_id."'";
    }
}else if($_GET["flagPage"] === "goods_draw_detail"){
    $draw_detail_id=$_GET["draw_detail_id"];
    $draw_id="";
    $draw_id=$_GET["draw_id"];
    $goods_id=$_GET["goods_id"];
    $qty=$_GET["qty"];
    $price=$_GET["price"];
    $cost=$_GET["cost"];
    $amt=$_GET["amt"];
    $unit_id=$_GET["unit_id"];
    if(($_GET["draw_detail_id"]==="-")|| ($_GET["draw_detail_id"]==="")){
        $sql="Insert Into t_goods_draw_detail(draw_detail_id, draw_id, goods_id, price, "
                ."cost, qty, amount, unit_id, "
                ."remark, status_stock, active, date_create) "
                ."Values(UUID(),'".$draw_id."','".$goods_id."','".$price."','"
                .$cost."','".$qty."','".$amt."','".$unit_id."','"
                .$remark."','0','1',now())";
//        $sql="Insert Into t_goods_rec_detail(rec_detail_id, active, date_create) "
//                ."Values(UUID(),'1',now())";
    }else{
        $sql="Update t_goods_draw_detail "
                ."Set  "
                ." draw_id = '".$draw_id."' "
                .", goods_id = '".$goods_id."' "
                .", price = '".$price."' "
                .", cost = '".$cost."' "
                .", qty = '".$qty."' "
                .", amount = '".$amount."' "
                .", unit_id = '".$unit_id."' "
                .", remark = '".$remark."' "
                .", date_modi = now() "
                ."Where draw_detail_id = '".$draw_detail_id."'";
    }
}else if($_GET["flagPage"] === "draw_detail_void"){
    $draw_detail_id=$_GET["draw_detail_id"];
    $sql="Update t_goods_draw_detail "
                ."Set  "
                ." active = '3' "
                .", date_cancel = now() "
                ."Where draw_detail_id = '".$draw_detail_id."'";
}
$response = array();
$resultArray = array();
$err = "";

//$result = mysqli_query($conn,$sql);
header('Content-Type: application/json');
if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
    $response["success"] = 1;
    $response["message"] = "insert Order success";
    $response["error"] = $err;
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}else{
    $response["success"] = 0;
    $response["message"] = "insert Order success";
    $response["error"] = mysqli_error($conn);
    $response["sql"] = $sql;
    array_push($resultArray,$response);
    echo json_encode($resultArray);
}
//echo mysql_error();
mysqli_close($conn);
?>