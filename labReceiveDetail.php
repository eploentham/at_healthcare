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
if(isset($_GET["goodsId"])){
    $goId = $_GET["goodsId"];
}else{
    $goId = "";
}
$conn = mysqli_connect($hostDB,$userDB,$passDB,$databaseName);
mysqli_set_charset($conn, "UTF8");
$sql="Select * From b_goods Where goods_id = '".$goId."' ";
if ($rComp=mysqli_query($conn,$sql)){
    
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


<section id="widget-grid" class="">
    <!-- START ROW -->
    <div class="row">
        <!-- NEW COL START -->
        <article class="col-sm-12 col-md-12 col-lg-8">
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
                                
                            </fieldset>
                            <footer>
                                <div class="row">
                                    <section class="col col-3 left">
                                        <button type="button" id="btnSave" class="btn btn-primary">
                                                บันทึกข้อมูล
                                        </button>
                                    </section>

                                    <section class="col col-3 ">
                                        <ul class="demo-btns">
                                            <li>
                                                <a href="javascript:void(0);" class="btn bg-color-blue txt-color-white"><i id="loading" class="fa fa-gear fa-2x fa-spin"></i></a>
                                            </li>
                                        </ul>
                                    </section>
                                    <div class="alert alert-block alert-success col col-6"  id="compAlert">
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
                
                
                </div>
            </div>
        </article>
    </div>
</section>

