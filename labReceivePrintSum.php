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
$sumDiscount=0;
$sumNetPrice=0;
$trPaid="";
$compName="";
$compAddr="";
$compImg="";
$paidType="";
if((intval($yearId)<=2017) && (intval($monthId) <7)){
    $compName = "บริษัท เพาเวอร์ไดแอกนอสติค ลาโบราทอรี่ จํากัด";
    $compAddr="79 ม.8 ต.บางครุ อ.พระประแดง จ สมุทรปราการ 10130 โทร.081-3518464 โทรสาร 02-1381175";
    $compImg="img/powerlab.jpg";
}else{
    $compName = "บริษัท เอทีทีเอ2016 จำกัด ";
    $compAddr="หมู่บ้านโครงการทาวร์พลัส เทพารักษ์ หมู่4 ถ.เทพารักษ์ ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540 โทร.0813518464 โทรสาร 02-1381175";
    $compImg="img/atta.jpg";
}
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
        $paidType = $aRec["paid_type_name"];
        if($brId==="2"){
            if($paidType==="@"){
                $paidType="ทั่วไป";
            }else if($paidType==="#"){
                $paidType="ประกันสังคม";
            }            
        }
        $trPaid.="<tr><td>".$row."</td><td>".$paidType."</td><td class='cnt' align='right'>".number_format($aRec["cnt"])."</td><td class='price' align='right'>".number_format($aRec["price3"],2,'.',',')."</td><td class='price' align='right'>".number_format($aRec["discount"],2,'.',',')."</td><td class='price' align='right'>".number_format($aRec["netprice"],2,'.',',')."</td></tr>";
        $cntPaid+=$aRec["cnt"];
        $sumPaid+=$aRec["price3"];
        $sumDiscount+=$aRec["discount"];
        $sumNetPrice+=$aRec["netprice"];
    }
    $trPaid.="<tr><td></td><td>รวม</td><td class='cnt' align='right'>".number_format($cntPaid)."</td><td class='price' align='right'>".number_format($sumPaid,2,'.',',')."</td><td class='price' align='right'>".number_format($sumDiscount,2,'.',',')."</td><td class='price' align='right'>".number_format($sumNetPrice,2,'.',',')."</td></tr>";
}
$rComp->free();
mysqli_close($conn);



?>
<style type="text/css">
    @media print {
        @page {
          size: A4;
          margin: 5mm;
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
        .tdTimes {font-family: 'times new roman'; font-size-adjust: 1;}
        .tdTimes1 {font-family: 'times new roman'; font-size-adjust: 0.58;}
        
        #Header, #Footer { display: none !important; }
        #header, #Footer,#left-panel,#shortcut,#smart-fixed-header, #smart-fixed-navigation,#smart-fixed-ribbon,#smart-fixed-footer,#smart-fixed-container,#smart-rtl { display: none !important; }
        .footer,
        #non-printable { display: none !important; }
        .header,
        #non-printable { display: none !important; }
    }
    .cnt { margin: auto; align-content: flex-end; width: 10%; border: 0px solid #fff; padding: 10px;}
    .price { margin: auto; align-content: flex-end; width: 15%; border: 0px solid #fff; padding: 10px;}
    .header-print .topbar-v1 {
	background: #fff;
	border-top: solid 1px #f0f0f0;
	border-bottom: solid 1px #f0f0f0;
        margin: 0;
    }
    .l1{padding: 30px;}
    .l2{padding: 60px;}
</style>
<div class="container">
    <div class="row">
            <div class="col-lg-12">
                <table class="header-print topbar-v1">
                    <tr><td><img src="<?php echo $compImg;?>" alt="me" ></td>
                        <td><table><tr><td class="tdTimes"><?php echo $compName;?> </td></tr><tr><td class="tdTimes1"><?php echo $compAddr?></td></tr></table></td>
                    </tr>
                </table>
            </div>
    </div><br><br>
    <div class="row">
        <div class="col col-sm-12">
            <table id="dt_basic" class="table table-striped table-bordered table-hover responsive"  width="100%">
                <thead>
                    <tr><th colspan="6" align="center" class="padding-5"><h3>ใบวางบิล lab</h3></th></tr>
                    <tr><th colspan="6" align="center"><h4>ประจำ <?php echo getPeriodName($periodId);?> เดือน <?php echo getMonthName($monthId);?> ปี <?php echo $yearId;?> สาขา <?php echo getBranchName($brId);?></h4></th></tr>
                    <tr>
                        <th data-class="expand" width="40"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ลำดับ</th>
                        <th data-class="expand" width="45%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ประเภทการรับชำระ</th>
                        <th data-class="expand"  class='cnt' align='center'><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>จำนวน</th>
                        <th data-class="expand" width="15%" align='center'><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>รวมราคา</th>
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
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col col-sm-1 L1">
            ผู้วางบิล 
        </div>
        <div class="col col-sm-5 L2">
            _____________________________________________
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col col-sm-1 L1">
            วันที่   
        </div>
        <div class="col col-sm-5 L2">
            _____________________________________________
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col col-sm-1 L1">
            ผู้รับวางบิล   
        </div>
        <div class="col col-sm-5 L2">
            _____________________________________________
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
    <div class="row">
        <div class="col col-sm-1 L1">
            วันที่รับวางบิล   
        </div>
        <div class="col col-sm-5 L2">
            _____________________________________________
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        //window.print();
    });
</script>