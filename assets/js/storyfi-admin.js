(function ($) {
  'use strict';

  jQuery(document).ready(function($) {
    jQuery('.post-type-storyfi #publish.button').on('click', function(event) {
        var numOfItems = jQuery('.cmb-repeatable-group .cmb-row').length;
        if (numOfItems <= 13) {
            alert('Please make sure there are more than 3 items.');
            event.preventDefault(); // Prevent form submission
        }
    });
	});
	
} (jQuery) );