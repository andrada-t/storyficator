/*
 Project name:       MODELTHEME
 Project author:     ModelTheme
 File name:          Custom JS
*/
(function ($) {
    'use strict';
    jQuery(document).ready(function() {
        jQuery(".story-bubbles a").click(function() {
            jQuery("#storyfi-modal").addClass("open-carousel");
        });

        jQuery(".close").click(function() {
            jQuery("#storyfi-modal").removeClass("open-carousel");
        });

        jQuery(window).click(function(event) {
            if ($(event.target).is("#storyfi-modal")) {
                jQuery("#storyfi-modal").removeClass("open-carousel");
            }
        });

        var time = 5;
        var $bar, $slider, isPause, tick, percentTime;

        $slider = jQuery(".story-container");
        $slider.flickity({
            wrapAround: true
        });

        $bar = jQuery(".slider-progress .progress");

        jQuery(".story-item > img").on({
            mouseover: function () {
                isPause = true;
            },
            mouseleave: function () {
                isPause = false;
            }
        });

        function startProgressbar() {
            resetProgressbar();
            percentTime = 0;
            isPause = false;
            tick = setInterval(interval, 10);
        }

        function interval() {
            if (isPause === false) {
            percentTime += 1 / (time + 0.1);
            $bar.css({
                width: percentTime + "%"
            });
            if (percentTime >= 100) {
                $slider.flickity("next", true);
                startProgressbar();
            }
        }
    }

    function resetProgressbar() {
        $bar.css({
            width: 0 + "%"
        });
        clearTimeout(tick);
    }

    startProgressbar();
});

} (jQuery) )