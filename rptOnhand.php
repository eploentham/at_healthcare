<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="goodsView.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
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
        $brName="<a href='#goodsAdd.php?goodsId=".$row["goods_id"]."'>".$row["goods_name"]."</a>";
        $trCust .= "<tr><td>".$row["goods_code"]."</td><td>".$row["goods_code_ex"]."</td><td>".$brName."</td><td>"
                .$row["goods_type_name"]."</td><td>".$row["goods_cat_name"]."</td><td>".$row["on_hand"]."</td><td>".$row["purchase_point"]."</td><td>".$row["purchase_period"]."</td></tr>";
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
<form action="" id="smart-form-register" class="smart-form" method="GET">
    <div class="row">
        <div class="col col-3">&nbsp;
            
        </div>
        <div class="col col-2">
            <label class="label">ประเภทสินค้า</label>
            <label class="select" id="goType1">
                <select name="goType" id="goType">
                    <?php echo $oType;?>
                </select> <i></i> </label>

        </div>
        <div class="col col-2">
            <label class="label">ชนิดสินค้า</label>
            <label class="select">
                <select name="goCat" id="goCat">
                    <?php echo $oCat;?>
                </select> <i></i> </label>
        </div>
       
        <div class="col col-2">
            <label class="label">&nbsp;&nbsp;</label>
            <button type="button" class="btn btn-primary btn-lg btn-primary" id="btnSearch">ค้นหา :</button>
            
        </div>
        <div class="col col-1">
            <label class="label">&nbsp;&nbsp;</label>
            <ul class="demo-btns">
                <li id="uiLoading">
                    <a href="javascript:void(0);" class="btn btn-sm bg-color-blueDark txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row">
        &nbsp;
    </div>
</form>

<!-- widget grid -->
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
                                <h2>Standard Data Tables </h2>

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
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>รหัสสินค้า</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> รหัสสินค้า ex</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> ชื่อสินค้า</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> ประเภทสินค้า</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> ชนิดสินค้า</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> onhand</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Pu Piont</th>
                                            <th data-class="expand"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i> Pu Period</th>
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
		//console.log("cleared");
		
		/* // DOM Position key index //
		
			l - Length changing (dropdown)
			f - Filtering input (search)
			t - The Table! (datatable)
			i - Information (records)
			p - Pagination (paging)
			r - pRocessing 
			< and > - div elements
			<"#id" and > - div with an id
			<"class" and > - div with a class
			<"#id.class" and > - div with an id and class
			
			Also see: http://legacy.datatables.net/usage/features
		*/	

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
		
		/* COLUMN FILTER  */
	    var otable = $('#datatable_fixed_column').DataTable({
	    	//"bFilter": false,
	    	//"bInfo": false,
	    	//"bLengthChange": false
	    	//"bAutoWidth": false,
	    	//"bPaginate": false,
	    	//"bStateSave": true // saves sort state using localStorage
			"sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6 hidden-xs'f><'col-sm-6 col-xs-12 hidden-xs'<'toolbar'>>r>"+
					"t"+
					"<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-xs-12 col-sm-6'p>>",
			"autoWidth" : true,
			"preDrawCallback" : function() {
				// Initialize the responsive datatables helper once.
				if (!responsiveHelper_datatable_fixed_column) {
					responsiveHelper_datatable_fixed_column = new ResponsiveDatatablesHelper($('#datatable_fixed_column'), breakpointDefinition);
				}
			},
			"rowCallback" : function(nRow) {
				responsiveHelper_datatable_fixed_column.createExpandIcon(nRow);
			},
			"drawCallback" : function(oSettings) {
				responsiveHelper_datatable_fixed_column.respond();
			}		
		
	    });
	    
	    // custom toolbar
	    //$("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    	   
	    // Apply the filter
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
	    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    } );
	    /* END COLUMN FILTER */   
            
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

	};
        $("#uiLoading").hide();
        $("#btnSearch").click(submitRecDaily);
        //$("#goCodeCopy").click(codeCopy);
	// load related plugins
	
	loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                    loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                        loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                    });
                });
            });
	});
        function submitRecDaily(){
            $( "#smart-form-register" ).submit();
        }
        function searchRecDaily(){
            $("#loading").addClass("fa-spin");
            $("#uiLoading").show();
            //$("#btnSearch").addClass("fa-spin");
            $.ajax({
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 
                    'rec_date1': $("#reRecDate1").val(),'rec_date2': $("#reRecDate2").val(), 'flagPage':"rpt_daily_rec_detail" }, 
                success: function (data) {
//                    alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        var newRow = "<tr><td>"+json_obj[i].rec_doc+"</td><td>"
                                +json_obj[i].rec_date+"</td><td>"
                                +json_obj[i].goods_code+"</td><td>"
                                +json_obj[i].goods_name+"</td><td>"
                                +json_obj[i].qty+"</td><td>"
                                +json_obj[i].unit_name+"</td><td></td></tr>";
                        $("#datatable_tabletools tbody").append(newRow);
//                        if(json_obj[i].goods_name!=null) {
//                            $("#reGoName").val(json_obj[i].goods_name1);
//                        }
//                        if(json_obj[i].price!=null) {
//                            $("#reGoPrice").val(json_obj[i].cost);
//                        }
//                        if(json_obj[i].goods_id!=null) {
//                            $("#reGoId").val(json_obj[i].goods_id);
//                        }
//                        if(json_obj[i].unit_id!=null) {
//                            //$("#reGoId").val(json_obj[i].unit_id);
//                            $('#reGoUnit').val(json_obj[i].unit_id);
//                        }
                    }
                }
            });
            
                        
            $("#loading").removeClass("fa-spin");
            $("#uiLoading").hide();
        }


	
</script>
