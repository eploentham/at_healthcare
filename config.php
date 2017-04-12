<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$passDb="";
$passDb="Ekartc2c5";
$ipaddress = '';
function get_client_ip() {
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    //echo $ipaddress;
    //$ipaddress = $_SERVER['REMOTE_ADDR'];
    return $ipaddress;
}
function setIPView(){
    $ipaddress = get_client_ip();
    //echo $ipaddress;
    $con = mysqli_connect("localhost",'root',$GLOBALS['passDb'],'manit');
    mysqli_set_charset($con, "UTF8");
    $obj = mysqli_query($con, "Insert Into oc_customer_ip (ip, date_added) Value('".$ipaddress."',now());");
    mysqli_close($con);
}
function carYear(){
    $con = mysqli_connect("localhost",'root','Ekartc2c5','manit');
    mysqli_set_charset($con, "UTF8");
    $sql = "Select year_code From car_year Where active = '1'";
    if ($result=mysqli_query($con,$sql)){
        $resultArray = array();
        $row = mysqli_num_rows($result);
        while($row = mysql_fetch_array($result)){
            $tmp = array();
            $tmp["car_year"] = $row["car_year"];
            array_push($resultArray,$tmp);
        }
    }
    mysqli_close($con);
    return json_encode($resultArray);
}
function divYear(){
    global $passDb;
    $year = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
            .'เลือกปีรถยนต์<span class="caret"></span></button>'        
            .'<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
    $year1="";
    $con = mysqli_connect("localhost",'root',$passDb,'manit');
    mysqli_set_charset($con, "UTF8");
    $sql = "Select year_code From car_year Where active = '1'";
    if ($result=mysqli_query($con,$sql)){
//        $resultArray = array();
//        $row = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)){
            $year1 = $year1.'<li id = "liYear"><a href="#">'.$row["year_code"].'</a></li>';
        }
    }
    mysqli_close($con);
    return $year.$year1."</ul></div>";
}
function divBrand(){
    $year = '<div class="dropdown"><button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">'
            .'เลือกยี่ห้อ<span class="caret"></span></button>'        
            .'<ul class="dropdown-menu" aria-labelledby="dropdownMenu1">';
    $year1="";
    //$con = mysqli_connect("localhost",'root',$GLOBALS['passDb'],'manit');
    $con = mysqli_connect("localhost",'root',"Ekartc2c5",'manit');
    mysqli_set_charset($con, "UTF8");
    $sql = "Select brand_name From car_brand Where active = '1'";
    if ($result=mysqli_query($con,$sql)){
//        $resultArray = array();
//        $row = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result)){
            $year1 = $year1.'<li id="liBrand"><a href="#">'.$row["brand_name"].'</a></li>';
        }
    }
    mysqli_close($con);
    return $year.$year1."</ul></div>";
}