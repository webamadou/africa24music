
/*costum register */

jQuery(document).ready(function($){

	function isValidEmailAddress(emailAddress) {
	    var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
	    return pattern.test(emailAddress);
	};
	
	jQuery('#user_email-144').focusout(function(){
		var email = jQuery('#user_email-144').val();
		if (!isValidEmailAddress(email)) {
			jQuery('#user_email-144').css('background', '#999');
			jQuery('.um-field-error.custom').remove();
			jQuery('#user_email-144').after(' <div class="um-field-error custom"></div>');
			jQuery('.um-field-error.custom').html('Votre email est incorrect. Merci de vérifier les informations saisies');
			jQuery('input[type="submit"]').prop('disabled', true);
		}

		else{
			//jQuery('input[type="submit"]').prop('disabled', false);
			jQuery('#user_email-144').css('background', '');
			jQuery('.um-field-error.custom').remove();
		}
		;
	});

	jQuery('#user_login-144').focusout(function(){
		var login = jQuery('#user_login-144').val();
		if(login == ''){
			jQuery('#user_login-144').css('background', '#999');
			jQuery('.um-field-error.custom').remove();
			jQuery('#user_login-144').after(' <div class="um-field-error custom"></div>');
			jQuery('.um-field-error.custom').html('Champ est obligatoire');
			jQuery('input[type="submit"]').prop('disabled', true);
		}
		else{
			//jQuery('input[type="submit"]').prop('disabled', false);
			jQuery('#user_login-144').css('background', '');
			jQuery('.um-field-error.custom').remove();
		}
	});

	jQuery('#confirm_user_password-144').focusout(function(){
		var champ1 = jQuery('#user_password-144').val();
		var champ2 = jQuery('#confirm_user_password-144').val();
		if(champ1 != champ2){
			jQuery('.um-field-error.custom').remove();
			jQuery('#confirm_user_password-144').after(' <div class="um-field-error custom"></div>');
			jQuery('.um-field-error.custom').html('Vos mots de passe ne correspondent pas');
			jQuery('input[type="submit"]').prop('disabled', true);

		}
		else{

			jQuery('.um-field-error.custom').remove();
			jQuery('input[type="submit"]').prop('disabled', false);
		}
	});
});

// **************** slider *********************//
sliderint =  1;
sliderNext = 2 ;

jQuery(document).ready(function($){
	$('a[href="#"]').click(function(e){ e.preventDefault() ; });
	$(".slider-cadre .slider li#slide1").slideDown(1000);
	$('.slider-bullet .bullets-list li#bullet1').addClass('active') ;
	startSlider();
});

function startSlider(){
	count = jQuery(".slider-cadre .slider li").size();

	loop = setInterval(function(){
		
		if(sliderNext>count){
				sliderNext = 1 ;
				sliderint = 1 ;
			}
			jQuery(".slider-cadre .slider li").fadeOut(1000) ;
			jQuery('.slider-bullet .bullets-list li').removeClass('active') ;
			jQuery(".slider-cadre .slider li#slide"+sliderNext).fadeIn(900);
			jQuery('.slider-bullet .bullets-list li#bullet'+sliderNext).addClass('active') ;
			sliderint = sliderNext;
			sliderNext = sliderNext+1;
		}, 5000)
}

function prev(){
	newSlide = sliderint - 1;
	showSlide(newSlide) ;
}

function next(){
	newSlide = sliderint + 1;
	showSlide(newSlide) ;
}

