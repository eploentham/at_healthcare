<?php require_once("inc/init.php"); ?>
<?php
//echo $userDB;
$goodsId="-";
$goCode="";
$oUnit="";
$oCat="";
$oType="";
if(isset($_GET["goodsId"])){
    $goodsId = $_GET["goodsId"];
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_goods Where goods_id = '".$goodsId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    $aGoods = mysqli_fetch_array($rComp);
    $goId = $aGoods["goods_id"];
    $goCode = strval($aGoods["goods_code"]);
    $goCodeEx = strval($aGoods["goods_code_ex"]);
    $goName = strval($aGoods["goods_name"]);
    $goNameEx = strval($aGoods["goods_name_ex"]);
    $goCost = strval($aGoods["cost"]);
    $goPrice = strval($aGoods["price"]);
    $goTypeId = strval($aGoods["goods_type_id"]);
    $goCatId = strval($aGoods["goods_cat_id"]);
    $goUnit = strval($aGoods["unit_id"]);
}else{
    $goId = $goodsId;
}
$sql="Select * From b_goods_type Order By goods_type_name";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    //$oType = "<option value='0' selected='' disabled=''>เลือกจังหวัด</option>";
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
    //$oType = "<option value='0' selected='' disabled=''>เลือกจังหวัด</option>";
    while($row = mysqli_fetch_array($result)){
        if($goCatId===$row["goods_cat_id"]){
            $oCat .= '<option selected value='.$row["goods_cat_id"].'>'.$row["goods_cat_name"].'</option>';
        }else{
            $oCat .= '<option value='.$row["goods_cat_id"].'>'.$row["goods_cat_name"].'</option>';
        }
        
    }
}
$sql="Select * From b_unit Order By unit_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    //$oType = "<option value='0' selected='' disabled=''>เลือกจังหวัด</option>";
    while($row = mysqli_fetch_array($result)){
        if($goUnit===$row["unit_id"]){
            $oUnit .= '<option selected value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
        }else{
            $oUnit .= '<option value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
        }
        
    }
}
mysqli_close($conn);
?>
<div class="row">
	<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
		<h1 class="page-title txt-color-blueDark">			
			<!-- PAGE HEADER -->
			<i class="fa-fw fa fa-pencil-square-o"></i> 
				Forms
			<span>>  
				Form Layouts
			</span>
		</h1>
	</div>
	
	<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">		
		<!-- Button trigger modal -->
		<a href="ajax/modal-content/model-content-2.html" data-toggle="modal" data-target="#remoteModal" class="btn btn-success btn-lg pull-right header-btn hidden-mobile">
			<i class="fa fa-circle-arrow-up fa-lg"></i> 
			Launch form modal
		</a>
		
		<!-- MODAL PLACE HOLDER -->
		<div class="modal fade" id="remoteModal" tabindex="-1" role="dialog" aria-labelledby="remoteModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content"></div>
			</div>
		</div>
		<!-- END MODAL -->		
	</div>
</div>

<div class="alert alert-block alert-success">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p>
		You may also check the form validation by clicking on the form action button. Please try and see the results below!
	</p>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-6">
            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget" id="wid-id-4" data-widget-editbutton="false" data-widget-custombutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                    <h2>รายละเอียด สินค้า </h2>				
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
                        <form action="" id="smart-form-register" class="smart-form">                            
                            <fieldset>
                                <section>
                                    <label class="label">ประเภทสินค้า</label>
                                    <label class="select">
                                        <select name="goType" id="goType">
                                            <?php echo $oType;?>
                                        </select> <i></i> </label>
                                </section>
                                <section>
                                    <label class="label">ชนิดสินค้า</label>
                                    <label class="select">
                                        <select name="goCat" id="goCat">
                                            <?php echo $oCat;?>
                                        </select> <i></i> </label>
                                </section>
                                <section>
                                    <label class="label">ชื่อ สินค้า</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="goName" id="goName" value="<?php echo $goName;?>" placeholder="ชื่อ สินค้า">
                                        <input type="hidden" name="goId" id="goId" value="<?php echo $goId;?>">
                                        <input type="hidden" name="goCode" id="goCode" value="<?php echo $goCode;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section >
                                    <label class="label">ราคาซื้อ</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="ราคาซื้อ">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                <section >
                                    <label class="label">ราคาขาย</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goPrice" id="goPrice" value="<?php echo $goPrice;?>" placeholder="ราคาขาย">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                
                                <section >
                                    <label class="label">Holes</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="Holes">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                
                                <section >
                                    <label class="label">Side</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="Side">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >

                                <section >
                                    <label class="label">Diameter</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="Diameter">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >

                                <section >
                                    <label class="label">Length</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="Length">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                <section>
                                    <label class="label">Unit</label>
                                    <label class="select">
                                        <select name="caType" id="caType">
                                            <?php echo $oUnit;?>
                                        </select> <i></i> </label>
                                </section>
                                
                            </fieldset>
                            
                            <footer>
                                <button type="button" id="btnSave" class="btn btn-primary">
                                        บันทึกข้อมูล
                                </button>
                            </footer>
                        </form>						

                    </div>
                    <!-- end widget content -->
                </div>
                        <!-- end widget div -->
            </div>
            <!-- end widget -->				
        </article>
        <!-- END COL -->
    </div>
    <!-- END ROW -->
