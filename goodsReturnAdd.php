<?php require_once("inc/init.php"); ?>
<?php
//if (!isset($_SESSION['at_user_staff_name']) || empty($_SESSION['at_user_staff_name'])) {
//    //header("location: #login.php");
//    $_SESSION['at_page'] ="goodsRecAdd.php";
//    echo "<script>window.location.assign('#login.php');</script>";
//}
include 'UUID.php';
//echo $userDB;
$retRetId="-";
$retDraId="";
$retRetDoc="";
$retDesc="";
$retRetDate="";
$reInvExDate="";
$compId="";
$vendId="";
$branchId="";
$retRemark="";
$retFlagNew="";
$retStatusStock="";
$oCust="";
$retCustId="";
$oDrawDoc="";
if(isset($_GET["retId"])){
    $retRetId = $_GET["retId"];
    $retFlagNew = "old";
    //$retRetId="aa";
    $backColor="style='background-color:white; '";
}else{
    $retRetId = UUID::v4();
    $retFlagNew = "new";
    $backColor="style='background-color:yellow; '";
}

//$retRetId="aa";
$goodsId="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From t_goods_return Where return_id = '".$retRetId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    //$aRec = mysqli_fetch_array($rComp);
    while($aRec = mysqli_fetch_array($rComp)){
        $retRetId = $aRec["return_id"];
        $retRetDoc = ($aRec["return_doc"]);
        $retDraId = ($aRec["draw_id"]);
        $retDesc = ($aRec["description"]);
        $retRetDate = ($aRec["return_date"]);
        //$reInvExDate = ($aRec["inv_ex_date"]);
        $retRemark = ($aRec["remark"]);
        $retStatusStock = ($aRec["status_stock"]);

        $compId = ($aRec["comp_id"]);
        $retCustId = ($aRec["cust_id_return"]);
        $retRetDate = substr($retRetDate,strlen($retRetDate)-2)."-".substr($retRetDate,5,2)."-".substr($retRetDate,0,4);
        $branchId = ($aRec["branch_id"]);
    //    $goLength = strval($aRec["length"]);
    //    $goUnit = strval($aRec["unit_id"]);
    //    $goTypeId = strval($aRec["goods_type_id"]);
    //    $goCatId = strval($aRec["goods_cat_id"]);
    }
}else{
    $goId = $goodsId;
}
if($retFlagNew=="old"){
    $sql="Select * From t_goods_draw Where draw_id = '".$retDraId."' Order By draw_doc";
    if ($result=mysqli_query($conn,$sql)){
        $oDrawDoc = "<option value='0' selected='' disabled=''>เลือก เลขที่ เบิกสินค้า</option>";
        while($row = mysqli_fetch_array($result)){
            if($retDraId===$row["draw_id"]){
                $oDrawDoc .= '<option selected value='.$row["draw_id"].'>'.$row["draw_doc"].'</option>';
            }else{
                $oDrawDoc .= '<option value='.$row["draw_id"].'>'.$row["draw_doc"].'</option>';
            }
        }
    }
}

$sql="Select * From b_company Order By comp_name_t";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oComp1 = "<option value='0' selected='' disabled=''>เลือก บริษัท</option>";
    while($row = mysqli_fetch_array($result)){
        if($retFlagNew=="old"){
            if($compId===$row["comp_id"]){
                $oComp1 .= '<option selected value='.$row["comp_id"].'>'.$row["comp_name_t"].'</option>';
            }else{
                $oComp1 .= '<option value='.$row["comp_id"].'>'.$row["comp_name_t"].'</option>';
            }
        }else{
            if($row["status_default"]==="1"){
                $oComp1 .= '<option selected value='.$row["comp_id"].'>'.$row["comp_name_t"].'</option>';
            }else{
                $oComp1 .= '<option value='.$row["comp_id"].'>'.$row["comp_name_t"].'</option>';
            }
        }
        
    }
}
//$sql="Select * From b_vendor Order By vend_name_t";
////$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
//if ($result=mysqli_query($conn,$sql)){
//    $oVend = "<option value='0' selected='' disabled=''>เลือก Vendor</option>";
//    while($row = mysqli_fetch_array($result)){
//        if($vendId===$row["vend_id"]){
//            $oVend .= '<option selected value='.$row["vend_id"].'>'.$row["vend_name_t"].'</option>';
//        }else{
//            $oVend .= '<option value='.$row["vend_id"].'>'.$row["vend_name_t"].'</option>';
//        }
//        
//    }
//}
$sql="Select * From b_branch Order By branch_name";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oBranch = "<option value='0' selected='' disabled=''>เลือก สาขา</option>";
    while($row = mysqli_fetch_array($result)){
        if($branchId===$row["branch_id"]){
            $oBranch .= '<option selected value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }else{
            $oBranch .= '<option value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }
    }
}
$sql="Select * From b_customer Order By cust_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oCust = "<option value='0' selected='' disabled=''>เลือก ลูกค้า</option>";    
    while($row = mysqli_fetch_array($result)){
        if($retCustId===$row["cust_id"]){
            $oCust .= '<option selected value='.$row["cust_id"].'>'.$row["cust_name_t"].'</option>';
        }else{
            $oCust .= '<option value='.$row["cust_id"].'>'.$row["cust_name_t"].'</option>';
        }
    }
}
//$sql="Select * From b_unit Order By unit_code";
////$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
//if ($result=mysqli_query($conn,$sql)){
//    $oUnit = "<option value='0' selected='' disabled=''>เลือก หน่วย</option>";
//    while($row = mysqli_fetch_array($result)){
////        if($goUnit===$row["unit_id"]){
////            $oUnit .= '<option selected value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
////        }else{
//            $oUnit .= '<option value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
////        }
//        
//    }
//}

