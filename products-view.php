<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="goodsView.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="goodsView.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$trCust="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select g.*, ifnull(gt.goods_type_name,'') as goods_type_name, ifnull(gc.goods_cat_name,'') as goods_cat_name "
        ."From b_goods g "
        ."Left Join b_goods_type gt On g.goods_type_id = gt.goods_type_id "
        ."Left Join b_goods_catagory gc On g.goods_cat_id = gc.goods_cat_id "
        ."Where g.active = '1'  Order By g.goods_code";
$result = mysqli_query($conn,$sql);
if($result){
    while($row = mysqli_fetch_array($result)){
        $brName="<a href='#goodsAdd.php?goodsId=".$row["goods_id"]."'>".$row["goods_name"]."</a>";
        //$trCust .= "<tr><td>".$row["goods_code"]."</td><td>".$row["goods_code_ex"]."</td><td>".$brName."</td><td>"
         //       .$row["goods_type_name"]."</td><td>".$row["goods_cat_name"]."</td><td>".$row["on_hand"]."</td><td>".$row["purchase_point"]."</td><td>".$row["purchase_period"]."</td></tr>";
    
        $trCust .= "<div class='col-sm-6 col-md-6 col-lg-4'>"                
            ."<div class='product-content product-wrap clearfix'>"
                ."<div class='row'>"
                            ."<div class='col-md-5 col-sm-12 col-xs-12'>"
                                ."<div class='product-image'> "
                                    ."<img src='uploads_goods_pic/".$row["path_pic"]."' alt='194x228' class='img-responsive'> "
                                    ."<span class='tag2 hot'>HOT</span> "
                                ."</div>"
                            ."</div>"
                            ."<div class='col-md-7 col-sm-12 col-xs-12'>"
                            ."<div class='product-deatil'>"
                                ."<h5 class='name'> "
                                        ."<a href='#'> ".$row["goods_code"]." ".$row["goods_name"]
                                        ."<span>ประเภทสินค้า ".$row["goods_type_name"]." ชนิดสินค้า ".$row["goods_cat_name"]."</span> </a>"
                                ."</h5>"
                                ."<p class='price-container'> <span>".$row["price"]."</span> </p>"
                                ."<span class='tag1'></span> "
                            ."</div>"
                            ."<div class='description'>  <p>".$row["remark"]."</p> </div>"
                        ."</div>"
                ."</div>"
            ."</div>"            
        ."</div>";
    }
}else{
    echo mysqli_error($conn);
}
$result->free();
mysqli_close($conn);
?>
<!-- row -->
<div class="row">
	
	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark">
			
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-home"></i> 
				E-commerce
			<span>>  
				Products View
			</span>
		</h1>
	</div>
	<!-- end col -->
	
	<!-- right side of the page with the sparkline graphs -->
	<!-- col -->
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8 text-right">
		
		<a href="javascript:void(0);" class="btn btn-default shop-btn">
			<i class="fa fa-3x fa-shopping-cart"></i>
			<span class="air air-top-right label-danger txt-color-white padding-5">10</span>
		</a>
		<a href="javascript:void(0);" class="btn btn-default">
			<i class="fa fa-3x fa-print"></i>
		</a>
		
	</div>
	<!-- end col -->
	
</div>
<!-- end row -->

<!--
	The ID "widget-grid" will start to initialize all widgets below 
	You do not need to use widgets if you dont want to. Simply remove 
	the <section></section> and you can use wells or panels instead 
	-->

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->

	<div class="row">

		<?php echo $trCust; ?>	
		
		<div class="col-sm-12 text-center">
			<a href="javascript:void(0);" class="btn btn-primary btn-lg">Load more <i class="fa fa-arrow-down"></i></a>
		</div>

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
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR you can load chain scripts by doing
	 * 
	 * loadScript(".../plugin.js", function(){
	 * 	 loadScript("../plugin.js", function(){
	 * 	   ...
	 *   })
	 * });
	 */
	
	// pagefunction
	
	var pagefunction = function() {
		// clears the variable if left blank
	};
	
	// end pagefunction

	// destroy generated instances 
	// pagedestroy is called automatically before loading a new page
	// only usable in AJAX version!

	var pagedestroy = function(){
		
		/*
		Example below:

		$("#calednar").fullCalendar( 'destroy' );
		if (debugState){
			root.console.log("✔ Calendar destroyed");
		} 

		For common instances, such as Jarviswidgets, Google maps, and Datatables, are automatically destroyed through the app.js loadURL mechanic

		*/
	}

	// end destroy
	
	// run pagefunction
	pagefunction();
	
</script>
