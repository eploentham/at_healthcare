<?php 
session_start();
require_once("inc/init.php"); 

if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] = "rptDRec.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$tr="";
//$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
//mysqli_set_charset($conn, "UTF8");
//$sql="Select recd.* From t_goods_rec_detail recd Where active = '1' ";
//if ($result=mysqli_query($conn,$sql) or die(mysqli_error())){
//    while($row = mysqli_fetch_array($result)){
//        
//    }
//}else{
//    echo mysqli_error($conn);
//}
?>
<div class="row">
	
	
	
</div>
 <!-- widget grid -->
<form action="" id="smart-form-register" class="smart-form">
    <div class="row">
        <div class="col col-3">&nbsp;
            
        </div>
        <div class="col col-2">
            <label class="label">วันที่รับสินค้า</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="reRecDate" id="reRecDate1" value="" placeholder="วันที่รับสินค้า" class="datepicker" data-date-format="dd/mm/yyyy">

        </div>
        <div class="col col-2">
            <label class="label">ถึงวันที่</label>
            <label class="input"> <i class="icon-append fa fa-calendar"></i>
                <input type="text" name="reRecDate" id="reRecDate2" value="" placeholder="ถึงวันที่" class="datepicker" data-date-format="dd/mm/yyyy">
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
                                <th data-class="expand">Order ID</th>
                                <th >Cust ID / Phn</th>
                                <th data-hide="phone, tablet">Purchase</th>
                                <th data-hide="phone, tablet">Delivery</th>
                                <th data-hide="phone,tablet">Base Price</th>
                                <th data-hide="phone,tablet">Postal/Zip</th>
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
        $("#btnSearch").click(searchRecDaily);
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
        function searchRecDaily(){
            $("#loading").addClass("fa-spin");
            $("#uiLoading").show();
            //$("#btnSearch").addClass("fa-spin");
            
            
            
            
            
            $("#loading").removeClass("fa-spin");
            $("#uiLoading").hide();
        }


	
</script>
