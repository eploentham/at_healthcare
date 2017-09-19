<?php
define('FPDF_FONTPATH','fonts/');
require_once("inc/init.php"); 
require_once('lib/fpdf.php');
//require_once('lib/fpdi.php');
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function NumberToString($number){
	$number=str_replace(array(',',' ',),'',$number);
	$digit=array('ศูนย์','หนึ่ง','สอง','สาม','สี่','ห้า','หก','เจ็ด','แปด','เก้า','สิบ');
	$num=array('สิบ','ร้อย','พัน','หมื่น','แสน','ล้าน');
	$number=number_format($number,2,'.','');
	$number = explode(".",$number);
	$c_num[0]=$len=strlen($number[0]);
	$c_num[1]=$len2=strlen($number[1]);
	$convert='';
	
	//คิดจำนวนเต็ม
	for($n=0;$n< $len;$n++){
		$c_num[0]--;
		$c_digit=substr($number[0],$n,1);
		$c_digit2=substr($number[0],$n+1,1);
		$cc=($c_num[0]-1)%6;
		if($cc==-1 && $c_digit==1 && $c_digit2>=0 && $len>1){ $convert.='เอ็ด';}else
		if($cc==0 && $c_digit==1){ $convert.=$num[$cc];}else
		if($cc==0 && $c_digit==2){ $convert.='ยี่';$convert.=$num[$cc];}else
		if($c_digit!=0){
			$convert.=$digit[$c_digit];
			$convert.=$num[$cc];
		}
	}
	$convert .= 'บาท';
	if(intval($number[1])==0){
	$convert .= 'ถ้วน';
	}
	//คิดจุดทศนิยม
	//var_dump($number);
	for($n=0;$n< $len2;$n++){
		$c_num[1]--;
		$c_digit=substr($number[1],$n,1);
		$c_digit2=substr($number[1],$n+1,1);
		$cc=($c_num[1]-1)%6;
		if($cc==-1 && $c_digit==1 && $c_digit2>=0 && $len2>1){ $convert.='เอ็ด';}else
		if($cc==0 && $c_digit==1){ $convert.=$num[$cc];}else
		if($cc==0 && $c_digit==2){ $convert.='ยี่';$convert.=$num[$cc];}else
		if($c_digit!=0){
			$convert.=$digit[$c_digit];
			$convert.=$num[$cc];
		}
	}
	if(intval($number[1])!=0){$convert .= 'สตางค์';}
	return $convert.='';
}
class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('img/atta.jpg',10,6,30);
        // Arial bold 15
        //$this->SetFont('Arial','B',15);
        $this->AddFont('angsa','','angsa.php');
	$this->SetFont('angsa','',20);
        // Move to the right
        $this->Cell(30);
        // Title
        $this->Cell(30,5,iconv( 'UTF-8','TIS-620','บริษัท เอทีทีเอ2016 จำกัด'),0,0,'L');
        $this->Ln(7);
        $this->SetFont('angsa','',16);
        $this->Cell(30);
        $this->Cell(60,5,iconv( 'UTF-8','TIS-620','หมู่บ้านโครงการทาวร์พลัส เทพารักษ์ หมู่4 ถ.เทพารักษ์'),0,0,'L');
        $this->Ln(7);
        $this->Cell(30);
        $this->Cell(60,5,iconv( 'UTF-8','TIS-620','ต.บางพลีใหญ่ อ.บางพลี จ.สมุทรปราการ 10540 โทร.0813518464 โทรสาร 02-1381175'),0,0,'L');
        $this->Ln();
        // Line break
        $this->Ln(5);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
}
//$pdf = new FPDF("P", "mm", 'A4');
//
//$pdf->SetTopMargin(0);
//$pdf->SetLeftMargin(1);
//$pdf->SetAutoPageBreak(TRUE, 0.1) ;
//
//$pdf->AddPage();
//$pdf->SetFont('Arial','B',16);
//$pdf->Cell(40,10,'Hello World!');
//$pdf->Cell(0,20,'สวัสดี ชาวไทยครีเอท',0,1,"C");
//$pdf->Output();


//$pdf->Cell(0,20,iconv( 'UTF-8','TIS-620','สวัสดี ชาวไทยครีเอท'),0,1,"C");


$brId="";
$yearId="";
$monthId="";
$periodId="";
$brname="";
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
if($brId==="1"){
    $brname="บางนา 1";
}else if($brId==="2"){
    $brname="บางนา 2";
}else if($brId==="5"){
    $brname="บางนา 5";
}
$cntHn=0;
$row=0;
$rowGroupPaid=0;
$cntPaid=0;
$sumPaid=0;
$sumDiscount=0;
$sumNetPrice=0;
$trPaid="";
$lineBreak = 40; 
$border="0";
$where="Where branch_id = '".$brId."' and year_id = '".$yearId
    ."' and month_id = '".$monthId."' and period_id = '".$periodId."' and active = '1' ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
