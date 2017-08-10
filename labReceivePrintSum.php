<?php
require_once("inc/init.php"); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$brId="";
$yearId="";
$monthId="";
$periodId="";
$tr="";
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
$cntHn=0;
$cnt=0;
$cntPaid=0;
$sumPaid=0;
$trPaid="";
$where="Where branch_id = '".$brId."' and year_id = '".$yearId
    ."' and month_id = '".$monthId."' and period_id = '".$periodId."' ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select count(1) as cnt  From lab_t_data "
    .$where;
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $cnt = $aRec["cnt"];
    }
}
$sql="Select hn  From lab_t_data "
    .$where
    ."Group By hn";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $cntHn++;
    }
}
$sql="Select distinct paid_type_name, count(1) as cnt, sum(price2) as price2  From lab_t_data "
    .$where
    ."Group By paid_type_name";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $trPaid.="<tr><td>".$aRec["paid_type_name"]."</td><td>".$aRec["cnt"]."</td><td>".$aRec["price2"]."</td></tr>";
        $cntPaid+=$aRec["cnt"];
        $sumPaid+=$aRec["price2"];
    }
    $trPaid.="<tr><td>รวม</td><td>".$cntPaid."</td><td>".$sumPaid."</td></tr>";
}
$rComp->free();
mysqli_close($conn);



?>
<style type="text/css">
    @media print {
        @page {
          size: A4;
          margin: 0mm;
        }
        html, body {
          width: 1024px;
        }
        body {
          margin: 0 auto;
          background-color: #fff;
        }
        header{
            background-image: none;
        }
        .demo activate, .page-footer, .demo,.breadcrumb{
            display: none !important;
        }
        #Header, #Footer { display: none !important; }
        #header, #Footer,#left-panel,#shortcut,#smart-fixed-header, #smart-fixed-navigation,#smart-fixed-ribbon,#smart-fixed-footer,#smart-fixed-container,#smart-rtl { display: none !important; }
        .footer,
        #non-printable { display: none !important; }
        .header,
        #non-printable { display: none !important; }
    }
</style>

<table id="dt_basic" class="table table-striped table-bordered table-hover responsive" width="100%">
    <thead>
        <tr>
            <th data-class="expand" width="70%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สิทธิการรักษา</th>
            <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>จำนวน</th>
            <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>มูลค่า</th>
        </tr>
    </thead>
    <tbody>
        <?php echo $trPaid;?>
    </tbody>
</table>