function showSlide(id){//Fonction pour less boutton prev et next
	stopLoop() ;
	if(id>count){
		id = 1;
	}else if(id < 1){
		id = count;
	}
	jQuery(".slider-cadre .slider li").fadeOut(1000) ;
	jQuery('.slider-bullet .bullets-list li').removeClass('active') ;
	jQuery(".slider-cadre .slider li#slide"+id).fadeIn(1000) ;
	jQuery('.slider-bullet .bullets-list li#bullet'+id).addClass('active') ;
	sliderint = id;
	sliderNext = id+1;
}
function stopLoop(){
	window.clearInterval(loop) ;
}
jQuery(".slider-cadre .slider li").hover(
	function(){stopLoop() ;},function(){startSlider() ;}
);
jQuery('.slider-bullet .bullets-list li').click(function(e){
	e.preventDefault() ;
	var id = jQuery(this).attr('rel') ;
	showSlide(id) ;
});
/** ==========================carousel============================ */
jQuery(document).ready(function($) {
    // $('#carousel_ul li:first').before($('#carousel_ul li:last')); 
      
    $('#right_scroll img').click(function(){
          var item_width = $('#carousel_ul li').outerWidth() - 10;
          var left_indent = parseInt($('#carousel_ul').css('left')) - item_width;

          $('#carousel_ul:not(:animated)').animate(
                                        {'left' : left_indent},
                                        100,
                                        "linear",
                                        function(){
              								$('#carousel_ul li:last').after($('#carousel_ul li:first'));
              								$('#carousel_ul').css({'left' : '0px'}); 
              							}
          ); 
    });
    $('#left_scroll img').click(function(){
		var item_width = $('#carousel_ul li').outerWidth() + 10;
		var left_indent = parseInt($('#carousel_ul').css('left')) + item_width;

		$('#carousel_ul:not(:animated)').animate(
		                                {'left' : left_indent},
		                                100,
		                                "linear",
		                                function(){
		                                	$('#carousel_ul li:first').before($('#carousel_ul li:last')); 
		                                	$('#carousel_ul').css({'left' : '0px'}); 
		                                });

    });
});
/** ==========================slider videos similaires============================ *
jQuery(document).ready(function($) {
      $('#similaires .slide-similaire .video:first').before($('#similaires .slide-similaire .video:last'));
      //when user clicks for sliding left        
      $('#similaires .slider-arrows.left').click(function(){
		var item_width = $('#similaires .slide-similaire .video').outerWidth() - 10;
		var left_indent = parseInt($('#similaires').css('left')) - item_width;

		$('#similaires:not(:animated)').animate({'left' : left_indent},100,function(){
		  $('#similaires .slide-similaire .video:last').after($('#similaires .slide-similaire .video:first'));
		  $('#similaires').css({'left' : '0px'});
		});
      });
      //when user clicks for sliding right        
      $('#similaires .slider-arrows.right').click(function(){
		var item_width = $('#similaires .slide-similaire .video').outerWidth() + 10;
		var left_indent = parseInt($('#similaires').css('left')) + item_width;

		$('#similaires:not(:animated)').animate({'left' : left_indent},100,function(){
		  $('#similaires .slide-similaire .video:last').after($('#similaires .slide-similaire .video:first'));
		  $('#similaires').css({'left' : '0px'});
		});
      });
});
/* 	==========================JQUERY ======================= */
jQuery(document).ready(function($){
	var frame = document.getElementsByTagName("iframe")[1];
	var att = document.createAttribute("allowscriptaccess");
	att.value = "always";
	if(frame!= undefined)
		frame.setAttributeNode(att) ;

	$('.trigger-menu').click(function (e) {
		e.preventDefault() ;
		$('.social-menu.social-vertical').toggle('slide', 'right',400, 'ease-in-out') ;
		$('.sticky-menu-bar').toggle('slide', 'right', 400, 'ease-in-out' ) ;
	});
	$('.trigger-mobile-menu').click(function (e) {
		e.preventDefault() ;
		$('.mobile-menu').toggleClass('active') ;
	});
	$('.toggle-live, #toggle-live').click(function(){
		/*$('#live-cadre').toggle('slide', 'right', 400, 'ease-in-out') ;
		$('.live-button').toggle('slide', 'right',400, 'ease-in-out') ;*/
		BootstrapDialog.show({
            message: '<div class="embed-container"><iframe id="popup-youtube-player"  src="https://www.youtube.com/embed/ScZl7MSAJcM?list=PLZ8z5gzqVWe-j1xzo-5Z44uMtNGEq2cvg&loop=1&ref=0&autoplay=1&index='+Math.floor((Math.random() * 10) + 1)+'" frameborder="0" allowfullscreen allowscriptaccess="always"></iframe></div>',
            cssClass: 'live-modal',
            size: BootstrapDialog.SIZE_WIDE,
        });
	    // var func = ($("#live-cadre").css('display') == 'none')?'playVideo':'pauseVideo' ;
		frame.contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
	});
	$('.top-fan').hover(function(e){
		$('.top-fan h1').animate({opacity: 0 }, 300) ;
	},function(a){
			$('.top-fan h1').animate({opacity: 1 }, 800);
	});

	$( function() {$( "#live-cadre" ).draggable(); });
	$(function() {$( "#live-cadre" ).resizable(); });
	$('.home-timeline-menu ul li').click(function(e){
		e.preventDefault() ;
		$('.home-timeline-menu ul li').removeClass('active') ;
		$(this).addClass('active') ;
		var item 	= $(this).attr('rel') ;
		var color 	= $(this).attr('color') ;
		$('.home-timeline').removeClass('active') ;
		$('#'+item).addClass('active') ;
		$('.home-timeline-menu ul').css('border-bottom-color', color) ;
	});
	
	$('.filter-menu li').click(function(e) {
		var item = $(this).attr('target-link') ;
		$( '.liste' ).each( function(){
			var iditem = $(this).attr('id') ;
			// alert(iditem) ;
			if(iditem == item){
				// alert('it s the same') ;
				$('#'+iditem).toggle() ;
				$('li[target-link="'+iditem+'"]').toggleClass('active') ;
			}else{
				$('li[target-link="'+iditem+'"]').removeClass('active') ;
				$(this).hide() ;
			}
		});
		// $('#'+item).slideToggle( 100 ) ;
	} );
	/*setting up youtube vido's size*/

});
/* 	========================== LIVE AUTO SCROOL ======================= */
jQuery('.live_scrool a').click(function(e){
	e.preventDefault() ;
	var div = jQuery(this).attr('href') ;
	var offup = jQuery(div).offset().top - 180;
	jQuery('html,body').animate({scrollTop: offup },1500) ;
});
/* 	========================== COMMENT AUTO SCROOL ======================= */
jQuery('.scrool-comments a').click(function(e){
	e.preventDefault() ;
	var div = jQuery('#respond') ;
	if(div != undefined){
		var offup = div.offset().top - 180;
		jQuery('html,body').animate({scrollTop: offup },1500) ;
	}
});
/* 	========================== trigger search in menu ======================= */
jQuery('.trigger-search').click(function(e){
	e.preventDefault() ;
	jQuery('.search-box').toggle('slide', 'right',400, 'ease-in-out') ;

});
/* 	========================== Minimum char nbr to search ======================= */
jQuery('form[role="search"]').submit(function(e,$){
	var form = jQuery(this).attr('id') ;
	var searchValue = jQuery.trim(jQuery('form#'+form+' input[name="s"]').val());
	if(searchValue.length < 3){
		e.preventDefault() ;
	}
});
/* 	========================== search result tab options ======================= */

