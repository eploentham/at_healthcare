<?php
require_once("inc/init.php"); 
//if (!isset($_SESSION['at_user_staff_name'])) {
//    //header("location: #login.php");
//    $_SESSION['at_page'] ="labReceiveDetail.php";
//    echo "<script>window.location.assign('#login.php');</script>";
//}
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$brId="";
$yearId="";
$monthId="";
$periodId="";
$tr="";
$brname="";
$monthname="";
$periodname="";
if(isset($_GET["branch_id"])){
    $brId = $_GET["branch_id"];
}else{
    $brId = "";
}
if(isset($_GET["year_id"])){
    $yearId = $_GET["year_id"];
}else{
    $yearId = "";
}
if(isset($_GET["month_id"])){
    $monthId = $_GET["month_id"];
}else{
    $monthId = "";
}
if(isset($_GET["period_id"])){
    $periodId = $_GET["period_id"];
}else{
    $periodId = "";
}
$cntHn=0;
$cnt=0;
$cntPaid=0;
$sumPaid=0;
$sumDiscount=0;
$sumNetPrice=0;
$excelCnt=0;
$trPaid="";
$paidType="";
$err="1111111";
$where="Where branch_id = '".$brId."' and year_id = '".$yearId
    ."' and month_id = '".$monthId."' and period_id = '".$periodId."' and active = '1' ";
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");

$sql = "Select * From lab_t_data_header_sum ".$where;
$err=$sql;
if ($rComp1=mysqli_query($conn,$sql)){
    $err="222222";
    $num_rows = mysql_num_rows($rComp1);
    if($num_rows<=0){
        $err="333333";
        $sql="Select count(1) as cnt  From lab_t_data ".$where;
        if ($rComp=mysqli_query($conn,$sql)){
            while($aRec = mysqli_fetch_array($rComp)){
                $cnt = $aRec["cnt"];
            }
        }
        $sql="Select hn  From lab_t_data ".$where
            ."Group By hn";
        if ($rComp=mysqli_query($conn,$sql)){
            while($aRec = mysqli_fetch_array($rComp)){
                $cntHn++;
            }
        }
        
        $sql = "Select * From lab_t_data_header ".$where;
        if ($rComp=mysqli_query($conn,$sql)){
            while($aRec = mysqli_fetch_array($rComp)){
                $excelCnt=$aRec["excel_cnt"];
            }
        }
        $sql="Select distinct paid_type_name, count(1) as cnt, sum(price3) as price3, sum(discount) as discount, sum(netprice) as netprice  From lab_t_data "
            .$where
            ."Group By paid_type_name";
        if ($rComp=mysqli_query($conn,$sql)){
            $err="44444455";
            while($aRec = mysqli_fetch_array($rComp)){
                $paidType = $aRec["paid_type_name"];
                if($brId==="2"){
                    if($paidType==="@"){
                        $paidType="ทั่วไป";
                    }else if($paidType==="#"){
                        $paidType="ประกันสังคม";
                    }            
                }
                //$trPaid.="<tr><td>".$paidType."</td><td>".number_format($aRec["cnt"],2,'.',',')."</td><td>".number_format($aRec["price3"],2,'.',',')."</td><td>".number_format($aRec["discount"],2,'.',',')."</td><td>".number_format($aRec["netprice"],2,'.',',')."</td></tr>";
                $cntPaid+=$aRec["cnt"];
                $sumPaid+=$aRec["price3"];
                $sumDiscount+=$aRec["discount"];
                $sumNetPrice+=$aRec["netprice"];
                $sql = "Insert Into lab_t_data_header_sum (branch_id, year_id, month_id, period_id, active,data_header_id,"
                        . "paid_type_name, qty, price3, discount, netprice  ) "
                        . "Values ('".$brId."','".$yearId."','".$monthId."','".$periodId."','1','',"
                        . "'".$paidType."','".$aRec["cnt"]."','".$aRec["price3"]."','".$aRec["discount"]."','".$aRec["netprice"]."')";
                if ($result=mysqli_query($conn,$sql) or die(mysqli_error($conn))){
                    
                }
            }
            $cntPaid=0;
            $sumPaid=0;
            $sumDiscount=0;
            $sumDiscount=0;
            $sumNetPrice=0;
            $sql = "Select * From lab_t_data_header_sum ".$where;
            if ($rComp=mysqli_query($conn,$sql)){
                while($aRec = mysqli_fetch_array($rComp)){
                    $paidType = $aRec["paid_type_name"];
                    if($brId==="2"){
                        if($paidType==="@"){
                            $paidType="ทั่วไป";
                        }else if($paidType==="#"){
                            $paidType="ประกันสังคม";
                        }            
                    }
                    $trPaid.="<tr><td>".$paidType."</td><td>".number_format($aRec["cnt"],2,'.',',')."</td><td>".number_format($aRec["price3"],2,'.',',')."</td><td>".number_format($aRec["discount"],2,'.',',')."</td><td>".number_format($aRec["netprice"],2,'.',',')."</td></tr>";
                    $cntPaid+=$aRec["cnt"];
                    $sumPaid+=$aRec["price3"];
                    $sumDiscount+=$aRec["discount"];
                    $sumNetPrice+=$aRec["netprice"];
                }
                $trPaid.="<tr><td>รวม</td><td>".number_format($cntPaid,2,'.',',')."</td><td>".number_format($sumPaid,2,'.',',')."</td><td>".number_format($sumDiscount,2,'.',',')."</td><td>".number_format($sumNetPrice,2,'.',',')."</td></tr>";
            }
            
        }
    }else{
        while($aRec = mysqli_fetch_array($rComp1)){
            $paidType = $aRec["paid_type_name"];
            if($brId==="2"){
                if($paidType==="@"){
                    $paidType="ทั่วไป";
                }else if($paidType==="#"){
                    $paidType="ประกันสังคม";
                }            
            }
            $trPaid.="<tr><td>".$paidType."</td><td>".number_format($aRec["cnt"],2,'.',',')."</td><td>".number_format($aRec["price3"],2,'.',',')."</td><td>".number_format($aRec["discount"],2,'.',',')."</td><td>".number_format($aRec["netprice"],2,'.',',')."</td></tr>";
        }
    }
}else{
    
}









