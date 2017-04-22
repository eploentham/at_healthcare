<?php
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="";
$rocId="";
if($_GET["flagPage"] === "gen_stock_rec"){
    $rec_id=$_GET["rec_id"];
    $sql="Select * From t_goods_rec_detail Where rec_id = '".$rec_id."' and active = '1' and status_stock = '0' " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $draDId = $row["rec_detail_id"];
            $goodsId = $row["goods_id"];
            $price = $row["price"];
            $qty = $row["qty"];
            if($qty===""){
                return;
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, price, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",".$price.",'".$draDId."','1','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_rec_detail Set status_stock = '1' Where rec_detail_id = '".$draDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand+".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
        $sql="Update t_goods_rec Set status_stock = '1' Where rec_id = '".$rec_id."'";
        mysqli_query($conn,$sql);
    }
    
}else if($_GET["flagPage"] === "gen_stock_draw"){
    $rec_id=$_GET["draw_id"];
    $sql="Select * From t_goods_draw_detail Where draw_id = '".$rec_id."' and active = '1' and status_stock = '0' " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $draDId = $row["draw_detail_id"];
            $goodsId = $row["goods_id"];
            $price = $row["price"];
            $qty = $row["qty"];
            if($qty===""){
                return;
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, price, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",".$price.",'".$draDId."','2','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_draw_detail Set status_stock = '1' Where draw_detail_id = '".$draDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand-".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
        $sql="Update t_goods_draw Set status_stock = '1' Where draw_id = '".$rec_id."'";
        mysqli_query($conn,$sql);
    }
}

$response = array();
$resultArray = array();
$err = "";


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