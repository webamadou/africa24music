<!doctype html>
<html <?php language_attributes(); ?>>
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta charset="<?php bloginfo('charset'); ?>">
		<title><?php bloginfo('name'); ?><?php wp_title('|'); ?></title>
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta property="og:type" content="website" />
 		<meta property="og:image" content="<?php echo $image['url'] ?>" />
		<meta property="og:image:width" content="250" />
		<meta property="og:image:height" content="250" />
		<meta property="og:title" content="<?php echo $name ?>" />
		
		<?php wp_head(); ?>
	</head>
	<body class="bg-settings">
	    <div class="mobile-menu">
	    	<div class="menu-container">
	    		<div class="search-menu">
	    			<div class="search-box">
	    				<form id="menuSearchMobile" class="navbar-form" role="search" action="<?php echo home_url( '/' ); ?>">
	    					<div class="input-group row">
	    						<div class="col-xs-12" style="padding: 0 9px">
	    							<input type="search" class="form-control" placeholder="Recherche" value="<?php //echo get_search_query() ?>" name="s" title="Recherches" />
	    							<span class="input-group-btn">
	    								<button type="submit" class="btn btn-default">
	    									<span class="glyphicon glyphicon-search">
	    										<span class="sr-only">Recherche...</span>
	    									</span>
	    								</button>
	    							</span>
	    						</div>
	    					</div>
	    				</form>
	    			</div>
	    		</div>
	    		<div class="menu-barre">
	    			<ul class="menu">
			    		<li class="profil-link" style="margin: 0 4px; ">
			    			<a href="<?php echo home_url('/'); ?>login">Mon profil</a><br/>
			    		<?php  $current_user = wp_get_current_user();
			    			echo $current_user->display_name;
			    		?>		    			
			    		</li>
						<?php  wp_nav_menu(array('theme_location' => 'primary')); ?>
	    			</ul>
	    		</div>
	    		<div class="social-menu social-horizontal">
	    			<ul class="social">
	    				<li><a href="#"><i class="a24-facebook"></i></a></li>
	    				<li><a href="#"><i class="a24-twitter"></i></a></li>
	    				<li><a href="#"><i class="a24-youtube"></i></a></li>
	    			</ul>
	    		</div>
	    	</div>
	    </div>
	    <div class="sticky-menu-bar">
	    	<div class="collapsed">
		    	<div class="user-profil">
		    		<p class="profil-link">
		    			<a href="/login"><img src="<?php echo get_template_directory_uri() ?>/images/avatar.png" class="img-responsive" alt=""></a>
		    		</p>
		    		<p>
		    		<?php  $current_user = wp_get_current_user();
		    			echo $current_user->display_name;
		    		?>		    			
		    		</p>
		    	</div>
		    	<div class="hidden-xs hidden-sm live-link">
		    		<p id="link-live"><a href="#" class="toggle-live"><img src="<?php echo get_template_directory_uri() ?>/images/live.png" class="img-responsive" alt=""></a></p>
		    	</div>
		    	<div class="menu-container">
		    		<div class="menu-barre">
		    			<ul class="menu">
							<?php  wp_nav_menu(array('theme_location' => 'primary')); ?>
		    			</ul>
		    		</div>
		    		<div class="search-menu">
		    			<ul>
		    				<li><a class="trigger-search" href="#"><img src="<?php echo get_template_directory_uri() ?>/images/recherche.png" alt=""> RECHERCHE</a></li>
		    			</ul>
		    			<div class="search-box">
		    				<form id="menuSearch" class="navbar-form" role="search" action="<?php echo home_url( '/' ); ?>">
		    					<div class="input-group row">
		    						<div class="col-xs-2">
		    							<a class="trigger-search" href="#"><img src="<?php echo get_template_directory_uri() ?>/images/close.png" class="img-responsive" /></a>
		    						</div>
		    						<div class="col-xs-10" style="padding: 0">
		    							<input type="search" class="form-control" placeholder="Recherche" value="<?php //echo get_search_query() ?>" name="s" title="Recherches" autofocus />
		    							<span class="input-group-btn">
		    								<button type="submit" class="btn btn-default">
		    									<span class="glyphicon glyphicon-search">
		    										<span class="sr-only">Recherche...</span>
		    									</span>
		    								</button>
		    							</span>
		    						</div>
		    					</div>
		    				</form>
		    			</div>
		    		</div>
		    		<div class="social-menu social-horizontal">
		    			<ul class="social">
		    				<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_fb_icon.png" alt=""></a></li>
		    				<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_twt_icon.png" alt=""></a></li>
		    				<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_yt_icon.png" alt=""></a></li>
		    			</ul>
		    		</div>
		    	</div>
		    </div>
	    </div>
	    <div class="social-menu social-vertical">
	    	<ul class="social">
	    		<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_fb_icon.png" alt=""></a></li>
	    		<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_twt_icon.png" alt=""></a></li>
	    		<li><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/empty_yt_icon.png" alt=""></a></li>
	    	</ul>
	    </div>
	    <div id="live-cadre">
	    	<div class="live-cadre">
	    		<div class="close-live"><a id="toggle-live"  href="#">X</a></div>
	    		<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style><div class='embed-container'><iframe id="popup-youtube-player"  src='https://www.youtube.com/embed/U6wpnRVaPQw?enablejsapi=1&version=3&playerapiid=ytplayer' frameborder='0' allowfullscreen allowscriptaccess="always"></iframe></div>
	    		<!-- <iframe id="popup-youtube-player" width="208" src="https://www.youtube.com/embed/U6wpnRVaPQw?enablejsapi=1&version=3&playerapiid=ytplayer" frameborder="0" allowfullscreen="true" allowscriptaccess="always"></iframe> -->
	    	</div>
	    </div>
    	<div class="hidden-xs hidden-sm toggle-live live-button"><a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/live_button.png"/></a></div>
    	<div class="visible-xs visible-sm toggle-live live-button"><a href="#"><i class="a24-playIcon"></i></a></div>
		<div id="content">
		    <nav class="navbar navbar-inverse navbar-fixed-top header" role="navigation">
	        	<div class="col-xs-12 col-sm-12">
	            	<div class="hidden-xs trigger-menu">
	            		<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/trigger-menu.png" alt=""></a>
	            	</div>
	            	<div class="visible-xs  trigger-mobile-menu">
	            		<a href="#"><img src="<?php echo get_template_directory_uri() ?>/images/trigger-menu.png" alt=""></a>
	            	</div>
					<div id="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri() ?>/images/logo.png" alt=""></a></div>
				</div>
		    </nav>
			<div class="contenus background">