$labEmailTo="";
$labEmailFrom="";
$labEmailSubject="";
$sql = "Select * from b_customer where lab_branch_id = '".$brId."';";
if ($rComp=mysqli_query($conn,$sql)){
    while($aRec = mysqli_fetch_array($rComp)){
        $labEmailTo=$aRec["lab_email_address_to"];
        $labEmailFrom=$aRec["lab_email_address_from"];
        $labEmailSubject=$aRec["lab_email_subject_to"];
    }
}
$brname = getBranchName($brId);
$monthname = getMonthName($monthId);
$periodname = getPeriodName($periodId);
$labEmailSubject.= " ".$brname." ประจำ ปี ".$yearId." เดือน ".$monthname." งวด ".$periodname;
$rComp->free();
mysqli_close($conn);
?>
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <h1 class="page-title txt-color-blueDark">
            <!-- PAGE HEADER -->
            <i class="fa-fw fa fa-pencil-square-o"></i>
                    Forms
            <span>
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


<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-12">
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
                    <h2>รายละเอียด ข้อมูล </h2>				
                </header>
                <div>
                <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->
                </div>
                    <div class="widget-body no-padding">
                        <form action="" id="smart-form-register" class="smart-form">
                            <fieldset>
                                <div class="row">
                                    <section class="col col-3">
                                        <label class="label">สาขา</label>
                                        <label class="select" id="goType1">
                                            <select id="cboBranch">
                                                <option value="1">บางนา1</option>
                                                <option value="2">บางนา2</option>
                                                <option value="5">บางนา5</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="branchId" id="branchId" value="<?php echo $brId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">ประจำปี</label>
                                        <label class="select" id="goType1">
                                            <select id="cboYear">
                                                <option value="2015">2015</option>
                                                    <option value="2016">2016</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2019">2019</option>
                                                    <option value="2020">2020</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="yearId" id="yearId" value="<?php echo $yearId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">เดือน</label>
                                        <label class="select" id="goType1">
                                            <select id="cboMonth">
                                                <option value="01">มกราคม</option>
                                                <option value="02">กุมภาพันธ์</option>
                                                <option value="03">มีนาคม</option>
                                                <option value="04">เมษายน</option>
                                                <option value="05">พฤษภาคม</option>
                                                <option value="06">มิถุนายน</option>
                                                <option value="07">กรกฎาคม</option>
                                                <option value="08">สิงหาคม</option>
                                                <option value="09">กันยายน</option>
                                                <option value="10">ตุลาคม</option>
                                                <option value="11">พฤศจิกายน</option>
                                                <option value="12">ธันวาคม</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="monthId" id="monthId" value="<?php echo $monthId;?>">
                                    </section>
                                    <section class="col col-3">
                                        <label class="label">งวด</label>
                                        <label class="select" id="goType1">
                                            <select id="cboPeriod">
                                                <option value="1">งวดต้นเดือน</option>
                                                <option value="2">งวดสิ้นเดือน</option>
                                            </select> <i></i> </label>
                                        <input type="hidden" name="periodId" id="periodId" value="<?php echo $periodId;?>">
                                    </section>
                                </div>
                                <div class="row">
                                    <section class="col col-4">
                                        <div class="row">
                                            <section class="col col-6">
                                                <label class="label">จำนวนข้อมูล</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reDesc" id="reDesc" value="<?php echo $cnt;?>" placeholder="จำนวนข้อมูล"></label>
                                                <label class="label">จำนวนข้อมูล Excel</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reExcel" id="reExcel" value="<?php echo $excelCnt;?>" placeholder="จำนวนข้อมูล"></label>
                                            </section>
                                            <section class="col col-6">
                                                <label class="label">จำนวนคนไข้</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reCntHn" id="reCntHn" value="<?php echo $cntHn;?>" placeholder="จำนวนคนไข้"></label>
                                            </section>
                                        </div>
                                        <div class="row" id="divSendEmail">
                                            <section class="col col-10">
                                                <label class="label">TO</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailTO" id="reEmailTO" value="<?php echo $labEmailTo;?>" placeholder="TO"></label>
                                                <label class="label">FROM</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailFrom" id="reEmailFrom" value="<?php echo $labEmailFrom;?>" placeholder="FROM"></label>
                                                    
                                                <label class="label">Subject</label>
                                                <label class="input"> <i class="icon-append fa fa-user"></i>
                                                    <input type="text" name="reEmailSubject" id="reEmailSubject" value="<?php echo $labEmailSubject;?>" placeholder="Subject"></label>
                                                    
                                                <label class="label">&nbsp;&nbsp;</label>
                                                <button type="button" id="btnComposeEmail" class="btn btn-primary btn-sm">compose email</button>
                                                <div id="divView"></div>
                                            </section>
                                            
   
                                            
                                        </div>
                                    </section>
                                                                        
                                    <section class="col col-8">
                                        <table id="dt_basic" class="table table-striped table-bordered table-hover responsive" width="100%">
                                            <thead>
                                                <tr>
                                                    <th data-class="expand" width="40%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สิทธิการรักษา</th>
                                                    <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>จำนวน</th>
                                                    <th data-class="expand" width="20%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>มูลค่า</th>
                                                    <th data-class="expand" width="15%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>ส่วนลด</th>
                                                    <th data-class="expand" width="20%"><i class="fa fa-fw fa-user text-muted hidden-md hidden-sm hidden-xs"></i>สุทธิ</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php //echo $err;?>
                                                <?php echo $trPaid;?>
                                            </tbody>
                                        </table>
                                    </section>
                                </div>
                            </fieldset>
                            <footer>
                                <div class="row">
                                    <section class="col col-2">    
                                        <label class="label">&nbsp;</label>
                                        <label class="toggle state-error"><input type="checkbox" name="chkReVoid" checked="true" id="chkReVoid"><i data-swchon-text="ใช้งาน" data-swchoff-text=" ยกเลิก"></i>สถานะ</label>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnReVoid" class="btn btn-primary btn-sm">ต้องการยกเลิก</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSave" class="btn btn-primary btn-sm">เปลี่ยนแปลง เดือนปี ข้อมูล</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSaveSum" class="btn btn-primary btn-sm">บันทึก ข้อมูล</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnPrint" class="btn btn-primary btn-sm">Print</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnPrintDetail" class="btn btn-primary btn-sm">Print รายละเอียด</button>
                                    </section>
                                    <section class="col col-2" >    
                                        <label class="label">&nbsp;&nbsp;</label>
                                        <button type="button" id="btnSendEmail" class="btn btn-primary btn-sm">ส่ง email แจ้งยอด</button>
                                    </section>
                                    <section class="col col-2 ">
                                        <ul class="demo-btns">
                                            <li id="uiLoading">
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                    <div class="alert alert-block alert-success col col-5"  id="compAlert">
                                        <a class="close" data-dismiss="alert" href="#">×</a>
                                        <h4 class="alert-heading"><i class="fa fa-check-square-o"></i> Check validation!</h4>
                                        <p id="compVali">
                                                You may also check the form validation by clicking on the form action button. Please try and see the results below!
                                        </p>
                                    </div>
                                </div>

                            </footer>
                        </form>
                    </div>
                    <div class="widget-body no-padding">
                        
                    </div>
                </div>
            </div>
        </article>
    </div>
