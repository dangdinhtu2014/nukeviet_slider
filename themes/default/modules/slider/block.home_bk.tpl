<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{module_file}/slide/default/default.css" type="text/css" media="screen" />
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{module_file}/slide/nivo-slider.css" type="text/css" media="screen" />

<div class="slider-wrapper theme-default">
	<div id="slider" class="nivoSlider">
		<!-- BEGIN: loop -->
			<a href="{ROW.link}" title="{ROW.title}"><img alt="{ROW.title}" src="{ROW.images}" title="{ROW.title}" width="{ROW.width}" height="{ROW.height}"/></a>
		<!-- END: loop -->  
	</div>
</div>
<div class="clear"></div>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/images/{module_file}/jquery.nivo.slider.js"></script>
<script type="text/javascript">
    jQuery(window).load(function() {

		jQuery('#slider').nivoSlider({
		        effect:'fade',
		        pauseTime:'3000',
		        boxCols: 8, // For box animations
		        boxRows: 3, // For box animations
		        controlNav:false,
		        directionNav:false,
		       captionOpacity:0.8
		     });
		});
</script>

<!-- END: main -->

