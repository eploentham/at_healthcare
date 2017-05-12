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
            $recDId = $row["rec_detail_id"];
            $goodsId = $row["goods_id"];
            $cost = $row["cost"];
            $qty = $row["qty"];
            if(!is_numeric($cost)){
                return;
            }
            if(!is_numeric($cost)){
                $cost="0";
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                ."Values(UUID(),'".$goodsId."',".$qty.",".$cost.",'".$recDId."','1','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_rec_detail Set status_stock = '1' Where rec_detail_id = '".$recDId."'";
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
            $cost = $row["cost"];
            $qty = $row["qty"];
            if(!is_numeric($qty)){
                return;
            }
            if(!is_numeric($cost)){
                $cost="0";
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                ."Values(UUID(),'".$goodsId."',".$qty.",".$cost.",'".$draDId."','2','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_draw_detail Set status_stock = '1' Where draw_detail_id = '".$draDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand-".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
        $sql="Update t_goods_draw Set status_stock = '1' Where draw_id = '".$rec_id."'";
        mysqli_query($conn,$sql);
    }
}else if($_GET["flagPage"] === "gen_stock_return"){
    $ret_id=$_GET["ret_id"];
    $sql="Select * From t_goods_return_detail Where return_id = '".$ret_id."' and active = '1' and status_stock = '0' " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $retDId = $row["return_detail_id"];
            $goodsId = $row["goods_id"];
//            $price = $row["price"];
            $qty = $row["qty"];
            if(!is_numeric($qty)){
                return;
            }
//            if($cost===""){
//                $cost="0";
//            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",0,'".$retDId."','3','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_return_detail Set status_stock = '1' Where rec_detail_id = '".$retDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand+".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
        $sql="Update t_goods_reurn Set status_stock = '1' Where return_id = '".$ret_id."'";
        mysqli_query($conn,$sql);
    }
}else if($_GET["flagPage"] === "void_stock_rec"){
    $rec_id=$_GET["rec_id"];
    $sql="Select * From t_goods_rec_detail Where rec_id = '".$rec_id."' and active = '1' and status_stock = '1' " ;
//    $sql="Select * From t_goods_rec_detail Where rec_id = '".$rec_id."' and active = '1'  " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $recDId = $row["rec_detail_id"];
            $goodsId = $row["goods_id"];
            $cost = $row["cost"];
            $qty = $row["qty"];
            if($qty===""){
                return;
            }
            if($cost===""){
                $cost="0";
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",".$cost.",'".$recDId."','4','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_rec_detail Set active = '3', date_cancel = now() Where rec_detail_id = '".$recDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand-".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
//        $sql="Update t_goods_rec Set status_stock = '1' Where rec_id = '".$rec_id."'";
//        mysqli_query($conn,$sql);
    }
}else if($_GET["flagPage"] === "void_stock_draw"){
    $draw_id=$_GET["draw_id"];
    $sql="Select * From t_goods_draw_detail Where draw_id = '".$draw_id."' and active = '1' and status_stock = '1' " ;
//    $sql="Select * From t_goods_draw_detail Where draw_id = '".$draw_id."' and active = '1'  " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $draDId = $row["draw_detail_id"];
            $goodsId = $row["goods_id"];
            $cost = $row["cost"];
            $qty = $row["qty"];
            if($qty===""){
                return;
            }
            if($cost===""){
                $cost="0";
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",".$cost.",'".$draDId."','5','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_draw_detail Set active = '3', date_cancel = now() Where draw_detail_id = '".$draDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand+".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
//        $sql="Update t_goods_rec Set status_stock = '1' Where rec_id = '".$rec_id."'";
//        mysqli_query($conn,$sql);
    }
    echo mysqli_error($conn);
}else if($_GET["flagPage"] === "void_stock_return"){
    $return_id=$_GET["return_id"];
    $sql="Select * From t_goods_return_detail Where return_id = '".$return_id."' and active = '1' and status_stock = '1' " ;
//    $sql="Select * From t_goods_draw_detail Where draw_id = '".$draw_id."' and active = '1'  " ;
    if ($result=mysqli_query($conn,$sql)){
        while($row = mysqli_fetch_array($result)){
            //$rocId = $row["rec_id"];
            $retDId = $row["return_detail_id"];
            $goodsId = $row["goods_id"];
            $cost = $row["cost"];
            $qty = $row["qty"];
            if($qty===""){
                return;
            }
            if($cost===""){
                $cost="0";
            }
            $sql="Insert Into t_stock(stock_id, goods_id, qty, cost, rec_draw_detail_id, status_rec_draw, active, date_create) "
                    ."Values(UUID(),'".$goodsId."',".$qty.",".$cost.",'".$retDId."','6','1', now())";
            mysqli_query($conn,$sql);
            $sql="Update t_goods_return_detail Set active = '3', date_cancel = now() Where return_detail_id = '".$retDId."'";
            mysqli_query($conn,$sql);
            $sql="Update b_goods Set on_hand = on_hand-".$qty." Where goods_id = '".$goodsId."'";
            mysqli_query($conn,$sql);
        }
//        $sql="Update t_goods_rec Set status_stock = '1' Where rec_id = '".$rec_id."'";
//        mysqli_query($conn,$sql);
    }
}

$response = array();
$resultArray = array();
$err = "";


header('Content-Type: application/json');
if(!$result){
    $response["success"] = 0;
    $response["message"] = "insert Order success";
    $response["error"] = mysqli_error($conn);
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