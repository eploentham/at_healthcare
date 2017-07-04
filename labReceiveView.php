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
    $_SESSION['at_page'] ="labReceiveView.php";
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
$price2=0;
$sparkline="";
$sql="Select branch_id, year_id, month_id, period_id,count(1) as cnt, sum(price2) as price2  From lab_t_data "
        ."Where active = '1' "
        ."Group By branch_id, year_id, month_id, period_id "
        ."Order By branch_id, year_id, month_id, period_id";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $price2 += $row["price2"];
        $sparkline .= $row["price2"].", ";
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
        $aa = "สาขา ".$brname." ปี ".$row["year_id"]." เดือน ".$monthName." ".$period." จำนวนข้อมูล ".number_format($row["cnt"], 0)." รวมราคา ".number_format($row["price2"], 2);
        $brName="<a href='#labReceiveDetail.php?branch_id=".$row["branch_id"]."&year_id=".$row["year_id"]."&month_id=".$row["month_id"]."&period_id=".$row["period_id"]."'>".$aa."</a>";
        $trCust .= "<tr><td>".$brName."</td></tr>";
    }
//    if(trim(substr($sparkline,-2))==="."){
//        $sparkline=substr($sparkline,0,-1);
//    }
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
                <?php //echo substr($sparkline,-2);?>
            </span>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> My Income <span class="txt-color-blue"><?php echo  number_format($price2, 2);?></span></h5>
                <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                        <?php echo $sparkline;?>
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
                <form action="" id="smart-form-register" class="smart-form">
                    <fieldset>
                        <div class="row">
                            <section class="col col-3">
                                <label class="label"> สาขา</label>
                                <label class="select">
                                <select name="cboBranch" id="cboBranch">
                                    <option value="1">บางนา1</option>
                                    <option value="2">บางนา2</option>
                                    <option value="5">บางนา5</option>
                                </select> <i></i> </label>
                            </section>
                            <section class="col col-3">
                                <label class="label">ประจำปี</label>
                                <label class="select" id="goType1">
                                    <select id="cboYear">
                                        <option value="2016">2016</option>
                                        <option value="2017">2017</option>
                                        <option value="2018">2018</option>
                                        <option value="2019">2019</option>
                                    </select> <i></i> </label>
                            </section>
                            <section class="col col-3 ">
                                <label class="label">-</label>
                                <button type="button" id="btnSearch" class="btn btn-labeled btn-primary btn-lg">
                                    ดึงข้อมูล
                                </button>
                            </section>
                        </div>
                    </fieldset>
                </form>                
                
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
                            <table id="datatable_tabletools" class="table table-striped table-bordered table-hover responsive" width="100%">
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
	/* BASIC ;*/
        var responsiveHelper_dt_basic = undefined;
        var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
                tablet : 1024,
                phone : 480
        };

        $('#dt_basic').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-12 hidden-xs'l>r>"+
                        "t"+
                        "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
                "autoWidth" : true,
                "preDrawCallback" : function() {
                        // Initialize the responsive datatables helper once.
                        if (!responsiveHelper_dt_basic) {
                                responsiveHelper_dt_basic = new ResponsiveDatatablesHelper($('#dt_basic'), breakpointDefinition);
                        }
                },
                "rowCallback" : function(nRow) {
                        responsiveHelper_dt_basic.createExpandIcon(nRow);
                },
                "drawCallback" : function(oSettings) {
                        responsiveHelper_dt_basic.respond();
                }
        });

        /* END BASIC */
	// run pagefunction on load
	/* TABLETOOLS */
        $('#datatable_tabletools').dataTable({

                // Tabletools options: 
                //   https://datatables.net/extensions/tabletools/button_options
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>"+
                                "t"+
                                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
        "oTableTools": {
                 "aButtons": [
             "copy",
             "csv",
             "xls",
                {
                    "sExtends": "pdf",
                    "sTitle": "SmartAdmin_PDF",
                    "sPdfMessage": "SmartAdmin PDF Export",
                    "sPdfSize": "letter"
                },
                {
                "sExtends": "print",
                "sMessage": "Generated by SmartAdmin <i>(press Esc to close)</i>"
                }
             ],
            "sSwfPath": "js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
        },
            "autoWidth" : true,
            "preDrawCallback" : function() {
                // Initialize the responsive datatables helper once.
                if (!responsiveHelper_datatable_tabletools) {
                    responsiveHelper_datatable_tabletools = new ResponsiveDatatablesHelper($('#datatable_tabletools'), breakpointDefinition);
                }
            },
            "rowCallback" : function(nRow) {
                responsiveHelper_datatable_tabletools.createExpandIcon(nRow);
            },
            "drawCallback" : function(oSettings) {
                responsiveHelper_datatable_tabletools.respond();
            }
        });

        /* END TABLETOOLS */
	loadScript("js/plugin/dropzone/dropzone.min.js", pagefunction);
        loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                    });
                });
            });
	});
        $("#btnDataAdd").click(showDataAdd);
        $("#btnSearch").click(submitForm);
        function showDataAdd(){
            //alert("aaaa");
            window.location.assign("#labReceiveAdd.php");
        }
        function submitForm(){
            $( "#smart-form-register" ).submit();
        }

</script>
