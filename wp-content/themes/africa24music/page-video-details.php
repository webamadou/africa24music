<?php get_header(); ?>
<div class="container costum-send">
    <div class="cadre">
		<div class="page-content">
			<?php
				if(function_exists('get_clip')){
					$id 	= get_query_var( 'em_number' );
					$clip 	= get_clip($id) ;
					if(!empty($clip)){
						$genre 	= get_term_by( 'term_id', @$clip['song_style'],'genres',OBJECT ) ;
						$pays 	= get_term_by( 'term_id', @$clip['artist_country'],'pays',OBJECT ) ;
						$techValidStatus 	= array('-1' => 'Vidéo rejetée','0'=> 'Validation en attente', '1'=> 'Vidéo validée', );
						$techValidColor 	= array('-1' => '#ed3227', '0'=> '#317f95', '1'=> '#fafafa', );
						$techValidIcon 		= array('-1' => 'fa-times', '0'=> 'fa-hourglass-half', '1'=> 'fa-check', );
						$iconUploadType 	= array('1'  => 'fa-upload', '2'=> 'fa-cloud-upload', '3'=> 'fa-dropbox', );
						$uploadType 		= array('1'  => 'Upload', '2'=> 'WeTransfer', '3'=> 'Dropbox', );
						$tech_valid_status 	= $clip['tech_valid_status'] ;
			?>
			<div class="container-fluid">
				<div class="col-xs-6">
					<div class="col-xs-12">
						<div class="video-cadre">
							<div class="video">
								<iframe width="100%" height="100%" src="<?php echo urldecode($clip['youtube_url']) ?>" frameborder="0" allowfullscreen></iframe>
								<h3 class="title"><?php echo $clip['song_title'] ?></h3>
								<strong class="artist"><?php echo $clip['artist_name'] ?> <?php echo ($clip['artists_featuring']!="")?' <small>feat</small> '.$clip['artists_featuring']:'' ?></strong>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6">
					<div class="description"><strong>Description : </strong><?php echo $clip['clip_description'] ?></div>
					<p>
						<span class="tags genre"><?php echo @$genre->name ?></span>
						<span class="tags pays"><?php echo @$pays->name ?></span>
					</p>
					<div class="statu-vignette">
						<a href="#" style="background: <?php echo $techValidColor[$tech_valid_status] ?>">
							<i class="fa fa-fw <?php echo $techValidIcon[$tech_valid_status] ?>"></i>
							<?php echo $techValidStatus[$tech_valid_status] ?>
						</a>
					</div>
				</div>
				<hr width="100%" size="3" />
				<div class="col-xs-6">
					<p><a href="<?php echo home_url().'/list-clips' ?>"><i class="fa fa-angle-double-left"></i> Liste de mes vidéos </a></p>
				</div>
			</div>
			<?php }//END IF NOT EMPTY CLIP
			}//END IF FUNCTION EXIST ?>
		</div>
	</div>
</div>
<?php get_footer(); ?>