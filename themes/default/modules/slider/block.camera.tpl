<!-- BEGIN: main -->

<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/camera/camera.css"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/camera/jquery.mobile.customized.min.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/camera/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/camera/camera.min.js"></script>
<div class="art-slider">
    <div class="slider">
        <div class="camera_wrap camera_azure_skin" id="camera_wrap_1">
            <!-- BEGIN: loop -->
			<div data-thumb="{DATA.thumb}" data-src="{DATA.image}"></div>
            <!-- END: loop --> 
        </div>
    </div>
</div>
<script type="text/javascript">
//<![CDATA[
$(document).ready(function() {
	$('#camera_wrap_1').camera({
		thumbnails: false,
		height: '355px',
		loader: false
	});

});
//]]>
</script>
<!-- END: main --> 