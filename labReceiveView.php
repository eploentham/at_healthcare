<?php
session_start();
require_once("inc/init.php");
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="company.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
if(!$conn){
    echo mysqli_error($conn);
    echo "<script>alert(".mysql_error().");</script>";
    return;
}
mysqli_set_charset($conn, "UTF8");
$trCust="";
$brname="";
$monthName="";
$period="";
$sql="Select count(1) as cnt, branch_id, year_id, month_id, period_id  From lab_t_data Where active = '1' Group By branch_id, year_id, month_id, period_id ";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        if($row["branch_id"]==="1"){
            $brname="บางนา 1";
        }else if($row["branch_id"]==="2"){
            $brname="บางนา 2";
        }else if($row["branch_id"]==="5"){
            $brname="บางนา 5";
        }
        if($row["month_id"]==="1"){
            $monthName="มกราคม";
        }else if($row["month_id"]==="2"){
            $monthName="กุมภาพันธ์";
        }else if($row["month_id"]==="3"){
            $monthName="มีนาคม";
        }else if($row["month_id"]==="4"){
            $monthName="เมษายน";
        }else if($row["month_id"]==="5"){
            $monthName="พฤษภาคม";
        }else if($row["month_id"]==="6"){
            $monthName="มิถุนายน";
        }else if($row["month_id"]==="7"){
            $monthName="กรกฎาคม";
        }else if($row["month_id"]==="8"){
            $monthName="สิงหาคม";
        }else if($row["month_id"]==="9"){
            $monthName="กันยายน";
        }else if($row["month_id"]==="10"){
            $monthName="ตุลาคม";
        }else if($row["month_id"]==="11"){
            $monthName="พฤศจิกายน";
        }else if($row["month_id"]==="12"){
            $monthName="ธันวาคม";
        }
        if($row["period_id"]==="1"){
            $period="งวดต้นเดือน";
        }else if($row["period_id"]==="2"){
            $period="งวดสิ้นเดือน";
        }
        $aa = "สาขา ".$brname." ปี ".$row["year_id"]." เดือน ".$monthName." ".$period." จำนวนข้อมูล ".$row["cnt"];
        $brName="<a href='#labReceiveDetail.php?branch_id=".$row["branch_id"]."'&year_id=".$row["year_id"]."'&month_id=".$row["month_id"]."'&period_id=".$row["period_id"].">".$aa."</a>";
        $trCust .= "<tr><td>".$brName."</td></tr>";
    }
}

$result->free();
mysqli_close($conn);
?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-pencil-square-o fa-fw "></i> 
                Forms
            <span>
                Dropzone
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> My Income <span class="txt-color-blue">$47,171</span></h5>
                <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                        1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                </div>
            </li>
            <li class="sparks-info">
                <h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
                <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                        110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
            <li class="sparks-info">
                <h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
                <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                        110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
        </ul>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
            <article class="col-sm-12">
                <!-- Widget ID (each widget will need unique ID)-->
                <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-0" data-widget-editbutton="false">
                    <header>
                        <span class="widget-icon"> <i class="fa fa-cloud"></i> </span>
                        <h2>My Dropzone! </h2>
                    </header>

                    <!-- widget div-->
                    <div>
                        <!-- widget edit box -->
                        <div class="jarviswidget-editbox">
                                <!-- This area used as dropdown edit box -->
                        </div>
                        <!-- end widget edit box -->

                        <!-- widget content -->
                        <div class="widget-body">
                            <table id="dt_basic" class="table table-striped table-bordered table-hover responsive" width="100%">
                                <thead>
                                    <tr>
                                        <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สาขา</th>
                                        
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
                <!-- end widget -->
                <footer>
                    <button type="button" class="btn btn-primary" id="btnDataAdd">
                                เพิ่ม ข้อมูลใหม่
                    </button>
                </footer>
            </article>
		<!-- WIDGET END -->
            
	</div>

	<!-- end row -->

	<!-- row -->

	<div class="row">

		<style>
			.s2 {
				color: #D14;
			}

			.c1 {
				color: #998;
				font-style: italic;
			}

			.mi {
				color: #099;
			}
		</style>

	</div>

	<!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">

	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 */

	// PAGE RELATED SCRIPTS
	
	// pagefunction
	
	var pagefunction = function() {
		Dropzone.autoDiscover = false;
		$("#mydropzone").dropzone({
			url: "/file/post",
                        paramName: "file", // The name that will be used to transfer the file
			addRemoveLinks : true,
			maxFilesize: 3,
			dictDefaultMessage: '<span class="text-center"><span class="font-lg visible-xs-block visible-sm-block visible-lg-block"><span class="font-lg"><i class="fa fa-caret-right text-danger"></i> Drop files <span class="font-xs">to upload</span></span><span>&nbsp&nbsp<h4 class="display-inline"> (Or Click)</h4></span>',
			dictResponseError: 'Error uploading file!'
		});
		
	};
	
	// end pagefunction
	
	// run pagefunction on load
	
	loadScript("js/plugin/dropzone/dropzone.min.js", pagefunction);
        $("#btnDataAdd").click(showDataAdd);
        function showDataAdd(){
            //alert("aaaa");
            window.location.assign("#labReceiveAdd.php");
        }

</script>