//$sql="Select *  From lab_t_data "
//    .$where;
//if ($rComp=mysqli_query($conn,$sql)){
//    while($aRec = mysqli_fetch_array($rComp)){
//        
//    }
//}
//$sql="Select hn  From lab_t_data "
//    .$where
//    ."Group By hn";
//if ($rComp=mysqli_query($conn,$sql)){
//    while($aRec = mysqli_fetch_array($rComp)){
//        $cntHn++;
//    }
//}
$pageNum=0;
$aa=0;
$paidType="";
$paidTypeOld="";
$newPage="";
$cat = "ประจำ ปี ".$yearId." เดือน ".getMonthName($monthId)." ".getPeriodName($periodId)." โรงพยาบาล " .$brname;
$sql="Select lab_code, lab_name, count(1) as cnt, price2, price3, discount, netprice, paid_type_name From lab_t_data "
    .$where
    ."Group By lab_name Order By paid_type_name, lab_name";
if ($rComp=mysqli_query($conn,$sql)){
    $pdf=new PDF("P", "mm", 'A4');
    $pdf->SetAutoPageBreak(TRUE, 0.1) ;
    $pdf->AliasNbPages();
    $pdf->AddFont('angsa','','angsa.php');
    //$pdf->SetFont('angsa','',14);
    $pdf->SetFont('angsa','',16);
    $num_rows = mysqli_num_rows($rComp);
    $pageCnt=ceil($num_rows / $lineBreak);
    $total=0;
    while($aRec = mysqli_fetch_array($rComp)){
        $row++;
        
        $paidType = $aRec["paid_type_name"];
        if($paidType!=$paidTypeOld){
            $paidTypeOld = $paidType;
            $newPage = "new";
            $rowGroupPaid=0;
        }
        
        if(($row===1) || ($row % $lineBreak===0) || $newPage ==="new"){
            
            $newPage = "old";
            $pdf->AddPage();
            $pdf->SetFont('angsa','',16);
//            $pdf->AddFont('angsa','','angsa.php');
            $pdf->SetX(5);
            $pdf->Cell(0,0.6,iconv('UTF-8','TIS-620',"รายงานชันสูตรโรค ตามประเภท"),$border,0,"C");
            $pdf->Ln(5);
            $pdf->SetX(15);
            $pdf->Cell(10,0.6,iconv('UTF-8','TIS-620',$aRec["paid_type_name"]),$border,0,"C");
            $pdf->Cell(0,0.6,iconv('UTF-8','TIS-620',$cat),$border,0,"C");
            $pdf->Ln(10);
            $pdf->SetX(5);
            $pdf->Cell(10,0.6,iconv('UTF-8','TIS-620',"ลำดับ"),$border,0,"C");
            $pdf->SetX(15);
            $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',"รายการ"),$border,0,"C");
            $pdf->SetX(130);
            $pdf->Cell(10,0.6,iconv('UTF-8','TIS-620',"จำนวน"),$border,0,"C");
            $pdf->SetX(140);
            $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',"ราคา/หน่วย"),$border,0,"C");
            $pdf->SetX(160);
            $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',"ราคาสุทธิ"),$border,0,"C");
            $pdf->SetX(180);
            $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',"รวมราคา"),$border,0,"C");
            $pdf->Ln(7);
            $pdf->SetFont('angsa','',14);
        }
        $rowGroupPaid++;
        $total = $aRec["netprice"] * $aRec["cnt"];
        $pdf->SetX(5);
        $pdf->Cell(10,0.6,iconv('UTF-8','TIS-620',$rowGroupPaid),$border,0,"C");
        $pdf->SetX(15);
        $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',$aRec["lab_name"]."[".$aRec["lab_code"]."]"),$border,0,"L");
        $pdf->SetX(130);
        $pdf->Cell(10,0.6,iconv('UTF-8','TIS-620',number_format($aRec["cnt"])),$border,0,"R");
        $pdf->SetX(140);
        $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',number_format($aRec["price3"],2,'.',',')),$border,0,"R");
        $pdf->SetX(160);
        $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',number_format($aRec["netprice"],2,'.',',')),$border,0,"R");
        $pdf->SetX(180);
        $pdf->Cell(20,0.6,iconv('UTF-8','TIS-620',number_format($total,2,'.',',')),$border,0,"R");
        $pdf->Ln(6);
        
        $cntPaid+=$aRec["cnt"];
        $sumPaid+=$aRec["price3"];
        $sumDiscount+=$aRec["discount"];
        $sumNetPrice+=$aRec["netprice"];
        if($row==$num_rows){
            $pdf->SetX(130);
            $pdf->Cell(10,0.6,number_format($cntPaid),$border,0,"R");
            $pdf->SetX(180);
            $pdf->Cell(20,0.6,number_format($sumNetPrice,2,'.',','),$border,0,"R");
        }
    }
    //$trPaid.="<tr><td></td><td>รวม</td><td class='cnt' align='right'>".number_format($cntPaid)."</td><td class='price' align='right'>".number_format($sumPaid,2,'.',',')."</td><td class='price' align='right'>".number_format($sumDiscount,2,'.',',')."</td><td class='price' align='right'>".number_format($sumNetPrice,2,'.',',')."</td></tr>";
    $pdf->Output("MyPDF.pdf","F");
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
                    <tr><td><img src="img/atta.jpg" alt="me" ></td>
                        <td><table><tr><td class="tdTimes">บริษัท เพาเวอร์ไดแอกนอสติค ลาโบราทอรี่ จำกัด </td></tr><tr><td class="tdTimes1">79 ม.8 ต.บางครุ อ.พระประแดง จ สมุทรปราการ 10130 โทร.0813518464 โทรสาร 02-1381175</td></tr></table></td>
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