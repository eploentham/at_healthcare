<?php require_once("inc/init.php"); ?>
<?php
//if (!isset($_SESSION['at_user_staff_name']) || empty($_SESSION['at_user_staff_name'])) {
//    //header("location: #login.php");
//    $_SESSION['at_page'] ="goodsAdd.php";
//    echo "<script>window.location.assign('#login.php');</script>";
//}
//echo $userDB;
//$goodsId="-";
$goCode="";
$oUnit="";
$oCat="";
$oType="";
$goTypeId="";
$goCatId="";
$goPup="";
$goPuPer="";
if(isset($_GET["goodsId"])){
    $goId = $_GET["goodsId"];
}else{
    $goId = "";
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_goods Where goods_id = '".$goId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    $aGoods = mysqli_fetch_array($rComp);
    $goId = $aGoods["goods_id"];
    $goCode = ($aGoods["goods_code"]);
    $goCodeEx = ($aGoods["goods_code_ex"]);
    $goName = ($aGoods["goods_name"]);
    $goNameEx = ($aGoods["goods_name_ex"]);
    $goCost = strval($aGoods["cost"]);
    $goPrice = strval($aGoods["price"]);
    $goSide = ($aGoods["side"]);
    $goHoles = ($aGoods["holes"]);
    $goDiameter = ($aGoods["dia_meter"]);
    $goLength = ($aGoods["length"]);
    $goUnit = ($aGoods["unit_id"]);
    $goTypeId = ($aGoods["goods_type_id"]);
    $goCatId = ($aGoods["goods_cat_id"]);
    $goPup = ($aGoods["purchase_point"]);
    $goPuPer = ($aGoods["purchase_period"]);
    if($goTypeId=="05233f7d-225b-11e7-b800-1c1b0d8ca1a0"){
        echo '<script type="text/javascript">alert("aaaaaaa");</script>';
    }else if($goTypeId=="2595c85d-225b-11e7-b800-1c1b0d8ca1a0"){
        echo '<script type="text/javascript">hideHole();</script>';
    }else{
        //echo '<script type="text/javascript">alert('.$goTypeId.');</script>';
    }
}else{
    $goId = $goodsId;
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
$sql="Select * From b_unit Order By unit_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oUnit = "<option value='0' selected='' disabled=''>เลือก หน่วย</option>";
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

<div class="alert alert-block alert-success" id="goAlert">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p id="goVali">
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
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">ประเภทสินค้า</label>
                                        <label class="select">
                                            <select name="goType" id="goType">
                                                <?php echo $oType;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">ชนิดสินค้า</label>
                                        <label class="select">
                                            <select name="goCat" id="goCat">
                                                <?php echo $oCat;?>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-5">
                                        <label class="label">code</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="goCode" id="goCode" value="<?php echo $goCode;?>" placeholder="code สินค้า">
                                            <input type="hidden" name="goId" id="goId" value="<?php echo $goId;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-1">
                                        <label class="label">.</label>
                                        <a class="btn btn-success pull-right  hidden-mobile" id="goCodeCopy">
                                            <i class="fa fa-circle-arrow-up fa-lg"></i><<<</a>
                                    </section>
                                    
                                    <section class="col col-6">
                                        <label class="label">code ex</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="goCodeEx" id="goCodeEx" value="<?php echo $goCodeEx;?>" placeholder="code ex สินค้า">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                </div>
                                
                                
                                
                                <section>
                                    <label class="label">ชื่อ สินค้า</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="goName" id="goName" value="<?php echo $goName;?>" placeholder="ชื่อ สินค้า">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>
                                <section>
                                    <label class="label">ชื่อ สินค้า ex</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="goNameEx" id="goNameEx" value="<?php echo $goNameEx;?>" placeholder="ชื่อ สินค้า ex">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>
                                <div class="row">
                                    <section  class="col col-6">
                                        <label class="label">ราคาซื้อ</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="number" name="goCost" id="goCost" value="<?php echo $goCost;?>" placeholder="ราคาซื้อ" data-bind="value:replyNumber">
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                    <section  class="col col-6">
                                        <label class="label">ราคาขาย</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="number" name="goPrice" id="goPrice" value="<?php echo $goPrice;?>" placeholder="ราคาขาย" data-bind="value:replyNumber">
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                
                                
                                <div class="row" id="divHole">
                                    <section  class="col col-6">
                                        <label class="label">Holes</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goHoles" id="goHoles" value="<?php echo $goHoles;?>" placeholder="Holes">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >

                                    <section  class="col col-6">
                                        <label class="label">Side</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goSide" id="goSide" value="<?php echo $goSide;?>" placeholder="Side">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                <div class="row" id="divDiameter">
                                    <section  class="col col-6">
                                        <label class="label">Diameter</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goDiameter" id="goDiameter" value="<?php echo $goDiameter;?>" placeholder="Diameter">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >

                                    <section  class="col col-6">
                                        <label class="label">Length</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="goLength" id="goLength" value="<?php echo $goLength;?>" placeholder="Length">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                
                                
                                
                                <div class="row">
                                    <section class="col col-4">
                                    <label class="label">Unit</label>
                                    <label class="select">
                                        <select name="goUnit" id="goUnit">
                                            <?php echo $oUnit;?>
                                        </select> <i></i> </label>
                                    </section>
                                    <section  class="col col-4">
                                        <label class="label">Purchase point</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="number" name="goPup" id="goPup" value="<?php echo $goPup;?>" placeholder="Purchase point" data-bind="value:replyNumber" onkeypress="return isNumberKey(event)">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                    <section  class="col col-4">
                                        <label class="label">Purchase Period</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="number" name="goPuPer" id="goPuPer" value="<?php echo $goPuPer;?>" placeholder="Purchase Period" data-bind="value:replyNumber" onkeypress="return isNumberKey(event)">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                
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
        $("#goAlert").hide();
        $("#goCodeCopy").click(codeCopy);
        $("#btnSave").click(saveGoods);
        $( ".select" ).change(function() {
            //var name = $('select[name="dept"]').val('3');
            if($('select[name="goType"]').val()=="05233f7d-225b-11e7-b800-1c1b0d8ca1a0"){
                //alert( "Handler for .change() called." );
                
            }
            //alert( "Handler for .change() called." );
        });
        function codeCopy(){
            $("#goCode").val($("#goCodeEx").val());
        }
        function showHole(){
//            $("#divHole").show();
//            $("#divDiameter").hide();
//            alert("aaa");
        }
        function hideHole(){
//            $("#divHole").hide();
//            $("#divDiameter").show();
        }
//        function hideDiameter(){
//            $("#divDiameter").hide();
//        }
//        function showDiameter(){
//            $("#divDiameter").show();
//        }
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        function saveGoods(){
            //alert('aaaaa');
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'goods_id': $("#goId").val()
                    ,'goods_code': $("#goCode").val()
                    ,'goods_code_ex': $("#goCodeEx").val()
                    ,'goods_name': $("#goName").val()
                    ,'goods_name_ex': $("#goNameEx").val()
                    ,'goods_type_id': $("#goType").val()
                    ,'goods_cat_id': $("#goCat").val()
                    ,'price': $("#goPrice").val()
                    ,'cost': $("#goCost").val()
                    ,'holes': $("#goHoles").val()
                    ,'side': $("#goSide").val()
                    ,'dia_meter': $("#goDiameter").val()
                    ,'length': $("#goLength").val()
                    ,'unit_id': $("#goUnit").val()
                    ,'purchase_point': $("#goPup").val()
                    ,'purchase_period': $("#goPuPer").val()
                    ,'flagPage': "goods" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    for (var i in json_obj){
                        //alert("aaaa "+json_obj[i].success);
                            $.alert({
                                title: 'Save Data',
                                content: 'บันทึกข้อมูลเรียบร้อย',
                            });
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }

</script>