$tr1="<table id='trReDetail' class='table table-striped table-bordered table-hover' width='100%'><thead>"
        ."<tr><th data-class='expand'>รหัส</th>"
        ."<th data-class='expand'>ชื่อสินค้า</th>"
        ."<th data-class='expand'>qty</th>"
        ."<th>-</th></tr></thead><tbody>";
$sql="Select retd.*, g.goods_code, g.goods_name "
        ."From t_goods_return_detail retd "
        ."Left Join b_goods g on retd.goods_id = g.goods_id "
//        ."Left Join b_unit u on recd.unit_id = u.unit_id "
        ."Where return_id = '".$retRetId."' and retd.active = '1' ";
$reCnt=0;
if ($rDetail=mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_array($rDetail)){
        $reCnt++;
        $tr="<input type='hidden' id='reDID".$reCnt."' value='".$row["return_detail_id"]."'>";
        $tr1 .= "<tr id='tr".$reCnt."'><td >".$tr.$row["goods_code"]."</td><td>".$row["goods_name"]."</td><td>"
                .$row["qty"]."</td><td id='".$row["return_detail_id"]."'><button type='button' id='btndel".$reCnt."' class='deleteLink'>del</button></td></tr>";
    }
}else{
    
}
$result->free();
$rDetail->free();
$tr1 .= "</tbody></table>";
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

