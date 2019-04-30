<?php get_header(); ?>
<div class="container">
    <div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
    	<div class="page-content">
    		<h1 class="page-title">clip officiels</h1>
    		<div class="row"><form action="" class="filter-form">
    			<div class="filter-order">
    				<div class="col-xs-12 col-sm-6 filter-menu">
    					<ul>
        					<li class="genre-link" target-link="genres-list">
        						<a href="#">Genre </a>
        					</li>
        					<li class="pays-link" target-link="pays-list">
        						<a href="#">Pays</a>
        					</li>
        				</ul>
    				</div>
    				<div class="col-xs-12 col-sm-6 order-menu">
    					<div class="order">
        					<div class="select-order">
        						<select name="" id="">
	        						<option value="">Afficher par</option>
	        						<option value="1">les plus poulaires</option>
	        						<option value="1">les plus votées</option>
	        						<option value="1"> De A-Z </option>
	        						<option value="1"> De Z-A </option>
	        					</select>
	        				</div>
        					<input type="text" name="search" value="" placeholder="recherche" />
    					</div>
    				</div>
    			</div>
				<div class="col-xs-12 col-sm-12 filter-list">
    				<ul id="pays-list" class="liste pays">
    					<?php 
    						$c = 1 ;
    						$pays = get_terms('pays');
    						// var_dump($pays) ;
    						foreach ($pays as $tag) {
    							?>
    							<li class="col-xs-6 col-sm-4 col-md-3 pays" data-group = "<?php echo 'categ'.$c ?>"><a href="#"><?php echo $tag->name; ?></a></li>
    					<?php  
    						$c++ ;
    						$c = ($c <= 5)? $c : 1 ;
    					}
    					?>
    				</ul>
    				<ul id="genres-list" class="liste genres">
    					<?php 
    						$c = 1 ;
    						// $genres = get_taxonomies('genres');
    						$genres = a24videos_get_all_terms('genres');
    						foreach ($genres as $tag) {
    							?>
    							<li class="col-xs-6 col-sm-4 col-md-3 genre" data-group = "<?php echo 'categ'.$c ?>"><a href="#"><?php echo $tag->name; ?></a></li>
    					<?php 
    						$c++ ;
    						$c = ($c <= 5)? $c : 1 ;
    					 }
    					?>
    				</ul>
				</div>
    		</form></div>
    		<div id="timeline" class="row home-timeline active">
    			<?php 
    			$c = 1 ;
    			for ($i=1; $i < 36; $i++) {
    			?>
    			<div data-groups='["<?php echo 'categ'.$c ?>"]' class="col-xs-12 col-sm-6 col-md-3">
    				<div class="video-item-cadre">
        				<span class="video-tags">
        					<span class="views"><img src="design/images/eye.png" alt=""> 10471</span>
        					<span class="views"><img src="design/images/heart.png" alt=""> 144</span>
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
    			<div class="see-more"><a href=#>voir plus</a></div>
    	</div>
    </div>
</div>
<?php get_footer() ?>