</section>
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
        hideBtnVoid();
        $("#compVali").hide();
        $("#compAlert").hide();
        $("#chkReVoid").click(checkBtnVoid);
        $("#btnReVoid").click(voidRec);
        $("#btnSave").click(saveLab);
        $("#btnPrint").click(printSum);
        $("#btnPrintDetail").click(printDetail);
        $("#uiLoading").hide();
        $("#btnComposeEmail").click(sendEmail);
        $("#btnSendEmail").click(showSendEmail);
        hideSendEmail();
        $( document ).ready(function() {
            $("#cboBranch").val($("#branchId").val());
            $("#cboYear").val($("#yearId").val());
            $("#cboMonth").val($("#monthId").val());
            $("#cboPeriod").val($("#periodId").val());
        });
        function hideSendEmail(){
            $("#divSendEmail").hide();
            //$("#reEmailFrom").hide();
            //$("#reEmailSubject").hide();
        }
        function showSendEmail(){
            $("#divSendEmail").show();
            //$("#reEmailFrom").show();
            //$("#reEmailSubject").show();
        }
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
        function printSum(){
            window.location.assign("#labReceivePrintSum.php?branch_id="+$("#branchId").val()+"&year_id="+$("#yearId").val()+"&month_id="+$("#monthId").val()+"&period_id="+$("#periodId").val());
        }
        function printDetail(){
            $.ajax({ 
                type: 'GET', url: 'labReceivePrintDetail.php', contentType: "application/json", dataType: 'text'
                , data: { 'branch_id': $("#cboBranch").val(),'year_id': $("#cboYear").val(),'month_id': $("#cboMonth").val()
                    ,'period_id': $("#cboPeriod").val(), 'flagPage':"" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    window.location.assign('MyPDF.pdf');
                    var json_obj = $.parseJSON(data);
                    
                    for (var i in json_obj)
                    {
//                        $.alert({
//                            title: 'Save Data',
//                            content: 'ยกเลิกข้อมูลเรียบร้อย',
//                        });
                        //window.location.assign('#labReceiveView.php');
                        window.location.assign('MyPDF.pdf');
                    }
                }
            });
            
        }
        function voidRec(){
            //$("#veAmphur").empty();
            $.confirm({
                title: 'ต้องการยกเลิก ข้อมูลLAB!',
                content: 'ยกเลิก ข้อมูลLAB สาขา '+$("#cboBranch :selected").text()+" ปี "+$("#cboYear :selected").text()+" เดือน "+$("#cboMonth :selected").text()+" งวด "+$("#cboPeriod :selected").text(),
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 "+td.attr("id"));
                        voidRec1();
//                        voidStock();
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function voidRec1(){
            //$.alert("hello222 "+$("#veId").val());
            $.ajax({ 
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text'
                , data: { 'branch_id': $("#cboBranch").val(),'year_id': $("#cboYear").val(),'month_id': $("#cboMonth").val()
                    ,'period_id': $("#cboPeriod").val(), 'flagPage':"void_lab_receive" }, 
                success: function (data) {
                    //alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    
                    for (var i in json_obj)
                    {
//                        $.alert({
//                            title: 'Save Data',
//                            content: 'ยกเลิกข้อมูลเรียบร้อย',
//                        });
                        window.location.assign('#labReceiveView.php');
                    }
                }
            });
        }
        function saveLab(){
            $.confirm({
                title: 'ต้องการบันทึก ข้อมูลLAB!',
                content: 'บันทึก ข้อมูลLAB สาขา '+$("#cboBranch :selected").text()+" ปี "+$("#cboYear :selected").text()+" เดือน "+$("#cboMonth :selected").text()+" งวด "+$("#cboPeriod :selected").text(),
                buttons: {
                    confirm: function () {
                        //$.alert("hello222 "+td.attr("id"));
                        saveRec1();
//                        voidStock();
                    },
                    cancel: function () {
                        $.alert('Canceled!');
                    }
                }
            });
        }
        function saveRec1(){
            //$.alert("hello222 "+$("#veId").val());
            $.ajax({
                type: 'GET', url: 'saveData.php', contentType: "application/json", dataType: 'text'
                , data: { 'branch_id': $("#cboBranch").val(),'year_id': $("#cboYear").val(),'month_id': $("#cboMonth").val()
                    ,'period_id': $("#cboPeriod").val()
                    , 'branch_id_old': $("#branchId").val(),'year_id_old': $("#yearId").val(),'month_id_old': $("#monthId").val()
                    ,'period_id_old': $("#periodId").val()
                    , 'flagPage':"save_lab_receive" }, 
                success: function (data) {
//                    alert('bbbbb'+data);
                    var json_obj = $.parseJSON(data);
                    
                    for (var i in json_obj)
                    {
//                        $.alert({
//                            title: 'Save Data',
//                            content: 'ยกเลิกข้อมูลเรียบร้อย',
//                        });
                        window.location.assign('#labReceiveView.php');
                    }
                }
            });
        }
        function sendEmail(){
            //alert('bbbbb');
            //$("#divView").append("aaaaaaaaaaaaa");
            //alert("aaa"+$("#branchId").val());
            
            if($("#reEmailTO").val()===""){
                alert("Email TO ไม่สามารถว่างได้");
                return ;
            }
            if($("#reEmailFrom").val()===""){
                alert("Email From ไม่สามารถว่างได้ ");
                return ;
            }
            if($("#reEmailSubject").val()===""){
                alert("Email Subject ไม่สามารถว่างได้ ");
                return ;
            }
            
            $.ajax({
                type: 'GET', url: 'gmail.php', contentType: "application/json", dataType: 'text', 
                data: {'flagPage': "labsendemail"
                    , 'branch_id':$("#branchId").val()
                    , 'year_id':$("#yearId").val()
                    , 'month_id':$("#monthId").val()
                    , 'period_id':$("#periodId").val()
                    , 'reEmailTO':$("#reEmailTO").val()
                    , 'reEmailFrom':$("#reEmailFrom").val()
                    , 'reEmailSubject':$("#reEmailSubject").val()
                    }, 
                success: function (data) {
                    alert('ส่ง email เรียบร้อย '.data);
                    $("#divView").append(data);
                    $("#divView").append("<br>ส่ง email เรียบร้อย ");
//                    hideLoader();
                }
            });
        }

</script>
