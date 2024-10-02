var W3DatingKitUiSlider = function(){
	
	"use strict"
	
	/* Range ============ */
	var rangeslider = function(){
		
		function priceRangeSlider(elementId) {
			if($("#"+elementId).length > 0 ) {
				var tooltipSlider = document.getElementById(elementId);
				
				var formatForSlider = {
					from: function (formattedValue) {
						return Number(formattedValue);
					},
					to: function(numericValue) {
						return Math.round(numericValue);
					}
				};

				noUiSlider.create(tooltipSlider, {
					start: [18, 50],
					connect: true,
					format: formatForSlider,
					tooltips: [wNumb({decimals: 1}), true],
					range: {
						'min': 18,
						'max': 100
					}
				});
				
				tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
					jQuery("#"+elementId).parent().find('.slider-margin-value-min').html("Between " + values[0]);
					jQuery("#"+elementId).parent().find('.slider-margin-value-max').html("and " + values[1]);
				});
			}
		}
		priceRangeSlider("slider-tooltips");
	}
	/* Range ============ */
	var rangeslider2 = function(){
		
		function priceRangeSlider(elementId) {
			if($("#"+elementId).length > 0 ) {
				var tooltipSlider = document.getElementById(elementId);
				
				var formatForSlider = {
					from: function (formattedValue) {
						return Number(formattedValue);
					},
					to: function(numericValue) {
						return Math.round(numericValue);
					}
				};

				noUiSlider.create(tooltipSlider, {
					start: 18,
					connect: [true, false],
					format: formatForSlider,
					range: {
						'min': 18,
						'max': 100
					}
				});
				
				tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
					jQuery("#"+elementId).parent().find('.slider-margin-value-min').html("Up to  " + values + " kilometers only");
				});
			}
		}
		priceRangeSlider("slider-tooltips2");
	}
	/* Range ============ */
	var rangeslider3 = function(){
		
		function priceRangeSlider(elementId) {
			if($("#"+elementId).length > 0 ) {
				var tooltipSlider = document.getElementById(elementId);
				
				var formatForSlider = {
					from: function (formattedValue) {
						return Number(formattedValue);
					},
					to: function(numericValue) {
						return Math.round(numericValue);
					}
				};

				noUiSlider.create(tooltipSlider, {
					start: 18,
					connect: [true, false],
					format: formatForSlider,
					range: {
						'min': 18,
						'max': 100
					}
				});
				
				tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
					jQuery("#"+elementId).parents('.card').find('.slider-margin-value-min').html(values + "ml");
				});
			}
		}
		priceRangeSlider("slider-tooltips3");
	}
	
	/* Range ============ */
	var rangeslider4 = function(){
		
		function priceRangeSlider(elementId) {
			if($("#"+elementId).length > 0 ) {
				var tooltipSlider = document.getElementById(elementId);
				
				var formatForSlider = {
					from: function (formattedValue) {
						return Number(formattedValue);
					},
					to: function(numericValue) {
						return Math.round(numericValue);
					}
				};

				noUiSlider.create(tooltipSlider, {
					start: [18, 50],
					connect: true,
					format: formatForSlider,
					tooltips: [wNumb({decimals: 1}), true],
					range: {
						'min': 18,
						'max': 100
					}
				});
				
				tooltipSlider.noUiSlider.on('update', function (values, handle, unencoded) {
					jQuery("#"+elementId).parents('.card').find('.slider-margin-value-min').html(values[0]);
					jQuery("#"+elementId).parents('.card').find('.slider-margin-value-max').html(" - " + values[1]);
				});
			}
		}
		priceRangeSlider("slider-tooltips4");
	}
	/* Function ============ */
	return{
		
		init:function(){
			rangeslider();
			rangeslider2();
			rangeslider3();
			rangeslider4();
		},
		
		load:function(){
			
		},
		
		resize:function(){
			
		},
		
	}

}();

/* Document.ready Start */	
jQuery(document).ready(function() {
	'use strict';
	W3DatingKitUiSlider.init();
});
/* Document.ready END */

/* Window Load START */
jQuery(window).on('load',function () {
	'use strict'; 
	W3DatingKitUiSlider.load();
});
/*  Window Load END */

/* Window Resize START */
jQuery(window).on('resize',function () {
	'use strict'; 
	W3DatingKitUiSlider.resize();
});
/*  Window Resize END */