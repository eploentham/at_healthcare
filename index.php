<!DOCTYPE html>
<?php
@session_start();
    require 'config.php';
        
    setIPView();
    $menu = file_get_contents('menu.php',TRUE);
    $footer = file_get_contents('footer.php',TRUE);
    if(isset($_SESSION["status_regis"])){
        $txt = "<a href='#' class='dropdown-toggle' > ".$_SESSION["cust_name_t"]." ".$_SESSION["cust_lastname_t"]."</a>";
        $menu = str_replace('<a href="login.php" class="dropdown-toggle" >ลงชื่อเข้าระบบ</a>',$txt,$menu);
    }
    
  //$switcher = file_get_contents('switcher.php',TRUE);
  //$footer = file_get_contents('footer.php',TRUE);
  //$ourclient = file_get_contents('ourclient.php',TRUE);
?>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
    <title>Manit Insurance</title>

    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" href="favicon.ico">

    <!-- Web Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Open+Sans:400,300,600&amp;subset=cyrillic,latin">

    <!-- CSS Global Compulsory -->
    <link rel="stylesheet" href="assets/plugins/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <!-- CSS Header and Footer -->
    <link rel="stylesheet" href="assets/css/headers/header-v6.css">
    <link rel="stylesheet" href="assets/css/footers/footer-v1.css">

    <!-- CSS Implementing Plugins -->
    <link rel="stylesheet" href="assets/plugins/animate.css">
    <link rel="stylesheet" href="assets/plugins/line-icons/line-icons.css">
    <link rel="stylesheet" href="assets/plugins/font-awesome/css/font-awesome.min.css">

    <!-- CSS Theme -->
    <link rel="stylesheet" href="assets/css/theme-colors/default.css" id="style_color">
    <link rel="stylesheet" href="assets/css/theme-skins/dark.css">

    <!-- CSS Customization -->
    <link rel="stylesheet" href="assets/css/custom.css">
    <link href="assets/king-ui/css/king-ui.css" rel="stylesheet">
    <link href="assets/king-ui/css/animate.css" rel="stylesheet">
    <link href="assets/king-ui/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/king-ui/css/owl.theme.css" rel="stylesheet">
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700' rel='stylesheet' type='text/css'>
    <link href="assets/king-ui/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='assets/king-ui/fonts/FontAwesome.otf' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/king-ui/css/linear-icons.css">

</head>

