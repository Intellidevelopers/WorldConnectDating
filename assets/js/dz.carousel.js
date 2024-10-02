/** 	=========================
	Template Name 	 : Dating Kit
	Author			 : WorldConnect
	Version			 : 1.0
	File Name		 : custom.js
	Author Portfolio : https://themeforest.net/user/WorldConnect/portfolio

	Core script to handle the entire theme and core functions
**/

/* JavaScript Document */
jQuery(document).ready(function() {
    'use strict';
	
    // Get Started ==========
    if(jQuery('.get-started').length > 0){
		var swiperGetStarted = new Swiper('.get-started', {
			speed: 1500,
			slidesPerView: "auto",
			spaceBetween: 0,
			autoplay: {
			   delay: 1500,
			},
			loop:false,
			pagination: {
                el: ".swiper-pagination",
                clickable: true,
			},
		});
	}
	
	if(jQuery('.filter-swiper').length > 0){
		var swiperFilterSwiper = new Swiper('.filter-swiper', {
			speed: 500,
			slidesPerView: "auto",
			spaceBetween: 12,
			loop: false,
		});
	}
	
	if(jQuery('.chat-swiper').length > 0){
		var chatSwiper = new Swiper('.chat-swiper', {
			speed: 500,
			slidesPerView: 4.5,
			spaceBetween: 15,
			loop: false,
		});
	}
	
	if(jQuery('.subscription-swiper').length > 0){
		var subscriptionSwiper = new Swiper('.subscription-swiper', {
			speed: 500,
			slidesPerView: 1,
			spaceBetween: 15,
			loop: false,
			pagination: {
                el: ".swiper-pagination",
                clickable: true,
			},
		});
	}
	
	if(jQuery('.subscription-swiper2').length > 0){
		var subscriptionSwiper2 = new Swiper('.subscription-swiper2', {
			speed: 500,
			slidesPerView: 1,
			spaceBetween: 15,
			loop: false,
			pagination: {
                el: ".swiper-pagination",
                clickable: true,
			},
		});
		subscriptionSwiper2.on('transitionEnd', function() {
		  var swiperSelector = $('.subscribe-content');
		  swiperSelector.addClass('d-none');
		  if(subscriptionSwiper2.realIndex == 0){
			  $('#plus').removeClass('d-none');
		  }
		  if(subscriptionSwiper2.realIndex == 1){
			  $('#gold').removeClass('d-none');
		  }
		  if(subscriptionSwiper2.realIndex == 2){
			  $('#platinum').removeClass('d-none');
		  }
		  
		});
	}

	if(jQuery('.package-swiper').length > 0){
		var packageSwiper = new Swiper('.package-swiper', {
			speed: 500,
			slidesPerView: 2.3,
			spaceBetween: 15,
			loop: true,
			autoplay: {
				delay: 1500,
			},
		});
	}

	if(jQuery('.tag-swiper').length > 0){
		var tagSwiper = new Swiper('.tag-swiper', {
			speed: 500,
			slidesPerView: "auto",
			spaceBetween: 10,
			loop:false,
			autoplay: {
				delay: 2000,
			},
		});
	}

	if(jQuery('.client-swiper').length > 0){
		var clientSwiper = new Swiper('.client-swiper', {
			speed: 500,
			slidesPerView: 1.5,
			spaceBetween: 15,
			loop: false,
			autoplay: {
				delay: 3000,
			},
		});
	}
	
	// Reels Swiper ==========
	if(jQuery('.media-swiper').length > 0){
		var swiper = new Swiper(".media-swiper",{
			direction: "vertical",
			slidesPerView: 1,
			mousewheel: true,
		});
	}

});
/* Document .ready END */