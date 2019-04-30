jQuery(document).ready(function($) {

	function filterVideos() {
		$active = {};
		$terms = $('li.actif');
		$choix_tri = $('.choix-tri:selected').val();
		$active_tri="";
		//alert($choix_tri);
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

		$('.videos-container').fadeOut();
		data = {
			action: 'filter_videos',
			afp_nonce: afp_vars.afp_nonce,
			//taxonomy: selecetd_taxonomy,
			taxonomy:$active,
			tri:$active_tri,
			//page:$page,
		};
		$.ajax({
			type: 'post',
			//dataType: 'json',
			url: afp_vars.afp_ajax_url,
			data: data,
			success: function( data, textStatus, XMLHttpRequest ) {
				$('.videos-container').html( data );
				$('.videos-container').fadeIn();
				console.log( textStatus );
				console.log( XMLHttpRequest );
			},
			error: function( MLHttpRequest, textStatus, errorThrown ) {
				console.log( MLHttpRequest );
				console.log( textStatus );
				console.log( errorThrown );
				$('.videos-container').html( 'Erreur de requete, Aucune vidéo retournée' );
				$('.videos-container').fadeIn();
			}

		});
	}
	function tagsPages() {

		$selected_tax = $('.videos-load-more').data('tax');
		$selected_slug= $('.videos-load-more').data('slug');
		$choix_tri = $('.choix-tri:selected').val();
		$active_tri="";
		if ($choix_tri != "") {
			$active_tri = $choix_tri;
		}

		$('.videos-container').fadeOut();

		data = {
			action: 'tag_taxonomy',
			afp_nonce: afp_vars.afp_nonce,
			tag_slug: $selected_slug,
			tag_tax: $selected_tax,
			tri:$active_tri,
		};
		$.ajax({
			type: 'post',
			url: afp_vars.afp_ajax_url,
			data: data,
			success: function( data, textStatus, XMLHttpRequest ) {
				$('.videos-container').html( data );
				$('.videos-container').fadeIn();
				console.log( textStatus );
				console.log( XMLHttpRequest );
			},
			error: function( MLHttpRequest, textStatus, errorThrown ) {
				console.log( MLHttpRequest );
				console.log( textStatus );
				console.log( errorThrown );
				$('.videos-container').html( 'Erreur de requete, Aucune vidéo retournée' );
				$('.videos-container').fadeIn();
			}
		});
	}

	function popularVideos() {


		$('.videos-container').fadeOut();

		data = {
			action: 'tag_popular',
			afp_nonce: afp_vars.afp_nonce,
		};
		$.ajax({
			type: 'post',
			url: afp_vars.afp_ajax_url,
			data: data,
			success: function( data, textStatus, XMLHttpRequest ) {
				$('.videos-container').html( data );
				$('.videos-container').fadeIn();
				console.log( textStatus );
				console.log( XMLHttpRequest );
			},
			error: function( MLHttpRequest, textStatus, errorThrown ) {
				console.log( MLHttpRequest );
				console.log( textStatus );
				console.log( errorThrown );
				$('.videos-container').html( 'Erreur de requete, Aucune vidéo retournée' );
				$('.videos-container').fadeIn();
			}
		});
	}

	function setTitleTagPage(){
	;
	if ($('.videos-load-more').data('tax') && $('li.actif').length) {
		$('.tag-title').hide();
		}else {
		$('.tag-title').show();
		}
	}


	$('.tax-filter').click( function(event) {

		// Prevent defualt action - opening tag page
		if (event.preventDefault) {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}
		if ($('.search-field').val() !="") {
			$('.search-field').val('');
		}
		$('.see-more').hide();
		// Get tag slug from title attirbute
		$tes = $(this).data('term');

		//$('.see-more').hide();
		$('.liste').fadeOut();

		$(this).parent('li').addClass('actif');

		//$(this).parent('li').siblings().removeClass('actif');

		/********* Start of Display Tags****************/

		if($(this).data('tax')=="genres") {

		if($(".genre-choice a:contains('" + $tes + "')").length==0 ) {

				var dossier = '<li class="genre-choice"><a class="testtag" href="#"></a></li>';
				$('.list-choices').append(dossier);
				$('.genre-choice a:empty()').text($tes);

			}

		}

		if($(this).data('tax')=="pays") {

		if($(".pays-choice a:contains('" + $tes + "')").length==0 ) {

				var dossier = '<li class="pays-choice"><a class="testtag" href="#"></a></li>';
				$('.list-choices').append(dossier);
				$('.pays-choice a:empty()').text($tes);
			}
		}

		/*********End of Display Tags****************/
		$('.videos-load-more').data('page', 1);
		setTitleTagPage();
		filterVideos();
	});

		$('body').on('click', '.testtag', function(event) {
		// Prevent defualt action - opening tag page
		if (event.preventDefault) {
			event.preventDefault();
		} else {
			event.returnValue = false;
		}
		$('.see-more').hide();


		$tag_filter = $(this).text();
		$actuel = $(this);
		$boucle = $('li.actif');
		$taxonomy_tag = $('.videos-load-more').data('tax');


		$.each($boucle, function(index, tag) {
			$lien = $(tag).find('a');
			$tax_deleted = $lien.data('term');

			if($tax_deleted==$tag_filter){

				if ($taxonomy_tag && $boucle.length==1 ) {
					$($lien).parent('li').removeClass('actif');
					$actuel.parent('li').remove();
					setTitleTagPage();	
					tagsPages();
				}
				else if ($('.popular').length && $boucle.length==1 ) {
					$($lien).parent('li').removeClass('actif');
					$actuel.parent('li').remove();
					popularVideos();
				}
				else {
					$($lien).parent('li').removeClass('actif');
					$actuel.parent('li').remove();
					setTitleTagPage();
					filterVideos();					
				}
			}
		});
	});

	//$('.choix-tri').click( function(event) {


	$('body').on('change', '.tri-videos', function() {
		if ($('.search-field').val() !="") {
			$('.search-field').val('');
		}
		$('.see-more').hide();
		$('.videos-load-more').data('page', 1);

		$taxonomy_tag = $('.videos-load-more').data('tax');
		if($taxonomy_tag && $('li.actif').length==0) {
			tagsPages();		
		}else {

			setTitleTagPage();
			filterVideos();	
		}
	});
});