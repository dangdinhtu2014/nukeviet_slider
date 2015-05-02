<!-- BEGIN: main -->
<link rel="stylesheet" href="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/bxslider/jquery.bxslider.css" media="all"/>

<div id="nvslider">
    <ul  class="bxslider">
		<!-- BEGIN: loop -->
        <li>
            <a href="{DATA.link}" title="{DATA.title}">
                <img alt="{DATA.title}" src="{DATA.image}" title="{DATA.title}"  />
            </a>
        </li>
		<!-- END: loop -->
	</ul>
</div>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/bxslider/jquery.bxslider.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.bxslider').bxSlider({adaptiveHeight: true, mode: 'vertical'});
});
</script>
<!-- END: main -->

