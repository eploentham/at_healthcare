<?php require_once("inc/init.php"); ?>
<?php
//if (!isset($_SESSION['at_user_staff_name']) || empty($_SESSION['at_user_staff_name'])) {
//    //header("location: #login.php");
//    $_SESSION['at_page'] ="goodsDrawView.php";
//    echo "<script>window.location.assign('#login.php');</script>";
//}
include 'UUID.php';
//echo $userDB;
$draId="-";
$retDraId="";
$draDoc="";
$draDesc="";
$draDate="";
$reInvExDate="";
$compId="";
$vendId="";
$branchIdDra="";
$custIdRec="";
$draRemark="";
$draFlagNew="";
$reStatusStock="";
$oCust="";
$draCustId="";
if(isset($_GET["draId"])){
    $draId = $_GET["draId"];
    $draFlagNew = "old";
    $backColor="style='background-color:white; '";
    //$draId="aa";
}else{
    $draId = UUID::v4();
    $draFlagNew = "new";
    $backColor="style='background-color:yellow; '";
}

//$draId="aa";
$goodsId="";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From t_goods_draw Where draw_id = '".$draId."' ";
//echo "<script> alert('aaaaa'); </script>";
//$rComp = mysqli_query($conn,"Select * From b_company Where comp_id = '1' ");
if ($rComp=mysqli_query($conn,$sql)){
    //$aRec = mysqli_fetch_array($rComp);
    while($aDra = mysqli_fetch_array($rComp)){
        $draId = $aDra["draw_id"];
        $draDoc = ($aDra["draw_doc"]);
        //$reInvEx = ($aDra["inv_ex"]);
        $draDesc = ($aDra["description"]);
        $draDate = ($aDra["draw_date"]);
        //$reInvExDate = ($aDra["inv_ex_date"]);
        $draRemark = ($aDra["remark"]);
        $reStatusStock = ($aDra["status_stock"]);

        $compId = ($aDra["comp_id"]);
        $branchIdDra = ($aDra["branch_id_draw"]);
        $custIdRec = ($aDra["cust_id_rec"]);
        $draCustId = $aDra["cust_id_rec"];
        $draDate = substr($draDate,strlen($draDate)-2)."-".substr($draDate,5,2)."-".substr($draDate,0,4);
    //    $goUnit = strval($aRec["unit_id"]);
    //    $goTypeId = strval($aRec["goods_type_id"]);
    //    $goCatId = strval($aRec["goods_cat_id"]);
    }
}else{
    $goId = $goodsId;
}
$sql="Select * From b_company Order By comp_name_t";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oComp1 = "<option value='0' selected='' disabled=''>เลือก บริษัท</option>";
    while($row = mysqli_fetch_array($result)){
        if($draFlagNew=="old"){
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
    $oBranchD = "<option value='0' selected='' disabled=''>เลือก สาขา</option>";
    $oBranchR = "<option value='0' selected='' disabled=''>เลือก สาขา</option>";
    while($row = mysqli_fetch_array($result)){
        if($branchIdDra===$row["branch_id"]){
            $oBranchD .= '<option selected value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }else{
            $oBranchD .= '<option value='.$row["branch_id"].'>'.$row["branch_name"].'</option>';
        }
    }
}
$sql="Select * From b_unit Order By unit_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oUnit = "<option value='0' selected='' disabled=''>เลือก หน่วย</option>";
    while($row = mysqli_fetch_array($result)){
//        if($goUnit===$row["unit_id"]){
//            $oUnit .= '<option selected value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
//        }else{
            $oUnit .= '<option value='.$row["unit_id"].'>'.$row["unit_name"].'</option>';
//        }
        
    }
}
$sql="Select * From b_customer Order By cust_code";
//$result = mysqli_query($conn,"Select * From f_company_type Where active = '1' Order By comp_type_code");
if ($result=mysqli_query($conn,$sql)){
    $oCust = "<option value='0' selected='' disabled=''>เลือก ลูกค้า</option>";    
    while($row = mysqli_fetch_array($result)){
        if($draCustId===$row["cust_id"]){
            $oCust .= '<option selected value='.$row["cust_id"].'>'.$row["cust_name_t"].'</option>';
        }else{
            $oCust .= '<option value='.$row["cust_id"].'>'.$row["cust_name_t"].'</option>';
        }
    }
}
$tr1="<table id='trDraDetail' class='table table-striped table-bordered table-hover' width='100%'><thead>"
        ."<tr><th data-class='expand'>รหัส</th>"
        ."<th data-class='expand'>ชื่อสินค้า</th>"
        ."<th data-class='expand'>qty</th><th data-class='expand'>ราคา</th>"
        ."<th data-class='expand'>หน่วย</th><th data-class='expand'>รวมราคา</th><th data-class='expand'>hn</th><th>-</th></tr></thead><tbody>";
