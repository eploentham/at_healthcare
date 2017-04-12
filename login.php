<!DOCTYPE html>
<?php
//ob_start();
    @session_start();
    $menu = file_get_contents('menu.php',TRUE);
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
    <meta charset="utf-8">
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
    <!--<link href="assets/king-ui/css/king-ui.css" rel="stylesheet">
    <link href="assets/king-ui/css/animate.css" rel="stylesheet">
    <link href="assets/king-ui/css/owl.carousel.css" rel="stylesheet">
    <link href="assets/king-ui/css/owl.theme.css" rel="stylesheet">-->
    
    <!-- CSS Page Style -->
    <link rel="stylesheet" href="assets/css/pages/page_log_reg_v2.css">
    <!-- fonts -->
    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,400italic,700' rel='stylesheet' type='text/css'>
    <link href="assets/king-ui/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href='assets/king-ui/fonts/FontAwesome.otf' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="assets/king-ui/css/linear-icons.css">
</head>

<body class="dark">
	<!--=== Content Part ===-->
	<div class="container">
            <!--Reg Block-->
            <div class="reg-block">
                <div class="reg-block-header">
                    <h2>Sign In</h2>
                    <ul class="social-icons text-center">
                        <li><a class="rounded-x social_facebook" data-original-title="Facebook" href="#"></a></li>
                        <li><a class="rounded-x social_twitter" data-original-title="Twitter" href="#"></a></li>
                        <li><a class="rounded-x social_googleplus" data-original-title="Google Plus" href="#"></a></li>
                        <li><a class="rounded-x social_linkedin" data-original-title="Linkedin" href="#"></a></li>
                    </ul>
                    <p>Don't Have Account? Click <a class="color-green" href="regis.php">Sign Up</a> to registration.</p>
                </div>

                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                    <p id="lopEmail"><input type="text" class="form-control" placeholder="Email" id="loEmail"></p>
                </div>
                <div class="input-group margin-bottom-20">
                    <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    <p id="lopPassword"><input type="password" class="form-control" placeholder="Password" id="loPassword"></p>
                </div>
                <hr>

                <div class="checkbox">
                    <label>
                        <input type="checkbox">
                        <p>Always stay signed in</p>
                    </label>
                </div>

                <div class="row">
                    <div class="col-md-10 col-md-offset-1">
                        <button type="button" class="btn-u btn-block" id="btnLogin">Log In</button>
                    </div>
                    <div id="loading">
                        <img id="logo-footer" class="slick-loading" src="assets/img/ajax-loader.gif" alt="">
                    </div>
                    <div id="divView"></div>
                </div>
            </div>
            <!--End Reg Block-->
	</div><!--/container-->
	<!--=== End Content Part ===-->

	<!-- JS Global Compulsory -->
	<script type="text/javascript" src="assets/plugins/jquery/jquery.min.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery/jquery-migrate.min.js"></script>
	<script type="text/javascript" src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
	<!-- JS Implementing Plugins -->
	<script type="text/javascript" src="assets/plugins/back-to-top.js"></script>
	<script type="text/javascript" src="assets/plugins/smoothScroll.js"></script>
	<script type="text/javascript" src="assets/plugins/jquery.parallax.js"></script>
        <script type="text/javascript" src="assets/plugins/backstretch/jquery.backstretch.min.js"></script>
	<!-- JS Customization -->
	<script type="text/javascript" src="assets/js/custom.js"></script>
	<!-- JS Page Level -->
	<script type="text/javascript" src="assets/js/app.js"></script>
	<script type="text/javascript" src="assets/js/plugins/style-switcher.js"></script>
	<script type="text/javascript">
            jQuery(document).ready(function() {
                //alert('bbbbb');
                App.init();
                //alert('bbbbb');
                hideLoader();
                //$("#btnLogin").click(alert("aaaa"));
                $("#btnLogin").click(login);
                //$("#loEmail").focusout(loginCheckEmail("login_check_email"));
            });
            function showLoader() {
                $("#loading").show();
            }
            function hideLoader() {
                //alert('bbbbb');
                $("#loading").hide();
            }
            function login(){
                //alert("aaaaaaaaaaaaa");
                $.ajax({
                    type: 'GET', url: 'login_check.php', contentType: "application/json", dataType: 'text', 
                    data: {'flagPage': "login"
                        //, 'reUsername':$("#reUsername").val()
                        , 'loEmail':$("#loEmail").val()
                        , 'loPassword':$("#loPassword").val()
                        }
                    ,progress: function(e){
                        showLoader();
                    }
                    ,success: function (data) {
                        //alert('bbbbb '.data);
                        $("#divView").append(data);
                        //$("#divView").append("<br>ขอบคุณสำหรับการสมัครสมาชิก กับManit Insurance <br>โปรดตรวจสอบ email และconfirm ");
                        hideLoader();
                        
                        //if(user!=""){
                            window.location.assign('index.php')
                        //}
                    }
                });
            }
            function loginCheckEmail(flag){
                //alert("aaaa");
                if(flag=="login_check_email"){
                    if ($("#loEmail").val()=="") {
                        return ;
                    }
                }
                $.ajax({
                    type: 'GET', url: 'login_check.php', contentType: "application/json", dataType: 'text', 
                    data: {'flagPage': flag
                        //, 'reUsername':$("#reUsername").val()
                        , 'loEmail':$("#loEmail").val()
                        , 'loPassword':$("#loPassword").val()
                        } 
                    ,progress: function(e){
                        showLoader();
                    }
                    ,success: function (data) {
                        //alert('bbbbb '.data);
                        $("#divView").append(data);
                        //$("#divView").append("<br>ขอบคุณสำหรับการสมัครสมาชิก กับManit Insurance <br>โปรดตรวจสอบ email และconfirm ");
                        hideLoader();
                    }
                });
//                    if($("#rePassword").val() != $("#reCPassword").val()){
//                        alert("Password ไม่ตรงกัน ");
//                        return ;
//                    }
                //alert(flag);
                
            }
	</script>
	<script type="text/javascript">
            $.backstretch([
                "assets/img/bg/31.jpg",
                "assets/img/bg/32.jpg",
                ], {
                        fade: 1000,
                        duration: 7000
                });
	</script>
        <script>
        var focus = 0,
          blur = 0;
        $( "input" )
          .focusout(function() {
              //alert($(this).attr("id"));
            //focus++;
            //$( "#divView" ).text( "focusout fired: " + focus + "x" );
                if ($(this).attr("id")=="loEmail"){
                    loginCheckEmail("login_check_email");
                }else if ($(this).attr("id")=="loPassword"){
                    //loginCheckEmail("login_check");
                }
            
          })
          .blur(function() {
            //blur++;
            //$( "#divView" ).text( "blur fired: " + blur + "x" );
          });
        </script>
	<!--[if lt IE 9]>
	<script src="assets/plugins/respond.js"></script>
	<script src="assets/plugins/html5shiv.js"></script>
	<script src="assets/plugins/placeholder-IE-fixes.js"></script>
	<![endif]-->
</body>
</html>
