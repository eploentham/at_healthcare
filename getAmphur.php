<?php
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
//$objConnect = mysql_connect("http://tossakan.com",'tossakan_payroll','payroll');
//$databaseName="at_healthcare";
//$userDB="root";
//$passDB="";
//$hostDB="localhost";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");

$resultArray = array();
if($_GET['flagPage']=="amphur"){
    $sql="Select * From amphures Where prov_id = '".$_GET['prov_id']."'  Order By amphur_code";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysql_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){        
                $tmp["amphur_id"] = $row["amphur_id"];
                $tmp["amphur_name"] = $row["amphur_name"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="district"){
    $sql="Select d.*, z.zipcode From districts d Left Join zipcodes z On d.district_code = z.district_code Where d.amphur_id = '".$_GET['amphur_id']."' Order By d.district_code";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){        
                $tmp["district_id"] = $row["district_id"];
                $tmp["district_name"] = $row["district_name"];
                $tmp["zipcode"] = $row["zipcode"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="zipcode"){
    $sql="Select z.zipcode From zipcodes z Left Join districts d On z.district_code = d.district_code Where district_id = '".$_GET['district_id']."' ";
    if ($result=mysqli_query($conn,$sql)){
        $ok="";
        $err="";
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                $tmp["zipcode"] = $row["zipcode"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="goSearch"){
    $sql="Select * From b_goods go Where goods_code = '".$_GET['goods_code']."' ";
    if ($result=mysqli_query($conn,$sql)){
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                $tmp["goods_name"] = $row["goods_name"];
                $tmp["goods_id"] = $row["goods_id"];
                $tmp["price"] = $row["price"];
                $tmp["unit_id"] = $row["unit_id"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }
}else if($_GET['flagPage']=="login"){
    //$sql="Select * From b_staff Where staff_username = '".$_GET['user_name']."' and active = '1' and staff_password = '".$_GET['password']."' ";
    $sql="Select * From b_staff  ";
    //$result = mysqli_query($con, $SQL)or die(mysqli_error($connection));
    //$result = mysqli_query($con,$Query) or die(mysqli_error());  
    if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
        if(!$result){
            $ok="0";
            $err= mysqli_error();
            $tmp = array();
            $tmp["error"] = $err;
            $tmp["sql"] = $sql;
            $tmp["success"] = $ok;
            array_push($resultArray,$tmp);
        }else{
            $ok="1";
            $tmp = array();
            $tmp["sql"] = $sql;
            $tmp["success"] = $ok;
            $num_rows = mysqli_num_rows($result);
            $tmp["rows"] = $num_rows;
            //$tmp["database"] = $databaseName;
            //$tmp["host"] = $hostDB;
            array_push($resultArray,$tmp);
            while($row = mysqli_fetch_array($result)){
                $tmp["staff_name_t"] = $row["staff_name_t"];
                $tmp["staff_lastname_t"] = $row["staff_lastname_t"];
                $_SESSION['at_user_staff_name'] = $tmp["staff_name_t"]."".$tmp["staff_lastname_t"];
                //$_SESSION['at_user'] = "";
                //$tmp["price"] = $row["price"];
                //$tmp["unit_id"] = $row["unit_id"];
                array_push($resultArray,$tmp);
            }
        }
        $result->free();
    }else{
        //echo($query.' '.mysqli_error()
    }
}

mysqli_close($conn);

header('Content-Type: application/json');
echo json_encode($resultArray);
?>