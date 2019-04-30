<?php
get_header();
if ( is_user_logged_in() ){
	$id 		= get_query_var( 'em_number' );
	$user_id 	= get_current_user_id() ;
	if(function_exists('get_clips')){
		$clip 	= find_clip("user_id = '$user_id' AND id_uploaded_clip = $id") ;
		if( $clip['edito_valid_status'] != 0 ){
			wp_redirect(home_url()) ;
		}
?>
	<div id="upper-layer"></div>
	<div class="container costum-send">
		<div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
			<div class="page-content">
				<h1 class="page-title">EDITER UN CLIP</h1>
				<div class="sending-videos-form">
					<div class="container-fluid container-steps">
						<div id="bloc-error"></div>
						<form name="edit_basicform" id="edit_basicform" enctype="multipart/form-data" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
							<input type="hidden" name="id_uploaded_clip" value="<?php echo $clip['id_uploaded_clip'] ?>" />
							<input type="hidden" name="action" value="update_send_video_form" />
							<?php wp_nonce_field( 'save_send_video_form', 'a24-videos-nonce',false,true ); ?>
							<fieldset>
								<div class="form-group container-fields">
									<div class="col-sm-12" target="step-one"><div class="steps"><h3 class="">1</h3> Informations concernant le clip</div></div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="artiste" id="artiste" placeholder="Nom de l'artiste ou du groupe*" value="<?php echo @$clip['artist_name'] ?>" />
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="titre" id="titre" placeholder="Titre de la chanson *" value="<?php echo @$clip['song_title'] ?>" />
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-6 featurings">
										<input type="text" name="artistes" id="artistes" placeholder="Artiste(s) featuring" value="<?php echo @$clip['artists_featuring'] ?>"/>
										<small> Artistes en featuring (Séparé par des virgules)</small>
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="producteur" id="producteur" placeholder="Producteur de la vidéo " value="<?php echo @$clip['clip_producer'] ?>">
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-6">
										<select name="genre" id="genre">
											<option value="">Style/Genre </option>
											<?php
												$genres = a24videos_get_all_terms('genres');
												foreach ($genres as $tag) {
													$selected = ($tag->term_id == $clip['song_style'])?'selected="selected"':'' ;
											?>
											<option value="<?php echo $tag->term_id ?>" <?php echo $selected ?>><?php echo $tag->name ?></option>
											<?php 
												}//End foreach
											?>
										</select>
									</div>
									<div class="col-xs-12 col-sm-6">
										<select name="year" id="year">
											<option value="">Année de production *</option>
											<?php $thisyear = (int) date('Y') ;
											for ($i= $thisyear; $i > 1900 ; $i--) { 
													$selected = ($i == $clip['production_year'])?'selected="selected"':'' ;
												echo '<option value="'.$i.'" '.$selected.'> '.$i.' </option>' ;
											}
											?>
										</select>
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-6">
										<select name="video_countrie" id="video_countrie">
											<option value="">Pays *</option>
											<?php
												$pays = get_terms('pays');
												foreach ($pays as $tag) {
													$selected = ($tag->term_id == $clip['artist_country'])?'selected="selected"':'' ;
													?>
													<option value="<?php echo $tag->term_id ?>" <?php echo $selected ?>><?php echo $tag->name ?></option>
											<?php 
												$c++ ;
												$c = ($c <= 5)? $c : 1 ;
											 }
											?>
										</select>
										<input type="hidden" name="pays_name" id="pays_name" />
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="album_name" id="album_name" placeholder="Titre de l'album de la chanson" value="<?php echo @$clip['song_album'] ?>">
									</div>
									<div class="col-xs-12 col-sm-12">
										<textarea name="clip_description" id="clip_description" placeholder="Décrire le clip en quelques mots"><?php echo @$clip['clip_description'] ?></textarea>
									</div>
								</div> 
								<div class="clearfix" style="height: 10px;clear: both;"></div>
								<div class="container-fields">
									<div class="col-xs-12 col-sm-12">
										<div class="helps">
											<span class="help-tag">?</span>
											<span class="help-text"> Si votre clip est sur youtube veuillez renseigner le lien complet sur le champs ci-dessous </span>
										</div>
										<input style="margin-top: 0.2%; " type="text" name="yt_link" id="yt_link" placeholder="Le lien youtube de votre vidéo" value="<?php echo $clip['youtube_url'] ?>"> </div>
								</div>
							</fieldset>
							<fieldset>
								<div class="clearfix" style="height: 10px;clear: both;"></div>
								<div class="form-group">
									<div class="col-xs-12">
										<button class="pull-right btn btn-primary open3" type="submit"> Envoyer </button>
										<div id="loader"></div>
									</div>
								</div>
							</fieldset>
						</form>
				</div>
			</div>
		</div>
	</div>
<?php
	}//END IF FUNCTION EXIST
} else {
	wp_redirect( wp_login_url( get_permalink() ) );
} ?>
<?php get_footer(); ?>