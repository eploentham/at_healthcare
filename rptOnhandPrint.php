<?php
require_once("inc/init.php"); 
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$trCust="";
$oCat="";
$oType="";
$goTypeId="";
$goCatId="";
$whereType="";
$whereCat="";
if(!empty($_GET["goType"])){
    $goTypeId=$_GET["goType"];
    $whereType = " and gt.goods_type_id = '".$goTypeId."'";
}
if(!empty($_GET["goCat"])){
    $goCatId=$_GET["goCat"];
    $whereCat = " and gc.goods_cat_id = '".$goCatId."'";
}



$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select g.*, ifnull(gt.goods_type_name,'') as goods_type_name, ifnull(gc.goods_cat_name,'') as goods_cat_name "
        ."From b_goods g "
        ."Left Join b_goods_type gt On g.goods_type_id = gt.goods_type_id "
        ."Left Join b_goods_catagory gc On g.goods_cat_id = gc.goods_cat_id "
        ."Where g.active = '1' and g.on_hand > 0 ".$whereType.$whereCat;
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $price =0;
        $qty=0;
        $price = $row["price"];
        $qty = $row["on_hand"];
        $amt = $price * $qty;
        $brName=$row["goods_name"];
//        $trCust .= "<tr><td>".$row["goods_code"]."</td><td>".$row["goods_code_ex"]."</td><td>".$brName."</td><td>"
//                .$row["goods_type_name"]."</td><td>".$row["goods_cat_name"]."</td><td>".$row["on_hand"]."</td><td>".$row["purchase_point"]."</td><td>".$row["purchase_period"]."</td></tr>";
        $trCust .= "<tr><td>".$row["goods_code"]."</td><td>".$brName."</td>"
                ."<td>".$row["on_hand"]."</td><td>".number_format($row["price"],2,".",",")."</td><td>".number_format($amt,2,".",",")."</td></tr>";
    }
}else{
    echo mysqli_error($conn);
}

$sql="Select * From b_goods_type Order By sort1, goods_type_name";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oType = "<option value='0' selected='' disabled=''>เลือก ประะเภทสินค้า</option>";
    while($row = mysqli_fetch_array($result)){
        if($goTypeId===$row["goods_type_id"]){
            $oType .= '<option selected value='.$row["goods_type_id"].'>'.$row["goods_type_name"].'</option>';
        }else{
            $oType .= '<option value='.$row["goods_type_id"].'>'.$row["goods_type_name"].'</option>';
        }
    }
}
$sql="Select * From b_goods_catagory Order By goods_cat_name";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oCat = "<option value='0' selected='' disabled=''>เลือก ชนิดสินค้า</option>";
    while($row = mysqli_fetch_array($result)){
        if($goCatId===$row["goods_cat_id"]){
            $oCat .= '<option selected value='.$row["goods_cat_id"].'>'.$row["goods_cat_name"].'</option>';
        }else{
            $oCat .= '<option value='.$row["goods_cat_id"].'>'.$row["goods_cat_name"].'</option>';
        }
    }
}

$result->free();
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
    .l1{padding: 10px;}
    .l2{padding: 10px;}
</style>
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                    <!-- Widget ID (each widget will need unique ID)-->
                    <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                        <!-- widget options:
                        usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

                        data-widget-colorbutton="false"
                        data-widget-editbutton="false"
                        data-widget-togglebutton="false"
                        data-widget-deletebutton="false"
                        data-widget-fullscreenbutton="false"
                        data-widget-custombutton="false"
                        data-widget-collapsed="true"
                        data-widget-sortable="false"

                        -->
                        <header>
                                <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                                <h2>รายงานสินค้าคงเหลือ </h2>

                        </header>

                        <!-- widget div-->
                        <div>
                            <!-- widget edit box -->
                            <div class="jarviswidget-editbox">
                                    <!-- This area used as dropdown edit box -->
                            </div>
                            <!-- end widget edit box -->
                            <!-- widget content -->
                            <div class="widget-body no-padding">
                                <table id="dt_basic" class="table table-striped table-bordered table-hover responsive" width="100%">
                                    <thead>
                                        <tr>
                                            <th ><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>รหัสสินค้า</th>                                            
                                            <th ><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อสินค้า</th>                                            
                                            <th ><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> คงเหลือ</th>
                                            <th ><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> ราคาต่อหน่วย</th>
                                            <th ><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> มูลค่า</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php echo $trCust;?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- end widget content -->
                        </div>
                        <!-- end widget div -->
                    </div>
			
		</article>
		<!-- WIDGET END -->
	</div>
	<!-- end row -->

	<!-- end row -->

</section>
<script type="text/javascript">
    $(document).ready(function() {
        //window.print();
    });
</script>