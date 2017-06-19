<?php 
session_start();
require_once("inc/init.php"); 

if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] = "rptDRec.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$tr="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$recDate1="";
$recDate2="";
if(!empty($_GET["reRecDate1"])){
    $recDate11=$_GET["reRecDate1"];
    $recDate1=substr($_GET["reRecDate1"],strlen($_GET["reRecDate1"])-4)."-".substr($_GET["reRecDate1"],3,2)."-".substr($_GET["reRecDate1"],0,2);
}
if(!empty($_GET["reRecDate2"])){
    $recDate21=$_GET["reRecDate2"];
    $recDate2=substr($_GET["reRecDate2"],strlen($_GET["reRecDate2"])-4)."-".substr($_GET["reRecDate2"],3,2)."-".substr($_GET["reRecDate2"],0,2);
}
$sql="Select rec.rec_doc, go.goods_code, go.goods_name, recd.qty, un.unit_name,rec.rec_date "
    ."From t_goods_rec_detail recd "
    ."Left Join t_goods_rec rec On recd.rec_id = rec.rec_id "
    ."Left Join b_goods go On recd.goods_id = go.goods_id "
    ."Left Join b_unit un On recd.unit_id = un.unit_id "
    ."Where rec.rec_date >= '".$recDate1."' and rec.rec_date <= '".$recDate2."' and rec.active='1' ";

if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
    //$tr="<tr><td>2</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
    while($row = mysqli_fetch_array($result)){
        $tr .= "<tr><td>".$row["rec_doc"]."</td><td>"
            .$row["rec_date"]."</td><td>"
            .$row["goods_code"]."</td><td>"
            .$row["goods_name"]."</td><td>"
            .$row["qty"]."</td><td>"
            .$row["unit_name"]."</td><td></td></tr>";
    }
}else{
    $tr="<tr><td>1</td><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>";
    echo mysqli_error($conn);
}
?>
<div class="row">
	
	
</div>
 <!-- widget grid -->
 <form action="" id="smart-form-register" class="smart-form" method="GET">
    <div class="row">
        <div class="col col-3">&nbsp;
            
        </div>
        <div class="col col-2">
            <label class="label">วันที่รับสินค้า</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="reRecDate1" id="reRecDate1" value="<?php echo $recDate11?>" placeholder="วันที่รับสินค้า" class="datepicker" data-date-format="dd/mm/yyyy">

        </div>
        <div class="col col-2">
            <label class="label">ถึงวันที่</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="reRecDate2" id="reRecDate2" value="<?php echo $recDate21?>" placeholder="ถึงวันที่" class="datepicker" data-date-format="dd/mm/yyyy">
        </div>
        <div class="col col-2">
            <label class="radio">
                    <input type="radio" name="radio" checked="checked">
                    <i></i>ประจำวัน</label>
            <label class="radio">
                    <input type="radio" name="radio">
                    <i></i>สรุป</label>
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

<div class="content"></div>
    

<section id="widget-grid" class="">
    
    
    
    <div class="row">
         <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            
            
             <!-- Widget ID (each widget will need unique ID)-->
             <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-1" data-widget-editbutton="false">
                
                 <header>
                    <span class="widget-icon"> <i class="fa fa-calendar"></i> </span>
                    <h2>Column Filters </h2>
                </header>
                 <!-- widget div-->
                 <div>
                     <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                            <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <table id="datatable_tabletools" class="table table-striped table-bordered" width="100%">
                            <thead>
                                
                                <tr>
                                <th data-class="expand">เลขที่เอกสาร</th>
                                <th >วันที่รับสินค้า</th>
                                <th data-hide="phone, tablet">รหัส</th>
                                <th data-hide="phone, tablet">ชื่อสินค้า</th>
                                <th data-hide="phone,tablet">จำนวน</th>
                                <th data-hide="phone,tablet">Unit</th>
                                <th>Status</th>
                                </tr>
                            </thead>
                            <?php echo $tr;?>
                            
                        </table>
                    </div>
                </div>
            </div>
        </article>
    </div>
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
