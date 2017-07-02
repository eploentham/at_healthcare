<?php require_once("inc/init.php"); ?>
<div class="row">
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i> UI Elements <span>>
			General Elements </span></h1>
	</div>
	<div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
		<ul id="sparks" class="">
			<li class="sparks-info">
				<h5> My Income <span class="txt-color-blue">$47,171</span></h5>
				<div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
					1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Traffic <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;45%</span></h5>
				<div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
			<li class="sparks-info">
				<h5> Site Orders <span class="txt-color-greenDark"><i class="fa fa-shopping-cart"></i>&nbsp;2447</span></h5>
				<div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
					110,150,300,130,400,240,220,310,220,300, 270, 210
				</div>
			</li>
		</ul>
	</div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->
	

	<!-- end row -->

	<!-- row -->
	<div class="row">

		<!-- NEW WIDGET START -->
		<article class="col-sm-12">

			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-x" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" data-widget-fullscreenbutton="false" data-widget-custombutton="false" data-widget-sortable="false">
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
					<span class="widget-icon"> <i class="fa fa-align-justify"></i> </span>
					<h2>Standard Progress Bars </h2>

				</header>

				<!-- widget div-->
				<div>

					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->

					</div>
					<!-- end widget edit box -->

					<!-- widget content -->
					<div class="widget-body">


						<div class="row">

							<div class="col-sm-12">

							<div class="row">								
                                                            <div class="col-sm-6">
                                                                
                                                                <div class="well no-padding">
                                                                    <div class="bar-holder">
                                                                            <div class="progress">
                                                                                    <div class="progress-bar bg-color-teal" data-transitiongoal="25"></div>
                                                                            </div>
                                                                    </div>

                                                                </div>
                                                            </div>

                                                        </div>
							</div>

						</div>
					</div>
					<!-- end widget body-->

				</div>
				<!-- end widget content -->

			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->

	</div>

	<!-- end row -->


	<!-- end row -->


	<!-- end row -->

	<!-- start row -->


	<!-- end row -->

	<!-- start row -->


	<!-- end row -->

	<!-- start row -->

	<!-- end row-->

	<!-- start row -->
	
	<!-- end row -->

	<!-- end row -->

	<!-- end row -->

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

	// PAGE RELATED SCRIPTS



	// pagefunction
	
	var pagefunction = function() {

		/*
		 * Autostart Carousel
		 */
		$('.carousel.slide').carousel({
			interval : 3000,
			cycle : true
		});
		$('.carousel.fade').carousel({
			interval : 3000,
			cycle : true
		});
		
		// Fill all progress bars with animation
		$('.progress-bar').progressbar({
			display_text : 'fill'
		});

		/*
		 * Smart Notifications
		 */

	
		/*
		* SmartAlerts
		*/
		
		// With Callback
		

		
		// With Input

		
		// With Select
		
	
		// With Login
		
		
	};
	
	// end pagefunction
	
	// load bootstrap-progress bar script and run pagefunction
	loadScript("js/plugin/bootstrap-progressbar/bootstrap-progressbar.min.js", pagefunction);

</script>