jQuery('#categs-list li a').click(function(e) {
    e.preventDefault() ;
    var target = jQuery(this).attr('target') ;
    jQuery('#search-result-id ul').each(function(a){
    	var itemId = jQuery(this).attr('id') ;
        if(itemId != 'list_'+target && target != 'all'){
            jQuery(this).hide("slide", { direction: "right" }, 300);
        } else if(target == 'all') {
            jQuery(this).show("slide", { direction: "left" }, 300);
            jQuery('ul .shadow').removeClass('lightedup') ;
        } else {
            jQuery(this).show("slide", { direction: "left" }, 300);
            /*if(target != 'all'){
        		jQuery('ul#list_'+target+' li:nth-child(4) ~ li').toggle('fade','up',500) ;
            }*/
        }
    });
})
/* 	========================== Set title font size by text legth ======================= */
function setSizeByLength(domElement){
	var that = jQuery(domElement);
	if(that.length){
		var textLength = that.html().length ;

		if(textLength > 90) {
	        that.css('font-size', '1.7em');
	    } else if(textLength > 80) {
	        that.css('font-size', '1.8em');
	    } else if(textLength > 70) {
	        that.css('font-size', '1.9em');
	    } else if(textLength > 40) {
	        that.css('font-size', '2em');
	    }
	}
} ;
setSizeByLength('h1.page-title') ;//Setup for page title


/* 	========================== Ajax infinite scroll ======================= */
jQuery(document).ready(function($){
	$(document).on('click','.videos-load-more', function(){
		var loader = $('.loader');
		var seemore = $('.see-more');
		var that = $(this);
		var page = $(this).data('page');
		var newPage = page+1;

		$slug = $(this).data('slug');
		$deletedtag = $('.testtag');
		$taxonomy_tag = $('.videos-load-more').data('tax');
		$popular = $('.popular');

/*Fonctionnalites Filtres*/

		$active = {};
		$terms = $('li.actif');
		$choix_tri = $('.choix-tri:selected').val();
		$active_tri="";
		if ($terms.length) {
			$.each($terms, function(index, term) {			
				$a    = $(term).find('a');
				$tax  = $a.data('tax');
				$selecetd_taxonomy = $a.data('term');
				if ($tax in $active) {
					$active[$tax].push($selecetd_taxonomy);
				}
				else {
					$active[$tax] = [];
					$active[$tax].push($selecetd_taxonomy);
				}						
			});
		}
		if ($choix_tri != "") {
			$active_tri = $choix_tri;
		}
/*Fonctionnalites Filtres*/

		loader.show();
		seemore.hide();

		if ($taxonomy_tag && $terms.length ==0  && $deletedtag.length==0) {
			data = {
				page: page,
				action: 'tag_taxonomy',
				afp_nonce: afp_vars.afp_nonce,
				tag_slug: $slug,
				tag_tax: $taxonomy_tag,
				tri:$active_tri,
			};
		}else if ($popular.length && $terms.length ==0 && $choix_tri =="" && $deletedtag.length==0) {
			data = {
				page: page,
				action: 'tag_popular',
				afp_nonce: afp_vars.afp_nonce,
			}
		}
		else {
			data = {
				page: page,
				action: 'filter_videos',
				afp_nonce: afp_vars.afp_nonce,
				taxonomy:$active,
				tri:$active_tri,
			};
		}

		$.ajax({
			url : afp_vars.afp_ajax_url,
			type : 'post',
			data : data,
			error : function( response ){
				console.log(response);
			},
			success : function( response ){
				loader.hide();
				//seemore.show();
				that.data('page', newPage);
				$('.videos-container').append( response );
			}
		});
	});
});
/* 	========================== End of Ajax infinite scroll ======================= */