$sql="Select drad.*, g.goods_code, g.goods_name, u.unit_name "
        ."From t_goods_draw_detail drad "
        ."Left Join b_goods g on drad.goods_id = g.goods_id "
        ."Left Join b_unit u on drad.unit_id = u.unit_id "
        ."Where draw_id = '".$draId."' and drad.active = '1' ";
$draCnt=0;
if ($rDetail=mysqli_query($conn,$sql)){
    while($row = mysqli_fetch_array($rDetail)){
        $draCnt++;
        $tr="<input type='hidden' id='draDID".$draCnt."' value='".$row["draw_detail_id"]."'>";
        $tr1 .= "<tr id='tr".$draCnt."'><td >".$tr.$row["goods_code"]."</td><td>".$row["goods_name"]."</td><td>"
                .$row["qty"]."</td><td>".$row["price"]."</td><td>"
                .$row["unit_name"]."</td><td>".$row["amount"]."</td><td>".$row["hn"]."</td><td id='".$row["draw_detail_id"]."'><button type='button' id='btndel".$draCnt."' class='deleteLink'>del</button></td></tr>";
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

<div class="alert alert-block alert-success" id="draAlert">
	<a class="close" data-dismiss="alert" href="#">×</a>
	<h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
	<p id="draVali">
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
                    <h2>รายการเบิก ตัดจ่าย สินค้า </h2>				
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
                                    <section class="col col-3">
                                        <label class="label">เลขที่เอกสาร</label>
                                        <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="draDoc" id="draDoc" value="<?php echo $draDoc;?>" placeholder="เลขที่เอกสาร" <?php echo $backColor;?>>
                                            <input type="hidden" name="draId" id="draId" value="<?php echo $draId;?>">
                                            <input type="hidden" name="draFlagNew" id="draFlagNew" value="<?php echo $draFlagNew;?>">
                                            <input type="hidden" name="reStatusStock" id="reStatusStock" value="<?php echo $reStatusStock;?>">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                    </section>
                                    <section class="col col-6">
                                        <label class="label">รายละเอียด</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="draDesc" id="draDesc" value="<?php echo $draDesc;?>" placeholder="รายละเอียด">

                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">วันที่เบิกสินค้า</label>
                                        <label class="input"> <i class="icon-append fa fa-user"></i>
                                            <input type="text" name="draDate" id="draDate" value="<?php echo $draDate;?>" placeholder="วันที่เบิกสินค้า" class="datepicker" data-date-format="dd/mm/yyyy">
                                            <b class="tooltip tooltip-bottom-right">Needed to enter the website</b> </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section  class="col col-4">
                                        <label class="label">บริษัท</label>
                                        <label class="select">
                                            <select name="draComp" id="draComp">
                                                <?php echo $oComp1;?>
                                            </select> <i></i> </label>
                                    </section >
                                    <section  class="col col-4">
                                        <label class="label">เบิก จากสาขา</label>
                                        <label class="select">
                                            <select name="draBranchD" id="draBranchD">
                                                <?php echo $oBranchD;?>
                                            </select> <i></i> </label>
                                    </section >
                                    <section  class="col col-4">
                                        <label class="label">ลูกค้า</label>
                                        <label class="select">
                                            <select name="draCust" id="draCust">
                                                <?php echo $oCust;?>
                                            </select> <i></i> </label>
                                    </section >
                                </div>
                                
                                
                                
                                <section >
                                    <label class="label">หมายเหตุ</label>
                                    <label class="input"> <i class="icon-append fa fa-envelope-o"></i>
                                            <input type="text" name="draRemark" id="draRemark" value="<?php echo $draRemark;?>" placeholder="หมายเหตุ">
                                            <b class="tooltip tooltip-bottom-right">Needed to verify your account</b> </label>
                                </section >
                            </fieldset>
                            
                            <header>
                                <span class="widget-icon"> <i class="fa fa-edit"></i> </span>
                                <h2>รายละเอียด สินค้า </h2>				
                            </header>

                            <fieldset>
                                <div class="row">
                                    <section class="col col-4">
                                        <label class="label">รหัส</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draGoCode" id="draGoCode" placeholder="รหัส">
                                                <input type="hidden" name="draGoId" id="draGoId" placeholder="รหัส">
                                        </label>
                                        
                                    </section>
                                    <section class="col col-1">
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnReGoSearch" class="btn btn-primary btn-sm">ค้นหา</button>
                                    </section>
                                    <section class="col col-5">
                                        <label class="label">ชื่อสินค้า</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draGoName" id="draGoName" placeholder="ชื่อสินค้า">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">HN</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draHN" id="draHN" placeholder="HN">
                                        </label>
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-2">
                                        <label class="label">จำนวน</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draGoQty" id="draGoQty" placeholder="จำนวน">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">ราคา</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draGoPrice" id="draGoPrice" placeholder="ราคา">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">Unit</label>
                                        <label class="select">
                                            <select name="draGoUnit" id="draGoUnit">
                                                <?php echo $oUnit;?>
                                            </select> <i></i> </label>
                                    </section>
                                    <section class="col col-2 right-inner">
                                        <label class="label">รวมราคา</label>
                                        <label class="input"> <i class="icon-prepend fa fa-phone"></i>
                                                <input type="text" name="draGoAmt" id="draGoAmt" placeholder="รวมราคา">
                                        </label>
                                    </section>
                                    <section class="col col-2">
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" class="btn btn-primary btn-sm" id="btnDraAdd">เบิกสินค้า</button>
                                        <input type="hidden" name="draCnt" id="draCnt" value="<?php echo $draCnt;?>">
                                    </section>
                                </div>
                            </fieldset>

                            <div id="divView"><?php echo $tr1?></div>
                            <footer>
                                <div class="row">
                                    <section class="col col-3 left-inner">
                                        <button type="button" id="btnSave" class="btn btn-primary">
                                                บันทึกข้อมูล
                                        </button>
                                    </section>
                                    <section class="col col-9 right-inner">
                                        <button type="button" id="btnDraDoc" class="btn btn-primary">
                                                ออกเลขที่เอกสาร (ทอนStock)
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
        $("#draAlert").hide();
        if($("#draFlagNew").val()=="new"){
            //$("#btnDraDoc").
            $("#btnDraDoc").prop("disabled", true);
        }else if($("#reStatusStock").val()=="1"){
            $("#btnDraDoc").prop("disabled", true);
        }
        $('.datepicker').datepicker({
            format: 'dd/mm/yyyy',
            startDate: '-3d'
        });
        var reCnt1 = $("#draCnt").val();
        for (var i=1;i<=reCnt1;i++){
        //alert("hello");
            $("#btndel"+i).click(function() {
                //alert("hello "+$("#reDID"+i).val());
                //$(this).remove();
            });
        }
        
        
        $("#trDraDetail .deleteLink").on("click",function() {
            
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
        
        $("#draDoc").prop("disabled", true);
        $('#sandbox-container input').datepicker({ });
        $("#btnSave").click(saveDra1);
        $("#btnDraAdd").click(addRow);
        $("#btnReGoSearch").click(goSearch);
        $("#btnDraDoc").click(genStock);
        $("#draGoQty").keyup(calAmt);
        function calAmt(){
            $("#draGoAmt").val($("#draGoQty").val()*$("#draGoPrice").val());
        }
        function goSearch(){
            $.ajax({
                type: 'GET', url: 'getAmphur.php', contentType: "application/json", dataType: 'text', data: { 'goods_code': $("#draGoCode").val(), 'flagPage':"goSearch" }, 
                success: function (data) {
                    //alert('bbbbb');
                    var json_obj = $.parseJSON(data);
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                    for (var i in json_obj){
                        if(json_obj[i].goods_name!=null) {
                            $("#draGoName").val(json_obj[i].goods_name);
                        }
                        if(json_obj[i].price!=null) {
                            $("#draGoPrice").val(json_obj[i].price);
                        }
                        if(json_obj[i].goods_id!=null) {
                            $("#draGoId").val(json_obj[i].goods_id);
                        }
                        if(json_obj[i].unit_id!=null) {
                            //$("#draGoId").val(json_obj[i].unit_id);
                            $('#draGoUnit').val(json_obj[i].unit_id);
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
                        var draId = $("#draId").val();
                        //$.alert("hello222 "+draId);
                        $.ajax({
                            type: 'GET', url: 'genStock.php', contentType: "application/json", dataType: 'text', 
                            data: { 'draw_id': draId
                                ,'flagPage': "gen_stock_draw" }, 
                            success: function (data) {
                                //var rec_id = $("#draId").val();
                                //saveDetail();
                                //alert('bbbbb'+data);
                                var json_obj = $.parseJSON(data);
                                $("#btnDraDoc").prop("disabled", true);
                                $.alert({
                                    title: 'Save Data',
                                    content: 'gen Stock เรียบร้อย',
                                });
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
            var draCnt = $("#draCnt").val();
            var draGoCode = $("#draGoCode").val();
            //alert('aaaa '+draGoCode);
            if(draGoCode==""){
                return;
            }
            var draGoId = $("#draGoId").val();
            var draGoName = $("#draGoName").val();
            var draGoQty = $("#draGoQty").val();
            var draGoPrice = $("#draGoPrice").val();
            var draGoAmt = $("#draGoAmt").val();
            var draGoUnit = $("#draGoUnit").val();
            var draGoUnit1 = $("#draGoUnit :selected").text();
            
            var trId = "<input type='hidden' id='draDId"+draCnt+"' value=''>";
            var trGoId = "<input type='hidden' id='draGoId"+draCnt+"' value='"+draGoId+"'>";
            var trCode = "<input type='hidden' id='draGoCode"+draCnt+"' value='"+draGoCode+"'>";
            var trQty = "<input type='hidden' id='draGoQty"+draCnt+"' value='"+draGoQty+"'>";
            var trPrice = "<input type='hidden' id='draGoPrice"+draCnt+"' value='"+draGoPrice+"'>";
            var trAmt = "<input type='hidden' id='draGoAmt"+draCnt+"' value='"+draGoAmt+"'>";
            var trUnit = "<input type='hidden' id='draGoUnit"+draCnt+"' value='"+draGoUnit+"'>";
            
            if(draGoQty==""){
                return;
            }
            if(draGoAmt==""){
                return;
            }
            //alert('aaaa '+draGoCode);
            var tr = "<tr class='child'><td>"+draGoCode+trCode+trId+trGoId+"</td><td>"+draGoName+"</td><td>"+draGoQty+trQty+"</td><td>"+draGoPrice+trPrice+"</td><td>"+draGoUnit1+trUnit+"</td><td>"+draGoAmt+trAmt+"</td></tr>";
            draCnt++;
            $("#draCnt").val(draCnt);
            //alert('aaaa');
            $('#trDraDetail').append(tr);
            //$('#trReDetail tr:last').after('<tr class="child"><td>blahblah<\/td></tr>');
        }
        function saveDra1(){
            saveDra();
            //saveDetail();
        }
        function delRecD(recDID){
            //alert(recDID);
            $.ajax({
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'draw_detail_id': recDID
                    ,'flagPage': "draw_detail_void" }, 
                success: function (data) {
                    //var rec_id = $("#draId").val();
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

        function saveDra(){
            $("#draAlert").show();
            //alert('aaaaa '+$("#reRecDate").val());
            var draId = $("#draId").val();
            $.ajax({
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                data: { 'draw_id': draId
                    ,'draw_doc': $("#draDoc").val()
                    //,'inv_ex': $("#reInvEx").val()
                    ,'description': $("#draDesc").val()
                    ,'draw_date': $("#draDate").val()
                    //,'inv_ex_date': $("#reInvExDate").val()
                    ,'comp_id': $("#draComp").val()
                    ,'branch_id_draw': $("#draBranchD").val()
                    ,'cust_id_rec': $("#draCust").val()
                    ,'remark': $("#draRemark").val()
                    ,'flag_new': $("#draFlagNew").val()
                    ,'flagPage': "goods_draw" }, 
                success: function (data) {
                    //var rec_id = $("#draId").val();
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
                            $("#draVali").empty();
                            $("#draVali").append(json_obj[i].sql);
                        }
                    }
//                    alert('bbbbb '+json_obj.length);
//                    alert('ccccc '+$("#cDistrict").val());
                    //$("#cZipcode").val("aaaa");
                }
            });
        }
        function saveDetail(){
            var cnt = $("#draCnt").val();
            var draId = $("#draId").val();
            //alert('saveDetail ');
            for (var i=0;i<cnt;i++){
                //alert("zzzzzz");
                //var draId = $("#draId"+i).val();
                var draDId = $("#draDId"+i).val();
                var draGoId = $("#draGoId"+i).val();
                //var draGoCode = $("#draGoCode"+i).val();
                //var draGoName = $("#draGoName"+i).val();
                var draGoQty = $("#draGoQty"+i).val();
                var draGoPrice = $("#draGoPrice"+i).val();
                var draGoAmt = $("#draGoAmt"+i).val();
                var draGoUnit = $("#draGoUnit"+i).val();
                var draHN = $("#draHN").val();
                //alert("pppppp "+reDraDId);
                $.ajax({
                    type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text', 
                    data: { 'draw_detail_id': draDId
                        ,'draw_id': draId
                        ,'goods_id': draGoId
                        ,'qty': draGoQty
                        ,'price': draGoPrice
                        ,'amt': draGoAmt
                        ,'cost': draGoPrice
                        ,'unit_id': draGoUnit
                        ,'hn': draHN
                        ,'remark': ''
                        ,'flagPage': "goods_draw_detail"
                    },
                    success: function (data) {
                        var json_obj = $.parseJSON(data);
                        for (var i in json_obj){
                            //alert("mmmmm "+json_obj[i].success);
                            if(json_obj[i].success=="1"){
                                $.alert({
                                    title: 'Save Data',
                                    content: 'บันทึกข้อมูลเรียบร้อย Detail',
                                });
                            }
                        }
                    }
                });
            }
        }

</script>
