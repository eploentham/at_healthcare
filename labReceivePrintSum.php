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
$row=0;
$cntPaid=0;
$sumPaid=0;
$trPaid="";
$where="Where branch_id = '".$brId."' and year_id = '".$yearId
    ."' and month_id = '".$monthId."' and period_id = '".$periodId."' and active = '1' ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select *  From lab_t_data "
    .$where;
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        
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
$sql="Select distinct paid_type_name, count(1) as cnt, sum(price3) as price3, sum(discount) as discount, sum(netprice) as netprice From lab_t_data "
    .$where
    ."Group By paid_type_name";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $row++;
        $trPaid.="<tr><td>".$row."</td><td>".$aRec["paid_type_name"]."</td><td>".$aRec["cnt"]."</td><td>".$aRec["price3"]."</td><td>".$aRec["discount"]."</td><td>".$aRec["netprice"]."</td></tr>";
        $cntPaid+=$aRec["cnt"];
        $sumPaid+=$aRec["price3"];
    }
    $trPaid.="<tr><td></td><td>รวม</td><td>".$cntPaid."</td><td>".$sumPaid."</td><td></td><td></td></tr>";
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
    .header-print .topbar-v1 {
	background: #fff;
	border-top: solid 1px #f0f0f0;
	border-bottom: solid 1px #f0f0f0;
        margin: 0;
    }
</style>
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <table class="header-print topbar-v1">
                    <tr><td><img src="img/atta.jpg" alt="me" ></td>
                        <td><table><tr><td>บริษัท เพาเวอร์ไดแอกนอสติค ลาโบราทอรี่ จำกัด </td></tr><tr><td>79 ม.8 ต.บางครุ อ.พระประแดง จ สมุทรปราการ 10130 โทร.0813518464 โทรสาร 02-1381175</td></tr></table></td>
                    </tr>
                </table>
            </div>
    </div><br><br>
    <div class="row">
        <div class="col col-sm-12">
            <table id="dt_basic" class="table table-striped table-bordered table-hover responsive"  width="70%">
                <thead>
                    <tr><th colspan="6" align="center" class="padding-5">ใบวางบิล lab</th></tr>
                    <tr><th colspan="6" align="center">ประจำ งวดกลางเดือน เดือน มกราคม ปี 2559</th></tr>
                    <tr>
                        <th data-class="expand" width="40"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ลำดับ</th>
                        <th data-class="expand" width="45%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ประเภทการรับชำระ</th>
                        <th data-class="expand" width="10%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>จำนวน</th>
                        <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ราคา/หน่วย</th>
                        <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ส่วนลด</th>
                        <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ยอดสุทธิ</th>
                    </tr>
                </thead>
                <tbody>
                    <?php echo $trPaid;?>
                </tbody>
            </table>
        </div>
    </div>

</div>