<div class="alert alert-block alert-success" id="retAlert">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p id="retVali">
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
                    <h2>รายการคืน สินค้า </h2>				
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
                                    <section class="col col-4">
                                        <label class="label">เลขที่เอกสาร</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="reRetDoc" id="reRetDoc" value="<?php echo $retRetDoc;?>" placeholder="เลขที่เอกสาร" <?php echo $backColor;?>>
                                            <input type="hidden" name="retRetId" id="retRetId" value="<?php echo $retRetId;?>">
                                            <input type="hidden" name="retFlagNew" id="retFlagNew" value="<?php echo $retFlagNew;?>">
                                            <input type="hidden" name="retStatusStock" id="retStatusStock" value="<?php echo $retStatusStock;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">วันที่คืนสินค้า</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="reRetDate" id="reRetDate" value="<?php echo $retRetDate;?>" placeholder="วันที่คืนสินค้า" class="datepicker" data-date-format="dd/mm/yyyy">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-2">    
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkRetVoid" checked="true" id="chkRetVoid"><i data-swchon-text="ใช้งาน" data-swchoff-text="ยกเลิก"></i>สถานะ</label>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnRetVoid" class="btn btn-primary btn-sm">ต้องการยกเลิก</button>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-5">
                                        <label class="label">เลขที่ เบิกสินค้า</label>
                                        <label class="select">
                                            <select name="retDraId" id="retDraId">
                                                <?php echo $oDrawDoc;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">วันที่เบิกสินค้า1</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="retDraDate1" id="retDraDate1" placeholder="วันที่เบิกสินค้า1" class="datepicker" data-date-format="dd/mm/yyyy">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">วันที่เบิกสินค้า2</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="retDraDate2" id="retDraDate2"  placeholder="วันที่เบิกสินค้า1" class="datepicker" data-date-format="dd/mm/yyyy">                                        
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-1">
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="retDrawSearch" class="btn btn-primary btn-sm">...</button>
                                    </section>
                                </div>
                                
                                <div class="row">
                                    <section class="col col-4">
                                            <label class="label">รับเข้าบริษัท</label>
                                            <label class="select">
                                                <select name="retComp" id="retComp">
                                                    <?php echo $oComp1;?>
                                                </select> <i></i> </label>
                                    </section>
                                    <section class="col col-4">
                                            <label class="label">รับเข้า สาขา</label>
                                            <label class="select">
                                            <select name="retBranch" id="retBranch">
                                                <?php echo $oBranch;?>
                                            </select> <i></i> </label>
                                    </section >
                                    <section  class="col col-4">
                                        <label class="label">ลูกค้า</label>
                                        <label class="select">
                                            <select name="retCust" id="retCust">
                                                <?php echo $oCust;?>
                                            </select> <i></i> </label>
                                    </section >
                                </div>
                                <div class="row">
                                    <section class="col col-6">
                                        <label class="label">รายละเอียด</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="reDesc" id="reDesc" value="<?php echo $retDesc;?>" placeholder="รายละเอียด">

                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">หมายเหตุ</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                                <input type="text" name="reRemark" id="reRemark" value="<?php echo $retRemark;?>" placeholder="หมายเหตุ">
                                                <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section >
                                </div>
                                
                                
                                
                            </fieldset>
                            
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>รายละเอียด สินค้า </h2>				
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label">รหัส</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="reGoCode" id="reGoCode" placeholder="รหัส">
                                                <input type="hidden" name="reGoId" id="reGoId" placeholder="รหัส">
                                        </label>
                                    </section>
                                    <section class="col col-1">
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnReGoSearch" class="btn btn-primary btn-sm">ค้นหา</button>
                                    </section>
                                    <section class="col col-4">
                                        <label class="label">ชื่อสินค้า</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="reGoName" id="reGoName" placeholder="ชื่อสินค้า">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">จำนวน</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="number" step=any name="reGoQty" id="reGoQty" placeholder="จำนวน" >
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-primary btn-sm" id="btnReAdd">เพิ่มสินค้า</button>
                                        <input type="hidden" name="reCnt" id="reCnt" value="<?php echo $reCnt;?>">
                                    </section>
                                </div>
                            </fieldset>

                            <div id="divView"><?php echo $tr1?></div>
                            <footer>
                                <div class="row">
                                    <section class="col col-3 left">
                                        <button type="button" id="btnSave" class="btn btn-primary">
                                                บันทึกข้อมูล
                                        </button>
                                    </section>
                                    <section class="col col-9 right-inner">
                                        <button type="button" id="btnReDoc" class="btn btn-primary">
                                                ออกเลขที่เอกสาร เพิ่มStock
                                        </button>
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
        if($("#retFlagNew").val()=="new"){
            //$("#btnReDoc").
            $("#btnReDoc").prop("disabled", true);
        }else if($("#retStatusStock").val()=="1"){
            $("#btnReDoc").prop("disabled", true);
        }
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
        var reCnt1 = $("#reCnt").val();
        for (var i=1;i<=reCnt1;i++){
        //alert("hello");
            $("#btndel"+i).click(function() {
                //alert("hello "+$("#reDID"+i).val());
                //$(this).remove();
            });
        }
        
        $("#reGoAmt").attr("disabled", "disabled"); 
        $("#trReDetail .deleteLink").on("click",function() {
            
            var td = $(this).parent();
            var tr = td.parent();
            
            
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 "+td.attr("id"));
                        delRecD(td.attr("id"));
                        tr.css("background-color","#FF3700");
                        tr.fadeOut(2000, function(){
                            tr.remove();
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
            
            //$(this).parent().attr("id");
            //alert("hello "+$(this).parent().attr("id"));
            //change the background color to red before removing
            
        });
        hideBtnVoid();
        $("#retAlert").hide();
        $('#sandbox-container input').datepicker({ });
        $("#btnSave").click(saveRec1);
        $("#btnReAdd").click(addRow);
        $("#btnReGoSearch").click(goSearch);
        $("#btnReDoc").click(genStock);
        $("#reGoQty").keyup(calAmt);
        $("#reGoPrice").keyup(calAmt);
        $("#retDrawSearch").click(searchDraw);
        $("#chkRetVoid").click(checkBtnVoid);
        function checkBtnVoid(){
            if($("#chkRetVoid").is(':checked'))
                $("#btnRetVoid").hide();  // checked
            else
                $("#btnRetVoid").show();  // unchecked
//            $("#btnReVoid").show();
        }
        function hideBtnVoid(){
            $("#btnRetVoid").hide();
        }
        function searchDraw(){
            //alert("aaaa");
            $.ajax({
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'draw_date1': $("#retDraDate1").val(),'draw_date2': $("#retDraDate2").val(), 'flagPage':"drawSearch" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    //alert('bbbbb '+json_obj.draw_doc);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    toAppend = "<option value='0' selected='' disabled=''>เลือก เลขที่ เบิกสินค้า</option>";
                    for (var i in json_obj){
                        toAppend += '<option value="'+json_obj[i].draw_id+'">'+json_obj[i].draw_doc+json_obj[i].description+'</option>';
                    }
                    $("#retDraId").append(toAppend);
                    $("#retDraId").selectpicker('refresh');
                }
            });
        }
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        function isNumberKey1(evt){
             $('.number').keypress(function(event) {
                if(event.which == 8 || event.keyCode == 37 || event.keyCode == 39 || event.keyCode == 46) 
                     return true;
                else if((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57))
                     event.preventDefault();
           });
        }
        function calAmt1(evt){
            if(isNumberKey1(evt)){
                $("#reGoAmt").val($("#reGoQty").val()*$("#reGoPrice").val());
            }
        }
        function calAmt(){
            $("#reGoAmt").val($("#reGoQty").val()*$("#reGoPrice").val());
        }
        function goSearch(){
            $.ajax({
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'goods_code': $("#reGoCode").val(), 'flagPage':"goSearch" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        if(json_obj[i].goods_name!=null) {
                            $("#reGoName").val(json_obj[i].goods_name);
                        }
                        if(json_obj[i].price!=null) {
                            $("#reGoPrice").val(json_obj[i].cost);
                        }
                        if(json_obj[i].goods_id!=null) {
                            $("#reGoId").val(json_obj[i].goods_id);
                        }
                        if(json_obj[i].unit_id!=null) {
                            //$("#reGoId").val(json_obj[i].unit_id);
                            $('#reGoUnit').val(json_obj[i].unit_id);
                        }
                    }
                }
            });
        }
        function genStock(){
            $.confirm({
                title: 'Confirm!',
                content: 'Simple confirm!',
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 ");
                        var retRetId = $("#retRetId").val();
                        //$.alert("hello222 "+retRetId);
                        $.ajax({
                            type: 'GET', url: 'genStock.php', contentType: "application/json", dataType: 'text', 
                            data: { 'ret_id': retRetId
                                ,'flagPage': "gen_stock_return" }, 
                            success: function (data) {
                                //var rec_id = $("#retRetId").val();
                                //saveDetail();
                                //alert('bbbbb'+data);
                                var json_obj = $.parseJSON(data);
                                $("#btnReDoc").prop("disabled", true);
                                $.alert({
                                    title: 'Save Data',
                                    content: 'gen Stock เรียบร้อย',
                                });
                                $("#retVali").empty();
                                $("#retVali").append("gen Stock เรียบร้อย");
                                //for (var i in json_obj){
                                //    alert("aaaa "+json_obj[i].success);
                                //}
            //                    alert('bbbbb '+json_obj.length);
            //                    alert('ccccc '+$("#cDistrict").val());
                                //$("#cZipcode").val("aaaa");
                            }
                        });
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function addRow(){
            
            var reCnt = $("#reCnt").val();
            var reGoCode = $("#reGoCode").val();
//            alert('aaaa '+reGoCode);
            if(reGoCode==""){
                return;
            }
            var reGoId = $("#reGoId").val();
            var reGoName = $("#reGoName").val();
            var reGoQty = $("#reGoQty").val();
            //var reGoPrice = $("#reGoPrice").val();
            //var reGoAmt = $("#reGoAmt").val();
            var reGoUnit = $("#reGoUnit").val();
            var reGoUnit1 = $("#reGoUnit :selected").text();
            //alert('aaaa '+reGoCode);
            var trId = "<input type='hidden' id='reRetDId"+reCnt+"' value=''>";
            var trGoId = "<input type='hidden' id='reGoId"+reCnt+"' value='"+reGoId+"'>";
            var trCode = "<input type='hidden' id='reGoCode"+reCnt+"' value='"+reGoCode+"'>";
            var trQty = "<input type='hidden' id='reGoQty"+reCnt+"' value='"+reGoQty+"'>";
            //var trPrice = "<input type='hidden' id='reGoPrice"+reCnt+"' value='"+reGoPrice+"'>";
            //var trAmt = "<input type='hidden' id='reGoAmt"+reCnt+"' value='"+reGoAmt+"'>";
            var trUnit = "<input type='hidden' id='reGoUnit"+reCnt+"' value='"+reGoUnit+"'>";
            
            if(reGoQty==""){
                return;
            }
//            if(reGoAmt==""){
//                return;
//            }
            //alert('aaaa '+reGoCode);
            var tr = "<tr class='child'><td>"+reGoCode+trCode+trId+trGoId+"</td><td>"+reGoName+"</td><td>"+reGoQty+trQty+"</td><td>"+reGoUnit1+trUnit+"</td></tr>";
            reCnt++;
            $("#reCnt").val(reCnt);
            //alert('aaaa');
            $('#trReDetail').append(tr);
            //$('#trReDetail tr:last').after('<tr class="child"><td>blahblah<\/td></tr>');
        }
        function saveRec1(){
            saveReturn();
            //saveDetail();
        }
        function delRecD(recDID){
            //alert(recDID);
            $.ajax({
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'ret_detail_id': recDID
                    ,'flagPage': "return_detail_void" }, 
                success: function (data) {
                    //var rec_id = $("#retRetId").val();
                    //saveDetail();
                    //alert('bbbbb'+data);
                    //var json_obj = $.parseJSON(data);
                    //for (var i in json_obj){
                    //    alert("aaaa "+json_obj[i].success);
                    //}
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }

        function saveReturn(){
            $("#retAlert").show();
            //alert('aaaaa '+$("#reRecDate").val());
            var retRetId = $("#retRetId").val();

            $.ajax({
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'return_id': retRetId
                    ,'return_doc': $("#reRetDoc").val()
                    ,'draw_id': $("#retDraId").val()
                    ,'description': $("#reDesc").val()
                    ,'return_date': $("#reRetDate").val()
                    //,'inv_ex_date': $("#reInvExDate").val()
                    ,'comp_id': $("#retComp").val()
                    ,'cust_id': $("#retCust").val()
                    ,'branch_id': $("#retBranch").val()
                    ,'remark': $("#reRemark").val()
                    ,'flag_new': $("#retFlagNew").val()
                    ,'flagPage': "goods_return" }, 
                success: function (data) {
                    //var rec_id = $("#retRetId").val();
                    saveDetail();
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    for (var i in json_obj){
                        //alert("aaaa "+json_obj[i].success);
                        if(json_obj[i].success=="1"){
                            $("#btnSave").prop("disabled", true);
                            $.alert({
                                title: 'Save Data',
                                content: 'บันทึกข้อมูลเรียบร้อย',
                            });
                            $("#retVali").empty();
                            $("#retVali").append(json_obj[i].sql);
                        }
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }
        function saveDetail(){
            var cnt = $("#reCnt").val();
            var retRetId = $("#retRetId").val();
            //alert('saveDetail '+cnt);
            for (var i=0;i<cnt;i++){
                //alert("zzzzzz");
                //var retRetId = $("#retRetId"+i).val();
                var reRetDId = $("#reRetDId"+i).val();
                var reGoId = $("#reGoId"+i).val();
                //var reGoCode = $("#reGoCode"+i).val();
                //var reGoName = $("#reGoName"+i).val();
                var reGoQty = $("#reGoQty"+i).val();
//                var reGoPrice = $("#reGoPrice"+i).val();
//                var reGoAmt = $("#reGoAmt"+i).val();
//                var reGoUnit = $("#reGoUnit"+i).val();
                //var retRetId = $("#retRetId").val();
                //alert("pppppp "+reRetDId);
                $.ajax({
                    type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                    data: { 'ret_detail_id': reRetDId
                        ,'ret_id': retRetId
                        ,'goods_id': reGoId
                        ,'qty': reGoQty
//                        ,'price': reGoPrice
//                        ,'amt': reGoAmt
//                        ,'cost': reGoPrice
//                        ,'unit_id': reGoUnit
                        ,'remark': ''
                        ,'flagPage': "goods_return_detail"
                    },
                    success: function (data) {
//                        alert("mmmmm "+data);
                        var json_obj = $.parseJSON(data);
                        for (var i in json_obj){
                            //alert("mmmmm "+json_obj[i].success);
//                            if(json_obj[i].success=="1"){
//                                $.alert({
//                                    title: 'Save Data',
//                                    content: 'บันทึกข้อมูลเรียบร้อย Detail',
//                                });
//                            }
                        }
                    }
                });
            }
        }

</script>
