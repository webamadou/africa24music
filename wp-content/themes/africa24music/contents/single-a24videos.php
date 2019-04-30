<?php get_header(); ?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<?php if( have_posts() ): ?>
				<?php while( have_posts() ): the_post(); ?>
					<?php get_template_part('contents/content', 'a24videos'); ?>
    			<?php endwhile ?>
    		<?php endif ?>
    		<div class="row advertise">
    			<div class="hidden-xs col-sm-12 pub-full-100"><h2>ESPACE PUB <br/>900 x 100</h2></div>
    		</div>
			<div class="comments-cadre">
				<?php
					$nbr = rand(0, 10) ;
					$lorem = array("Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.",
						"Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex")
				?>
				<h1 class="title">ajouter un commentaire <span class="a24-slide-down"></span></h1>
				<div class="comments-wrapper">
					<div class="comments-list">
						<ul clxass="comments">
						<?php 
							if($nbr > 0){
								for ($i=0; $i < 5 ; $i++) {
								$answers = rand(0,5) ; $lorems = rand(0,2) ;
							?>
								<li>
									<div class="img-profil">
										<img class="img-responsive" src="design/images/profils/<?php echo $i ?>.jpg" />
									</div>
									<div class="comment-cadre"> 
										<div class="comment-details">
											<span class="name">Fatou Dia</span>
											<span class="date-publication">01 juillet 2016, 15:45</span>
										</div>
										<div class="comment">
											<p><?php echo $lorem[$lorems] ?></p>
										</div>
										<p class="links"><a href="#">Répondre</a></p>
									</div>
								</li>
							<?php 
								if($answers > 0){
								?>
									<ul>
									<?php for ($i=0; $i < $answers ; $i++) { ?>
										<li>
											<div class="img-profil">
												<img class="img-responsive" src="design/images/profils/<?php echo $i ?>.jpg" />
											</div>
											<div class="comment-cadre"> 
												<div class="comment-details">
													<span class="name">Fatou Dia</span>
													<span class="date-publication">01 juillet 2016, 15:45</span>
												</div>
												<div class="comment">
													<p><?php echo $lorem[$lorems] ?></p>
												</div>
												<p class="links"><a href="#">Répondre</a></p>
											</div>
										</li>
										<?php }//ENd loop for answer ?>
									</ul>
								<?php
								}
							 	}//END for loop 5 comments
							} ?>
						</ul>
					</div>
					<div class="comment-form-div">
						<h1>Ton commentaire</h1>
						<strong class="instruction">Votre adresse email ne sera pas publiée.</strong>
						<form action="" class="comment-form">
							<p>Se connecter pour commenter</p>
							<p>
								<a href="#"><img src="design/images/fb_icon.png" alt=""></a> <a href="#"><img src="design/images/twt_icon.png" alt=""></a>
							</p>
							<div class="hidden-xs col-sm-1 img-profil">
								<i class="glyphicon glyphicon-user"></i>
							</div>
							<div class="col-xs-12 col-sm-11 comment">
								<textarea name="comment" id="comment" cols="30" rows="5"></textarea>
								<br>
								<button type="submit" class="btn btn-primary">Soumettre</button>
							</div>
						</form>
					</div>
				</div>
			</div>
    		<div id="similaires" class="row">
    			<h1 class="page-title">vidéos similaire</h1>
    			<span class="slider-arrows left"><i class="a24-slide-left"></i></span>
    			<span class="slider-arrows right"><i class="a24-slide-right"></i></span>
    			<div class="slide-similaire">
        			<?php 
        			$c = 1 ;
        			for ($i=1; $i < 6; $i++) {
        			?>
        			<div class="col-xs-12 col-sm-6 col-md-3 video">
        				<div class="video-item-cadre">
	        				<span class="video-tags">
	        					<span class="views"><img src="design/images/eye.png" alt=""> 10471</span>
	        					<!-- <span class="views"><img src="design/images/heart.png" alt=""> 144</span> -->
	        				</span>
	        				<a href="video.php" class="details">
	        					<span class="country">Afrobeat</span>
	        					<span class="country">Afrique du sud</span>
	        				</a>
	        				<div class="plays">
	        					<span class="play-btn"><img src="design/images/play-icon.png" class="img-responsive" alt=""></span>
	        				</div>
	        				<div class="video-item"><img src="design/images/<?php echo 'item'.$c ?>.png" class="img-responsive" alt=""></div>
	        				<div class="title-cadre">
	        					<div class="vertical-barre white">&nbsp;</div>
	        					<div class="video-infos">
	        						<span class="titre">SEKEM</span>
	        						<span class="video-artiste">Mc Galaxy</span>
	        					</div>
	        				</div>
	        			</div>
        			</div>
					<?php

	        		$c++ ;
	        		$c = ($c <= 5)? $c : 1 ;
        			} ?>
        			<div class="col-xs-12 col-sm-6 col-md-3 shuffle_sizer"></div>
        		</div>
    		</div>
    	</div>
    </div>
</div>

<?php get_footer(); ?>