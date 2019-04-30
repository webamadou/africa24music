<!DOCTYPE html>
<html lang="en">

<head>

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="">
<meta name="author" content="">

<title>A 24 Music</title>
<link href='https://fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- Bootstrap Core CSS -->
<link href="design/js/jquery-ui.min.css" rel="stylesheet" />
<link href="design/css/bootstrap.min.css" rel="stylesheet" />
<link href="design/css/style.css" rel="stylesheet" />
<link href="design/css/responsive.css" rel="stylesheet" />
</head>

<body>
    <div class="sticky-menu-bar">
    	<div class="collapsed">
	    	<div class="user-profil">
	    		<p class="profil-link">
	    			<a href="auth.php"><img src="design/images/avatar.png" class="img-responsive" alt=""></a>
	    		</p>
	    		<p>FRANCINE PIPIEN</p>
	    	</div>
	    	<div class="live-link">
	    		<p id="link-live"><a href="#" class="toggle-live"><img src="design/images/live.png" class="img-responsive" alt=""></a></p>
	    	</div>
	    	<div class="menu-container">
	    		<div class="menu-barre">
	    			<ul class="menu">
	    				<li><a href="envoie_video.php"><img src="design/images/send_video.png" alt="">ENVOYER CLIP</a></li>
	    				<li><a href="videos.php"><img src="design/images/videos.png" alt="">CLIP OFFICIEL</a></li>
	    				<li><a href="videos.php"><img src="design/images/folder.png" alt="">PLAYLISTS</a></li>
	    				<!-- <li><a href="playlist."><img src="design/images/playlist.png" alt=""></a></li> -->
	    				<!-- <li><a href="#"><img src="design/images/news.png" alt=""></a></li> -->
	    			</ul>
	    		</div>
	    		<div class="search-menu">
	    			<ul>
	    				<li><a href="recherche.php"><img src="design/images/recherche.png" alt=""> RECHERCHE</a></li>
	    			</ul>
	    		</div>
	    		<div class="social-menu social-horizontal">
	    			<ul class="social">
	    				<li><a href="#"><img src="design/images/empty_fb_icon.png" alt=""></a></li>
	    				<li><a href="#"><img src="design/images/empty_twt_icon.png" alt=""></a></li>
	    				<li><a href="#"><img src="design/images/empty_in_icon.png" alt=""></a></li>
	    				<li><a href="#"><img src="design/images/empty_yt_icon.png" alt=""></a></li>
	    			</ul>
	    		</div>
	    	</div>
	    </div>
    </div>
    <div class="social-menu social-vertical">
    	<ul class="social">
    		<li><a href="#"><img src="design/images/empty_fb_icon.png" alt=""></a></li>
    		<li><a href="#"><img src="design/images/empty_twt_icon.png" alt=""></a></li>
    		<li><a href="#"><img src="design/images/empty_in_icon.png" alt=""></a></li>
    		<li><a href="#"><img src="design/images/empty_yt_icon.png" alt=""></a></li>
    	</ul>
    </div>
    <div id="live-cadre">
    	<div class="live-cadre">
    		<div id="toggle-live" class="close-live">X</div>
    		<iframe width="100%" height="208" src="https://www.youtube.com/embed/U6wpnRVaPQw" frameborder="0" allowfullscreen></iframe>
    	</div>
    </div>
	<div id="content">
	    <nav class="navbar navbar-inverse navbar-fixed-top header" role="navigation">
            <div class="col-xs-1 col-sm-1">
            	<div class="trigger-menu"><a href="#"><img src="design/images/trigger-menu.png" alt=""> </a></div>
            </div>
        	<div class="col-xs-11 col-sm-11">
				<div id="logo"><a href="index.php"><img src="design/images/Logo.png" alt=""></a></div>
			</div>
	    </nav>
		<div class="contenus background">
			<div id="bilboard">
				<div class="slider-cadre">
					<ul class="slider">
						<li id="slide1">
							<img src="design/images/sliders/slide1.png" alt="">
							<div>
								<h1>STROMAE</h1>
								<h3>EN CONCERT À DAKAR<br/> LE 14 DÉCEMBRE 2016</h3>
							</div>
						</li>
						<li id="slide2">
							<img src="design/images/sliders/slide2.png" alt="">
							<div>
								
							</div>
						</li>
						<li id="slide3">
							<img src="design/images/sliders/slide3.png" alt="">
							<div>
							</div>
						</li>
						<li id="slide4">
							<img src="design/images/sliders/slide4.png" alt="">
							
						</li>
					</ul>
				</div>
				<div class="slider-bullet">
					<ul class="bullets-list">
						<li id="bullet1" rel="1">&nbsp</li>
						<li id="bullet2" rel="2">&nbsp</li>
						<li id="bullet3" rel="3">&nbsp</li>
						<li id="bullet4" rel="4">&nbsp</li>
					</ul>
				</div>
			</div>
		    <div class="container">
		        <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
		        	<div class="home-content">
		        		<div class="row home-timeline-menu">
		        			<ul class="">
		        				<li rel="item1" color="#ED3227" class="col-xs-4 col-sm-4 active">
		        					<div class="timeline-menu-cadre red">
		        						<span class="link"><a href="#">dernières vidéos</a></span>
		        					</div>
		        				</li>
		        				<li rel="item2" color="#f8ed26" class="col-xs-4 col-sm-4">
		        					<div class="timeline-menu-cadre yellow">
		        						<span class="link"><a href="#">découvertes</a></span>
		        					</div>
		        				</li>
		        				<li rel="item3" color="#369cc6" class="col-xs-4 col-sm-4">
		        					<div class="timeline-menu-cadre blue">
		        						<span class="link"><a href="#">vidéos populaires</a></span>
		        					</div>
		        				</li>
		        			</ul>
		        		</div>
		        		<div id="item1" class="row home-timeline active">
		        			<?php for ($i=1; $i < 13; $i++) { ?>
		        			<div class="col-xs-12 col-sm-6 col-md-4">
		        				<div class="video-item-cadre">
			        				<span class="video-tags">
			        					<span class="views"><img src="design/images/eye.png" alt=""> 10471</span>
			        					<span class="views"><img src="design/images/heart.png" alt=""> 144</span>
			        				</span>
			        				<a href="" class="details">
			        					<span class="country">Afrobeat</span>
			        					<span class="country">Afrique du sud</span>
			        				</a>
			        				<div class="plays">
			        					<span class="play-btn"><img src="design/images/play-icon.png" class="img-responsive" alt=""></span>
			        				</div>
			        				<div class="video-item"><img src="design/images/item1.png" class="img-responsive" alt=""></div>
			        				<div class="title-cadre">
			        					<div class="vertical-barre red">&nbsp;</div>
			        					<div class="video-infos">
			        						<span class="titre">SEKEM</span>
			        						<span class="video-artiste">Mc Galaxy</span>
			        					</div>
			        				</div>
			        			</div>
		        			</div>
							<?php 
		        			} ?>
		        		</div>
		        		<div id="item2" class="row home-timeline">
		        			<?php for ($i=1; $i < 13; $i++) { ?>
			        			<div class="col-xs-12 col-sm-6 col-md-4">
			        				<div class="video-item-cadre">
				        				<span class="video-tags">
				        					<span class="views"><img src="design/images/eye.png" alt=""> 10471</span>
				        					<span class="views"><img src="design/images/heart.png" alt=""> 144</span>
				        				</span>
				        				<a href="" class="details">
				        					<span class="country">Afrobeat</span>
				        					<span class="country">Afrique du sud</span>
				        				</a>
				        				<div class="plays">
				        					<span class="play-btn"><img src="design/images/play-icon.png" class="img-responsive" alt=""></span>
				        				</div>
				        				<div class="video-item"><img src="design/images/item2.png" class="img-responsive" alt=""></div>
				        				<div class="title-cadre">
				        					<div class="vertical-barre yellow">&nbsp;</div>
				        					<div class="video-infos">
				        						<span class="titre">SEKEM</span>
				        						<span class="video-artiste">Mc Galaxy</span>
				        					</div>
				        				</div>
				        			</div>
			        			</div>
							<?php 
		        			} ?>
		        		</div>
		        		<div id="item3" class="row home-timeline">
		        			<?php for ($i=1; $i < 13; $i++) { ?>
			        			<div class="col-xs-12 col-sm-6 col-md-6">
			        				<div class="video-item-cadre">
				        				<span class="video-tags">
				        					<span class="views"><img src="design/images/eye.png" alt=""> 10471</span>
				        					<span class="views"><img src="design/images/heart.png" alt=""> 144</span>
				        				</span>
				        				<a href="" class="details">
				        					<span class="country">Afrobeat</span>
				        					<span class="country">Afrique du sud</span>
				        				</a>
				        				<div class="plays">
				        					<span class="play-btn"><img src="design/images/play-icon.png" class="img-responsive" alt=""></span>
				        				</div>
				        				<div class="video-item"><img src="design/images/item3.png" class="img-responsive" alt=""></div>
				        				<div class="title-cadre">
				        					<div class="vertical-barre blue">&nbsp;</div>
				        					<div class="video-infos">
				        						<span class="titre">SEKEM</span>
				        						<span class="video-artiste">Mc Galaxy</span>
				        					</div>
				        				</div>
				        			</div>
			        			</div>
							<?php 
		        			} ?>
		        		</div>
		        		<div class="see-more"><a href=#>voir plus</a></div>
		        		<div id="top-fan" class="hidden-xs col-sm-12">
		        			<div class="top-fan">
		        				<h1>Top 5</h1>
		        				<?php 
		        					$titres = array('','ORIGINAL','ORIGINAL','ORIGINAL','kedike','jooni') ;
		        					$artistes = array('','Fally Ipupa', 'Hugh R. Masekela','Chindinma','Yémi Aladé','Wizkid') ;
		        					for ($i=1; $i < 6 ; $i++) {
		        				?>
		        				<div class="top-item">
			        				<span class="ranke"> <b><?php echo $i ?></b> </span>
			        				<div class="title-cadre">
			        					<div class="vertical-barre blue">&nbsp;</div>
			        					<div class="video-infos">
			        						<span class="titre"><?php echo $titres[$i] ?></span>
			        						<span class="video-artiste"><?php echo $artistes[$i] ?></span>
			        					</div>
			        				</div>
			        				<div class="video-item"><img src="design/images/<?php echo 'top'.$i ?>.png" class="img-responsive" alt=""></div>
			        			</div>
			        			<?php } ?>
		        			</div>
		        		</div>
		        		<div class="row advertise">
		        			<div class="hidden-xs col-sm-8 pub"><h2>ESPACE PUB <br/>630 x 300</h2></div>
		        			<div class="hidden-xs col-sm-4 pub"><h2>ESPACE PUB <br/>630 x 300</h2></div>
		        		</div>
		        		<h1 class="slim-title">playlists</h1>
		        		<div id="carousel">
		        			<div id='left_scroll'><img src='design/images/carousel-arrow-left.png' /></div>
		        			  <div id='carousel_inner'>
		        			      <ul id='carousel_ul'>
		        			      	<?php for ($i=1; $i < 6 ; $i++) {
		        			          echo "<li>
		        			          			<a href='#'><img src='design/images/play".$i.".png' class='img-responsive' /></a>
		        			          			<span class='carousel-title'>AFTERNOON</span>
		        			          			<span class='shadow'></span>
		        			          		</li>" ;
		        			      	} ?>
		        			      </ul>
		        			  </div>
		        			<div id='right_scroll'><img src='design/images/carousel-arrow-right.png' /></div>
		        		</div>
		        		
		        		<h1 class="slim-title">NEWS</h1>
		        		<div id="news" class="row">
		        			<?php for ($i=1; $i < 4; $i++) { ?>
							<div class="col-xs-12 col-sm-4">
								<div class="article">
									<div class="article-img"><img src="design/images/news<?php echo $i ?>.png" class="img-responsive" alt=""></div>
									<h2>Alicia keys s'engage dans la cause LBGT!!</h2>
									<div class="hidden-xs hidden-sm col-md-12" extrait">
										<p>La jeune femme à la voix suave vient de faire son retour en force dans la musique. On a appris il y a quelques jours qu’elle était qualifiée pour la finale de Ligue des Champions. En d’autres termes, elle va …</p>
									</div>
									<div class="tags">
										<span class="eye"> 10471</span>
										<span class="heart"> 144</span>
									</div>
								</div>
							</div>
							<?php } ?>
		        		</div>
		        		<div class="see-more"><a href=#>voir plus</a></div>
		        		<div class="row advertise">
		        			<div class="hidden-xs col-sm-12 pub-full-100"><h2>ESPACE PUB <br/>900 x 100</h2></div>
		        		</div>
		        	</div>
		        </div>
		    </div>
		</div>
	</div>
	<footer class="container">
	    <div class="row">
	        <div class="col-xs-12 col-sm-6">
	            <p>&copy; 2016 Copyright Africa24 Music. All Rights reserved	 </p>
	        </div>
	        <div class="col-xs-12 col-sm-6">
	            <div class="footer-menu">
	            	<ul>
	            		<li><a href="a_propos.php">A Propos</a></li>
	            		<li><a href="contact.php">Contact</a></li>
	            		<li><a href="faq.php">FAQ</a></li>
	            		<li><a href="legal.php">Légal</a></li>
	            	</ul>
	            </div>
	        </div>
	    </div>
	    <!-- /.row -->
	</footer>
    <!-- jQuery -->
    <script src="design/js/jquery.js"></script>
    <script src="design/js/jquery-ui.min.js"></script>
    <script src="design/js/bootstrap.min.js"></script>
    <script>
    	$('.trigger-menu').click(function (e) {
    		$('.social-menu.social-vertical').toggle('slide', 'right',800) ;
    		$('.sticky-menu-bar').toggle('slide', 'right', 800 ) ;
    	});
    	/*show/hide live cadre*/
    	$('.toggle-live, #toggle-live').click(function(){
    		$('#live-cadre').toggle('slide', 'right', 800) ;
    	});
    	/* 	video items */
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
    </script>
    <script src="design/js/scripts.js"></script>
</body>
</html>