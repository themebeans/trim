// IF JS IS ENABLED, REMOVE 'no-js' AND ADD 'js' CLASS
jQuery('html').removeClass('no-js').addClass('js');

var Bean_Isotope = Bean_Isotope || {};
Bean_Isotope.callAfterNewElements = [];

jQuery(document).ready(function($) {

	//FITVIDS
	$("body").fitVids();

	$('.content-wrapper').css("margin-top", $("#masthead").outerHeight());

	$(window).resize(function() {
		$('.content-wrapper').css("margin-top", $("#masthead").outerHeight());
	}).resize();

	//RESPONSIVE MENU
	$('#mobile-nav').meanmenu();

	//FORM VALIDATION
	if (jQuery().validate) { jQuery("#commentform").validate(); }

	//DROPDOWNS - SUPERFISH
	$('nav ul')
		.superfish({
    		delay: 100,
    		animation: { opacity:'show', height:'show' },
    		speed: 150,
    		cssArrows: false,
    		disableHI: true
	});

	//MASONRY SCRIPT
	var $container = $('#masonry-container');

	$container.imagesLoaded(function(){
		$container.masonry({
			columnWidth:".grid-width",
			gutter:".gutter-width",
			itemSelector: '#masonry-container article',
			transitionDuration:"0.2s",
		});
	});

	//INFINITE SCROLLING
	$(function(){
		$container.infinitescroll({
			navSelector  : '#page_nav',
			nextSelector : '#page_nav a',
			itemSelector : 'article',
			loading: {
				loadingText: 'Loading',
				finishedMsg: 'Done Loading',
				img: ''
			}
		},

		function( newElements ) {
			var $newElems = $( newElements ).css({ opacity: 0 });

			$newElems.imagesLoaded(function(){
				// show elems now they're ready
				$newElems.animate({ opacity: 1 });
				$newElems.addClass('loaded');
				$container.masonry( 'appended', $newElems, true );
				$('.format-video').fitVids($newElems);
				$('.flexslider').flexslider({
					namespace: "bean-",
					animation: "fade",
					slideshow: true,
					animationLoop: true,
					directionNav: true,
					controlNav: true,
					smoothHeight: false,
					touch: true,
					prevText: "",
					nextText: "",
					start: function (slider) {
						if (typeof slider.container === 'object') {
							slider.container.click(function (e) {
								if (!slider.animating) {
									slider.flexAnimate(slider.getTarget('next'));
								}
							});
						}
					}
				});

			});


			//CALL FUNCTIONS IN Bean_Isotope.callAfterNewElements
			for(var i = 0; i < Bean_Isotope.callAfterNewElements.length; i++) {
				Bean_Isotope.callAfterNewElements[i].call();
			}
		});
	});

	//GRID INIT
	Bean_Likes.Bean_Likes_Init();
	Bean_Media.setupAudioPosts();

	Bean_Isotope.callAfterNewElements.push(Bean_Likes.Bean_Likes_Init);
	Bean_Isotope.callAfterNewElements.push(Bean_Media.setupAudioPosts);

	//POSTS FILTER
	if($('body').length){
		var posts = $('body');
		posts.find('#filter li a').on('click', function(){
			posts.find('#filter li a').removeClass('active');
			$(this).addClass('active');
			var selector = $(this).attr('data-filter');
			posts.find('.filtered').addClass('inactive');
			posts.find(selector).removeClass('inactive');
			return false;
		});
	}

	//CONTACT FORM
	$('#BeanForm input#contactName').attr('placeholder', trim_L10n.name );
	$('#BeanForm input#email').attr('placeholder', trim_L10n.email);
	$('#BeanForm textarea#commentsText').attr('placeholder', trim_L10n.message);

	//COMMENTS FORM
	$('#respond.comment-respond input#author').attr('placeholder', trim_L10n.comments_name );
	$('#respond.comment-respond input#email').attr('placeholder', trim_L10n.comments_email );
	$('#respond.comment-respond input#url').attr('placeholder', trim_L10n.comments_url );
	$('#respond.comment-respond textarea#comment').attr('placeholder',  trim_L10n.comments_text );

	//PORTFOLIO FILTER
	$("#filter-toggle").click(function() {
		$("#portfolio-filter").addClass("open");
	});

	$("#filter li a").click(function() {
		$("#portfolio-filter").removeClass("open");
	});

	$('#filter-toggle').hover(
     	function(){ $(this).addClass('hover') },
     	function(){ $(this).removeClass('hover') }
	);

	//FLYOUT SIDEBAR
	$( "#nav-toggle, .sidebar-close" ).click( function(e) {
		$( ".content-wrapper" ).toggleClass( "open" );
		$( "#hidden-sidebar" ).toggleClass( "open" );
		$( "#nav-toggle" ).toggleClass( "active" );
		return false;
	} );

});


jQuery(window).load(function() {
	timer = setInterval(function(){
		$notLoaded = jQuery("#masonry-container .post").not(".loaded");
		$notLoaded.eq(Math.floor(Math.random()*$notLoaded.length)).fadeIn().addClass("loaded");
		if ($notLoaded.length == 0) { clearInterval(timer); }
	}, 50);
});


//BEAN LIKES FUNCTIONS
var Bean_Likes = {
	Bean_Reload_Likes: function(who) {
	var text = jQuery("#" + who).html();
	var patt= /(\d)+/;

	var num = patt.exec(text);
	num[0]++;
	text = text.replace(patt,num[0]);
	jQuery("#" + who).html('<span class="count">' + text + '</span>');
	},

	Bean_Likes_Init: function() {
	jQuery(".bean-likes").click(function() {
		var classes = jQuery(this).attr("class");
		classes = classes.split(" ");

		if(classes[1] == "active") {
			return false;
		}
		var classes = jQuery(this).addClass("active");
		var id = jQuery(this).attr("id");
		id = id.split("like-");
		jQuery.ajax({
		  type: "POST",
		  url: "index.php",
		  data: "likepost=" + id[1],
		  success: Bean_Likes.Bean_Reload_Likes("like-" + id[1])
		});
		return false;
	});
	}
};


// FUNCTIONS FOR HANDLING POSTS OF TYPE 'AUDIO' AND 'VIDEO'
var Bean_Media = {
	setupAudioPosts: function() {

		if(jQuery().jPlayer) {
			jQuery(".jp-audio").each(function() {
				var mp3 = jQuery(this).data("file");
				var cssSelectorAncestor = '#' + jQuery(this).attr("id");

				jQuery(this).find(".jp-jplayer").jPlayer( {
					ready : function () {
							jQuery(this).jPlayer("setMedia", {
							mp3: mp3,
							end: ""
						});
					},
					size: {
					    width: "100%",
					},
					swfPath: WP_TEMPLATE_DIRECTORY_URI[0] + "/assets/js",
					cssSelectorAncestor: cssSelectorAncestor,
					supplied: (mp3 ? "mp3": "") + ", all"
				});
			});
		}
		jQuery(".jp-audio .jp-interface").css("display", "block");
	}
};