</section>
<!-- end widget grid -->

		
<!-- SCRIPTS ON PAGE EVENT -->
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
	
	
	// PAGE RELATED SCRIPTS

	// pagefunction
	
	var pagefunction = function() {
						
		var $registerForm = $("#smart-form-register").validate({

			// Rules for form validation
			rules : {
				compName : {
					required : true
				},
				email : {
					required : true,
					email : true
				},
				password : {
					required : true,
					minlength : 3,
					maxlength : 20
				},
				passwordConfirm : {
					required : true,
					minlength : 3,
					maxlength : 20,
					equalTo : '#password'
				},
				firstname : {
					required : true
				},
				lastname : {
					required : true
				},
				compType : {
					required : true
				},
				terms : {
					required : true
				}
			},

			// Messages for form validation
			messages : {
				login : {
					required : 'Please enter your login'
				},
				email : {
					required : 'Please enter your email address',
					email : 'Please enter a VALID email address'
				},
				password : {
					required : 'Please enter your password'
				},
				passwordConfirm : {
					required : 'Please enter your password one more time',
					equalTo : 'Please enter the same password as above'
				},
				firstname : {
					required : 'Please select your first name'
				},
				lastname : {
					required : 'Please select your last name'
				},
				compType : {
					required : 'Please select your gender'
				},
				terms : {
					required : 'You must agree with Terms and Conditions'
				}
			},

			// Do not change code below
			errorPlacement : function(error, element) {
				error.insertAfter(element.parent());
			}
		});
			
		// START AND FINISH DATE
		$('#startdate').datepicker({
			dateFormat : 'dd.mm.yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#finishdate').datepicker('option', 'minDate', selectedDate);
			}
		});
		
		$('#finishdate').datepicker({
			dateFormat : 'dd.mm.yy',
			prevText : '<i class="fa fa-chevron-left"></i>',
			nextText : '<i class="fa fa-chevron-right"></i>',
			onSelect : function(selectedDate) {
				$('#startdate').datepicker('option', 'maxDate', selectedDate);
			}
		});
		
	};
	
	// end pagefunction
	
	// Load form valisation dependency 
	loadScript("js/plugin/jquery-form/jquery-form.min.js", pagefunction);
        

        $("#btnSave").click(saveGoods);
        
        
        function saveGoods(){
            //alert('aaaaa');
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'vend_id': $("#veId").val()
                    ,'vend_code': $("#veCode").val()
                    ,'vend_name_t': $("#veNameT").val()
                    ,'vend_address_t': $("#veAddress").val()
                    ,'tele': $("#veTele").val()
                    ,'email': $("#veEmail").val()
                    ,'tax_id': $("#veTaxId").val()
                    ,'prov_id': $("#veProv").val()
                    ,'amphur_id': $("#veAmphur").val()
                    ,'district_id': $("#veDistrict").val()
                    ,'zipcode': $("#veZipcode").val()
                    ,'flagPage': "goods" }, 
                success: function (data) {
                    alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    for (var i in json_obj){
                        alert("aaaa "+json_obj[i].success);
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }

</script>
