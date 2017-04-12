<?php
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require 'config.php';
$con = mysqli_connect("localhost",'root','Ekartc2c5','manit');
mysqli_set_charset($con, "UTF8");
if (mysqli_connect_errno()) {
    printf("Connect failed: %s\n", mysqli_connect_error());
    exit();
}

if($_GET['flagPage']=="login"){
    //$objConnect = mysqli_connect("localhost",'root','Ekartc2c5','manit');
    /* check connection */
    
    $sql = "Select * From b_customer Where email = '".$_GET['loEmail']."' and password = '".$_GET['loPassword']."'";
    //echo $sql;
    //$result = mysqli_query($objConnect, $sql);
    if ($result=mysqli_query($con,$sql)){
        $obj = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);
        if($row>=1){
            
            
            $_SESSION["cust_code"] = $obj["cust_code"];
            $_SESSION["cust_name_t"] = $obj["cust_name_t"];
            $_SESSION["cust_lastname_t"] = $obj["cust_lastname_t"];
            $_SESSION["user_login"] = $obj["user_login"];
            $_SESSION["status_regis"] = $obj["status_regis"];
            echo "<br>สวัสดี ".$_SESSION["cust_name_t"]." ".$_SESSION["cust_lastname_t"];
            //session_write_close();
        }else{
            echo "no";
        }
        mysqli_free_result($result);
    }
}else if($_GET['flagPage']=="login_check_email"){
    //echo $_GET["loEmail"];
    $sql = "Select * From b_customer Where email = '".$_GET['loEmail']."' ";
    //echo $sql;
    //$result = mysqli_query($con, $sql);
    if ($result=mysqli_query($con,$sql)){
        $obj = mysqli_fetch_array($result);
        $row = mysqli_num_rows($result);
        if($row>=1){
            //echo "<br>สวัสดี ".$obj["user_login"];
            echo "ok<br>";
        }else{
            echo "ไม่พบ email address <br>";
        }
        mysqli_free_result($result);
    }
}
mysqli_close($con);