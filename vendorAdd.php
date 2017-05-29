<?php require_once("inc/init.php"); ?>
<?php
session_start();
if (!isset($_SESSION['at_user_staff_name'])) {
    //header("location: #login.php");
    $_SESSION['at_page'] ="vendorAdd.php";
    echo "<script>window.location.assign('#login.php');</script>";
}
$veId="";
$veCode="";
if(isset($_GET["vendId"])){
    $veId = $_GET["vendId"];
    $reFlagNew = "old";
    $backColor="style='background-color:white; '";
}else{
    $veId="";
    $reFlagNew = "new";
    $backColor="style='background-color:yellow; '";
}

$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_vendor Where vend_id = '".$veId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    $aVend = mysqli_fetch_array($rComp);
    $veId = $aVend["vend_id"];
    $veCode = strval($aVend["vend_code"]);
    $veNameT = strval($aVend["vend_name_t"]);
    $veAddress = strval($aVend["vend_address_t"]);
    $veTele = strval($aVend["tele"]);
    $veEmail = strval($aVend["email"]);
    $veTaxId = strval($aVend["tax_id"]);
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

<div class="alert alert-block alert-success" id="reAlert">
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
                    <h2>รายละเอียด Vendor </h2>				

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
                                    <label class="label">ประเภท Vendor</label>
                                    <label class="select">
                                        <select name="vendType" id="vendType">
                                            <?php echo $oComp;?>
                                        </select> <i></i> </label>
                                </section>
                                <section>
                                    <label class="label">ชื่อVendor</label>
                                    <label class="input"> <i class="icon-append fa fa-user"></i>
                                        <input type="text" name="veNameT" id="veNameT" value="<?php echo $veNameT;?>" placeholder="ชื่อVendor" <?php echo $backColor;?>>
                                        <input type="hidden" name="reFlagNew" id="reFlagNew" value="<?php echo $reFlagNew;?>">
                                        <input type="hidden" name="veId" id="veId" value="<?php echo $veId;?>">
                                        <input type="hidden" name="veCode" id="veCode" value="<?php echo $veCode;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                </section>

                                <section >
                                    <label class="label">ที่อยู่</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="veAddress" id="veAddress" value="<?php echo $veAddress;?>" placeholder="ที่อยู่ บ้านเลขที่ ซอย ถนน">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                <div class="row">
                                    <section  class="col col-6">
                                        <label class="label">ตำบล</label>
                                        <label class="select">
                                            <select name="veDistrict" id="veDistrict">
                                                <?php echo $oComp;?>
                                            </select> <i></i> </label>
                                    </section>

                                    <section  class="col col-6">
                                        <label class="label">อำเภอ</label>
                                        <label class="select">
                                            <select name="veAmphur" id="veAmphur">
                                                <?php echo $oComp;?>
                                            </select> <i></i> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section  class="col col-6">
                                        <label class="label">จังหวัด</label>
                                        <label class="select">
                                            <select name="veProv" id="veProv">
                                                <?php echo $oProv;?>
                                            </select> <i></i> </label>
                                    </section>

                                    <section class="col col-6">
                                        <label class="label">รหัสไปรษณีย์</label>
                                        <label class="input"> <i class="icon-append fa fa-lock"></i>
                                            <input type="text" name="veZipcode" id="veZipcode" placeholder="รหัสไปรษณีย์">
                                            <b class="tooltip tooltip-bottom-right">Don't forget your password</b> </label>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-6">
                                    <label class="label">โทรศัพท์</label>
                                    <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                        <input type="tel" name="veTele" id="veTele" placeholder="Phone" data-mask="(999) 999-9999" value="<?php echo $veTele;?>"></label>
                                </section>
                                <section  class="col col-6">
                                    <label class="label">Email</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                        <input type="email" name="veEmail" id="veEmail" placeholder="Email" value="<?php echo $veEmail;?>">
                                        <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                                </div>
                                <div class="row">
                                    <section class="col col-8">
                                        <label class="label">เลขที่ผู้เสียภาษี</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="veTaxId" id="veTaxId" placeholder="เลขที่ผู้เสียภาษี" value="<?php echo $veTaxId;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                    <section class="col col-2">    
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkReVoid" checked="true" id="chkReVoid"><i data-swchon-text="ใช้งาน" data-swchoff-text="ยกเลิก"></i>สถานะ</label>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnReVoid" class="btn btn-primary btn-sm">ต้องการยกเลิก</button>
                                    </section>
                                </div>
                            </fieldset>
                            
                            <footer>
                                <div class="row">
                                    <section class="col col-3 left">
                                        <button type="button" id="btnSave" class="btn btn-primary">
                                                บันทึกข้อมูล
                                        </button>
                                    </section>
                                    <section class="col col-6 right-inner">
                                        &nbsp;
                                    </section>
                                    <section class="col col-11 ">
                                        <ul class="demo-btns">
                                            <li>
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                </div>
                                
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
        $("#loading").removeClass("fa-spin");
        $("#reAlert").hide();
        hideBtnVoid();
        $("#veProv").change(getAmphur);
        $("#veAmphur").change(getDistrict);
        $("#veDistrict").change(getZipcode);
        $("#btnSave").click(saveVend);
        $("#chkReVoid").click(checkBtnVoid);
        $("#btnReVoid").click(voidVendor);
        function checkBtnVoid(){
            if($("#chkReVoid").is(':checked'))
                $("#btnReVoid").hide();  // checked
            else
                $("#btnReVoid").show();  // unchecked
//            $("#btnReVoid").show();
        }
        function hideBtnVoid(){
            $("#btnReVoid").hide();
        }
        function voidVendor(){
            //$("#veAmphur").empty();
            $.confirm({
                title: 'ต้องการยกเลิก Vendor!',
                content: 'ยกเลิก Vendor '+$("#veNameT").val(),
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 "+td.attr("id"));
                        voidVendor1();
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function voidVendor1(){
            //$.alert("hello222 "+$("#veId").val());
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', data: { 'vend_id': $("#veId").val(), 'flagPage':"void_vendor" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    
                    for (var i in json_obj)
                    {
//                        $.alert({
//                            title: 'Save Data',
//                            content: 'ยกเลิกข้อมูลเรียบร้อย',
//                        });
                        window.location.assign('#vendorView.php');
                    }
                    
                }
            });
        }
        function getAmphur(){
            //alert("aaaa");
            $("#veAmphur").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'prov_id': $("#veProv").val(), 'flagPage':"amphur" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
                    //alert('bbbbb '+json_obj.length);
                    toAppend = "<option value='0' selected='' disabled=''>เลือกอำเภอ</option>";
                    for (var i in json_obj)
                    {
                        if(json_obj[i].amphur_name==null) {
                            //alert('ddddd ');
                        }
                        toAppend += '<option value="'+json_obj[i].amphur_id+'">'+json_obj[i].amphur_name+'</option>';
                        //
                    }
                    $("#veAmphur").append(toAppend);
                    $("#veAmphur").selectpicker('refresh');
                }
            });
        }
        function getDistrict(){
            //alert("aaaa"+$("#cAmphur").val());
            $("#veDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'amphur_id': $("#veAmphur").val(), 'flagPage':"district" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
                    //alert('bbbbb '+json_obj.length);
                    toAppend = "<option value='0' selected='' disabled=''>เลือกตำบล</option>";
                    for (var i in json_obj)
                    {
                        if(json_obj[i].district_name==null) {
                            //alert('ddddd ');
                        }
                        toAppend += '<option value="'+json_obj[i].district_id+'">'+json_obj[i].district_name+'</option>';
                        //
                    }
                    $("#veDistrict").append(toAppend);
                    $("#veDistrict").selectpicker('refresh');
                }
            });
        }
        function getZipcode(){
            //alert("aaaa"+$("#cAmphur").val());
            //$("#cDistrict").empty();
            $.ajax({ 
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'district_id': $("#veDistrict").val(), 'flagPage':"zipcode" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        if(json_obj[i].zipcode!=null) {
                            $("#veZipcode").val(json_obj[i].zipcode);
                        }
                    }
                }
            });
        }
        function saveVend(){
            //alert('aaaaa');
            $("#loading").addClass("fa-spin");
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
                    ,'flag_new': $("#reFlagNew").val()
                    ,'flagPage': "vendor" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    for (var i in json_obj){
                        //alert("aaaa "+json_obj[i].success);
                        $.alert({
                            title: 'Save Data',
                            content: 'บันทึกข้อมูลเรียบร้อย',
                        });
                        $("#loading").removeClass("fa-spin");
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }

</script>