<body class="header-fixed">
    <div class="wrapper">
        <!--=== Header v6 ===-->
        <?php echo $menu; ?>
        <!--=== End Header v6 ===-->

        <!-- Interactive Slider v2 -->
        <div class="interactive-slider-v2">
            <div class="container">
                <h1>ข้อเสนอดีๆ สำหรับครอบครัวคุณ</h1>
                <p>สะดวก รวดเร็ว มั่นใจ ไร้กังวล ซื้อประกันกับเรา ประหยัดเงินมากกว่า</p>
            </div>
        </div>
        <!-- End Interactive Slider v2 -->

        <!--=== Content ===-->
        <div class="container content-md">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <ul class="nav nav-pills" role="tablist">
                                <li class="active"><a href="#tab1" role="tab" data-toggle="tab" aria-expanded="true"><h4>ประกันรถยนต์</h4></a></li>
                                <li class=""><a href="#tab2" role="tab" data-toggle="tab" aria-expanded="false"><h4>ประกันรถจักรยานยนต์</h4></a></li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane animated fadeIn active" id="tab1">
                                    <div class="col-md-6">
                                        <h1>ประกันรถยนต์</h1>ค้นพบข้อเสนอประกันรถยนต์โดนๆ ซื้อ พ.ร.บ. ต่อประกันรถยนต์ โดยบริษัทประกันภัยชั้นนำมากกว่า 30 บริษัท
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn btn-success btn-rounded btn-block" id="btnCarInsur"><i class="glyphicon glyphicon-search"></i><span><strong>ค้นหาประกันรถยนต์เลย!</strong></span></button>
                                        <div class="box-content">
                                            <p>หรือ</p>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-pill btn-block" id="btnCarPRB"><i class="glyphicon glyphicon-comment"></i><span>ค้นหาเฉพาะ พ.ร.บ</span></button>
                                    </div>
                                </div>
                                <div role="tabpanel" class="tab-pane animated fadeIn" id="tab2">
                                    <div class="col-md-6">
                                        <h2>ประกันรถจักรยานยนต์</h2>ค้นพบข้อเสนอประกันรถจักรยานยนต์โดนๆ โดยบริษัทประกันภัยชั้นนำ
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <button type="button" class="btn btn-success btn-rounded btn-block" id="btnMotoInsur"><i class="glyphicon glyphicon-search"></i><span><strong>ค้นหาประกันรถจักรยานยนต์เลย!</strong></span></button>
                                        <div class="box-content">
                                            <p>หรือ</p>
                                        </div>
                                        <button type="button" class="btn btn-warning btn-pill btn-block" id="btnMotoPRB"><i class="glyphicon glyphicon-comment"></i><span>ค้นหาเฉพาะ พ.ร.บ</span></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <!--=== End Content ===-->
        <!--=== Footer Version 1 ===-->
        <div class="footer-v1">
            <div class="footer">
                <div class="container">
                    <div class="row">
                            <!-- About -->
                            <div class="col-md-3 md-margin-bottom-40">
                                    <a href="index.html"><img id="logo-footer" class="footer-logo" src="assets/img/logo3-light.png" alt=""></a>
                                    <p>About Unify dolor sit amet, consectetur adipiscing elit. Maecenas eget nisl id libero tincidunt sodales.</p>
                                    <p>Duis eleifend fermentum ante ut aliquam. Cras mi risus, dignissim sed adipiscing ut, placerat non arcu.</p>
                            </div><!--/col-md-3-->
                            <!-- End About -->

                            <!-- Latest -->
                            <div class="col-md-3 md-margin-bottom-40">
                                    <div class="posts">
                                            <div class="headline"><h2>Latest Posts</h2></div>
                                            <ul class="list-unstyled latest-list">
                                                    <li>
                                                            <a href="#">Incredible content</a>
                                                            <small>May 8, 2014</small>
                                                    </li>
                                                    <li>
                                                            <a href="#">Best shoots</a>
                                                            <small>June 23, 2014</small>
                                                    </li>
                                                    <li>
                                                            <a href="#">New Terms and Conditions</a>
                                                            <small>September 15, 2014</small>
                                                    </li>
                                            </ul>
                                    </div>
                            </div><!--/col-md-3-->
                            <!-- End Latest -->

                            <!-- Link List -->
                            <div class="col-md-3 md-margin-bottom-40">
                                    <div class="headline"><h2>Useful Links</h2></div>
                                    <ul class="list-unstyled link-list">
                                            <li><a href="#">About us</a><i class="fa fa-angle-right"></i></li>
                                            <li><a href="#">Portfolio</a><i class="fa fa-angle-right"></i></li>
                                            <li><a href="#">Latest jobs</a><i class="fa fa-angle-right"></i></li>
                                            <li><a href="#">Community</a><i class="fa fa-angle-right"></i></li>
                                            <li><a href="#">Contact us</a><i class="fa fa-angle-right"></i></li>
                                    </ul>
                            </div><!--/col-md-3-->
                            <!-- End Link List -->

                            <!-- Address -->
                            <div class="col-md-3 map-img md-margin-bottom-40">
                                    <div class="headline"><h2>Contact Us</h2></div>
                                    <address class="md-margin-bottom-40">
                                            25, Lorem Lis Street, Orange <br />
                                            California, US <br />
                                            Phone: 800 123 3456 <br />
                                            Fax: 800 123 3456 <br />
                                            Email: <a href="mailto:info@anybiz.com" class="">info@anybiz.com</a>
                                    </address>
                            </div><!--/col-md-3-->
                            <!-- End Address -->
                    </div>
                </div>
            </div><!--/footer-->

            <div class="copyright">
                <div class="container">
                        <div class="row">
                                <div class="col-md-6">
                                        <p>
                                                2015 &copy; All Rights Reserved.
                                                <a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a>
                                        </p>
                                </div>

                                <!-- Social Links -->
                                <div class="col-md-6">
                                        <ul class="footer-socials list-inline">
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Facebook">
                                                                <i class="fa fa-facebook"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Skype">
                                                                <i class="fa fa-skype"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Google Plus">
                                                                <i class="fa fa-google-plus"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Linkedin">
                                                                <i class="fa fa-linkedin"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Pinterest">
                                                                <i class="fa fa-pinterest"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Twitter">
                                                                <i class="fa fa-twitter"></i>
                                                        </a>
                                                </li>
                                                <li>
                                                        <a href="#" class="tooltips" data-toggle="tooltip" data-placement="top" title="" data-original-title="Dribbble">
                                                                <i class="fa fa-dribbble"></i>
                                                        </a>
                                                </li>
                                        </ul>
                                </div>
                                <!-- End Social Links -->
                        </div>
                </div>
            </div><!--/copyright-->
        </div>
        <!--=== End Footer Version 1 ===-->
    </div><!--/wrapper-->

	<!--=== Style Switcher ===-->
	<i class="style-switcher-btn fa fa-cogs hidden-xs"></i>
	<div class="style-switcher animated fadeInRight">
		<div class="style-swticher-header">
			<div class="style-switcher-heading">Style Switcher</div>
			<div class="theme-close"><i class="icon-close"></i></div>
		</div>

		<div class="style-swticher-body">
			<!-- Theme Colors -->
			<div class="style-switcher-heading">Theme Colors</div>
			<ul class="list-unstyled">
				<li class="theme-default theme-active" data-style="default" data-header="light"></li>
				<li class="theme-blue" data-style="blue" data-header="light"></li>
				<li class="theme-orange" data-style="orange" data-header="light"></li>
				<li class="theme-red" data-style="red" data-header="light"></li>
				<li class="theme-light" data-style="light" data-header="light"></li>
				<li class="theme-purple last" data-style="purple" data-header="light"></li>
				<li class="theme-aqua" data-style="aqua" data-header="light"></li>
				<li class="theme-brown" data-style="brown" data-header="light"></li>
				<li class="theme-dark-blue" data-style="dark-blue" data-header="light"></li>
				<li class="theme-light-green" data-style="light-green" data-header="light"></li>
				<li class="theme-dark-red" data-style="dark-red" data-header="light"></li>
				<li class="theme-teal last" data-style="teal" data-header="light"></li>
			</ul>

			<!-- Theme Skins -->
			<div class="style-switcher-heading">Theme Skins</div>
			<div class="row no-col-space margin-bottom-20 skins-section">
				<div class="col-xs-6">
					<button data-skins="default" class="btn-u btn-u-xs btn-u-dark btn-block active-switcher-btn handle-skins-btn">Light</button>
				</div>
				<div class="col-xs-6">
					<button data-skins="dark" class="btn-u btn-u-xs btn-u-dark btn-block skins-btn">Dark</button>
				</div>
			</div>

			<hr>

			<!-- Layout Styles -->
			<div class="style-switcher-heading">Layout Styles</div>
			<div class="row no-col-space margin-bottom-20">
				<div class="col-xs-6">
					<a href="javascript:void(0);" class="btn-u btn-u-xs btn-u-dark btn-block active-switcher-btn wide-layout-btn">Wide</a>
				</div>
				<div class="col-xs-6">
					<a href="javascript:void(0);" class="btn-u btn-u-xs btn-u-dark btn-block boxed-layout-btn">Boxed</a>
				</div>
			</div>

			<hr>

			<!-- Theme Type -->
			<div class="style-switcher-heading">Theme Types and Versions</div>
			<div class="row no-col-space margin-bottom-10">
				<div class="col-xs-6">
					<a href="E-Commerce/index.html" class="btn-u btn-u-xs btn-u-dark btn-block">Shop UI <small class="dp-block">Template</small></a>
				</div>
				<div class="col-xs-6">
					<a href="One-Pages/Classic/index.html" class="btn-u btn-u-xs btn-u-dark btn-block">One Page <small class="dp-block">Template</small></a>
				</div>
			</div>

			<div class="row no-col-space">
				<div class="col-xs-6">
					<a href="Blog-Magazine/index.html" class="btn-u btn-u-xs btn-u-dark btn-block">Blog <small class="dp-block">Template</small></a>
				</div>
				<div class="col-xs-6">
					<a href="RTL/index.html" class="btn-u btn-u-xs btn-u-dark btn-block">RTL <small class="dp-block">Version</small></a>
				</div>
			</div>
		</div>
	</div><!--/style-switcher-->
	<!--=== End Style Switcher ===-->

	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
	<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery.parallax.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="assets/js/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="assets/js/app.js"></script>
	<script type="text/javascript" src="assets/js/plugins/style-switcher.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function() {
			App.init();
			StyleSwitcher.initStyleSwitcher();
                        $("#btnCarInsur").click(calCar);
                        
		});
                function calCar(){
                    //alert("aaaaa");
                    window.location.assign('cal_car.php')
                }
	</script>
	<!--[if lt IE 9]>
		<script src="assets/plugins/respond.js"></script>
		<script src="assets/plugins/html5shiv.js"></script>
		<script src="assets/plugins/placeholder-IE-fixes.js"></script>
	<![endif]-->
</body>
</html>
