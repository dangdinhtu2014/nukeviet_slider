<!-- BEGIN: main -->

<link rel="stylesheet" type="text/css" href="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/sequence/sequence.css"/>
<script type="text/javascript" src="{NV_BASE_SITEURL}modules/{MOD_FILE}/plugins/sequence/jquery.sequence-min.js"></script>
<div id="sequence-theme">
    <div id="sequence">

        <ul class="controls">
            <li><a class="sequence-prev">Prev</a>
            </li>
            <li><a class="sequence-next">Next</a>
            </li>
        </ul>


        <ul class="sequence-canvas">
			<!-- BEGIN: loop -->
            <li class="animate-in slider2">
                <h2 class="title-slider2">{DATA.title}</h2>
                <h3 class="subtitle-slider2">{DATA.title}</h3>
                <div class="intro subtitle">{DATA.title}</div>
                <img class="slider-bg" src="{DATA.background}" alt="{DATA.title}" />
                <img class="model-slider2" src="{DATA.image}" alt="{DATA.title}" />
                <div class="link-slider2 subtitle-slider2">
                    <a href="{DATA.link}">{READMORE}</a>
                </div>
            </li>
			<!-- END: loop -->
        </ul>
    </div>
</div>

<script type="text/javascript">
    //<![CDATA[
    $(document).ready(function() {
         var options = {
            autoPlay: false,
            autoPlayDelay: 6000,
            pauseOnHover: false,
            hidePreloaderDelay: 500,
            nextButton: true,
            prevButton: true,
            pauseButton: true,
            preloader: true,
            pagination: true,
            hidePreloaderUsingCSS: false,
            animateStartingFrameIn: true,
            navigationSkipThreshold: 750,
            preventDelayWhenReversingAnimations: true,
            customKeyEvents: {
                80: "pause"
            }
        };

        var sequence = $("#sequence").sequence(options).data("sequence");


    });
    //]]>
</script>
<!-- END: main --> 