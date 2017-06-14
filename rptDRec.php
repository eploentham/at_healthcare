<?php require_once("inc/init.php"); ?>

 <?php
 $tr="";
 ?>
<div class="row">
	
	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-home"></i> 
				Page Header 
			<span>>  
				Subtitle
			</span>
		</h1>
	</div>
	<!-- end col -->
	
	<!-- right side of the page with the sparkline graphs -->
	<!-- col -->
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<!-- sparks -->
		<ul id="sparks">
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
		<!-- end sparks -->
	</div>
	<!-- end col -->
	
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
        <div class="col col-3">
            <label class="label">&nbsp;&nbsp;</label>
            <button type="button" class="btn btn-primary btn-lg btn-success" id="btnReAdd">ค้นหา :</button>
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
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
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
                        <table id="datatable_fixed_column" class="table table-striped table-bordered" width="100%">
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
	    $("div.toolbar").html('<div class="text-right"><img src="img/logo.png" alt="SmartAdmin" style="width: 111px; margin-top: 3px; margin-right: 10px;"></div>');
	    	   
	    // Apply the filter
	    $("#datatable_fixed_column thead th input[type=text]").on( 'keyup change', function () {
	    	
	        otable
	            .column( $(this).parent().index()+':visible' )
	            .search( this.value )
	            .draw();
	            
	    } );
	    /* END COLUMN FILTER */   

	};

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


	
</script>
