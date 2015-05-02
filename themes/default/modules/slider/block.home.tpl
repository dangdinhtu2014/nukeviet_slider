<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/camera.css" media="all"/>
<link rel="stylesheet" href="{NV_BASE_SITEURL}themes/{TEMPLATE}/css/fixcamera.css" media="all"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.mobile-1.0.1.min.js"></script>
<!-- <script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.mobile.customized.min.js"></script> -->
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="{NV_BASE_SITEURL}themes/{TEMPLATE}/js/camera.js"></script>
<script type="text/javascript">
jQuery(function(){
	var myCamera = jQuery('#camera_wrap');
	if (!myCamera.hasClass('motopress-camera')) {
		myCamera.addClass('motopress-camera');
		myCamera.camera({
			alignment: 'topCenter', //topLeft, topCenter, topRight, centerLeft, center, centerRight, bottomLeft, bottomCenter, bottomRight
			autoAdvance: true, //true, false
			mobileAutoAdvance: true, //true, false. Auto-advancing for mobile devices
			barDirection: 'leftToRight', //'leftToRight', 'rightToLeft', 'topToBottom', 'bottomToTop'
			barPosition: 'top', //'bottom', 'left', 'top', 'right'
			cols: 12,
			easing: 'easeOutQuad', //for the complete list http://jqueryui.com/demos/effect/easing.html
			mobileEasing: '', //leave empty if you want to display the same easing on mobile devices and on desktop etc.
			fx: 'simpleFade', //'random','simpleFade', 'curtainTopLeft', 'curtainTopRight', 'curtainBottomLeft',          'curtainBottomRight', 'curtainSliceLeft', 'curtainSliceRight', 'blindCurtainTopLeft', 'blindCurtainTopRight', 'blindCurtainBottomLeft', 'blindCurtainBottomRight', 'blindCurtainSliceBottom', 'blindCurtainSliceTop', 'stampede', 'mosaic', 'mosaicReverse', 'mosaicRandom', 'mosaicSpiral', 'mosaicSpiralReverse', 'topLeftBottomRight', 'bottomRightTopLeft', 'bottomLeftTopRight', 'bottomLeftTopRight'
			//you can also use more than one effect, just separate them with commas: 'simpleFade, scrollRight, scrollBottom'
			mobileFx: '', //leave empty if you want to display the same effect on mobile devices and on desktop etc.
			gridDifference: 250, //to make the grid blocks slower than the slices, this value must be smaller than transPeriod
			height: '37.61%', //here you can type pixels (for instance '300px'), a percentage (relative to the width of the slideshow, for instance '50%') or 'auto'
			imagePath: 'images/', //he path to the image folder (it serves for the blank.gif, when you want to display videos)
			loader: 'no', //pie, bar, none (even if you choose "pie", old browsers like IE8- can't display it... they will display always a loading bar)
			loaderColor: '#ffffff',
			loaderBgColor: '#eb8a7c',
			loaderOpacity: 1, //0, .1, .2, .3, .4, .5, .6, .7, .8, .9, 1
			loaderPadding: 0, //how many empty pixels you want to display between the loader and its background
			loaderStroke: 3, //the thickness both of the pie loader and of the bar loader. Remember: for the pie, the loader thickness must be less than a half of the pie diameter
			minHeight: '50px', //you can also leave it blank
			navigation: true, //true or false, to display or not the navigation buttons
			navigationHover: false, //if true the navigation button (prev, next and play/stop buttons) will be visible on hover state only, if false they will be visible always
			pagination: false,
			playPause: false, //true or false, to display or not the play/pause buttons
			pieDiameter: 33,
			piePosition: 'rightTop', //'rightTop', 'leftTop', 'leftBottom', 'rightBottom'
			portrait: true, //true, false. Select true if you don't want that your images are cropped
			rows: 8,
			slicedCols: 12,
			slicedRows: 8,
			thumbnails: false,
			time: 7000, //milliseconds between the end of the sliding effect and the start of the next one
			transPeriod: 1500, //lenght of the sliding effect in milliseconds

			////////callbacks

			onEndTransition: function() {}, //this callback is invoked when the transition effect ends
			onLoaded: function() {}, //this callback is invoked when the image on a slide has completely loaded
			onStartLoading: function() {}, //this callback is invoked when the image on a slide start loading
			onStartTransition: function() {} //this callback is invoked when the transition effect starts
		});
	}		
 		 
});

 
</script>
<div class="camera_wrap" id="camera_wrap">
	<!-- BEGIN: loop -->
    <div data-src="{ROW.images}" data-thumb="{ROW.images}">
		<div class="camera_caption fadeFromBottom">
            <h2>
				<a href="{ROW.link}" title="{ROW.title}">{ROW.title}</a>
			</h2>
        </div>
	</div>
    <!-- END: loop -->
</div>
 
<!-- END: main -->

