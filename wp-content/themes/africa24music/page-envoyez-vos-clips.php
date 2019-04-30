<?php
	get_header();
	if ( is_user_logged_in() ){
?>
	<div id="upper-layer"></div>
	<div class="container costum-send">
		<div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
			<div class="page-content">
				<h1 class="page-title">ENVOYER UN CLIP</h1>
				<div class="sending-videos-form">
					<div class="container-fluid container-steps">
						<div id="bloc-error"></div>
						<form name="basicform" id="basicform" enctype="multipart/form-data" method="post" action="<?php echo esc_url( admin_url('admin-post.php') ); ?>">
							<input type="hidden" name="action" value="save_send_video_form" />
							<?php wp_nonce_field( 'save_send_video_form', 'a24-videos-nonce',false,true ); ?>
							<fieldset>
								<div class="form-group container-fields">
									<div class="col-sm-12" target="step-one"><div class="steps"><h3 class="">1</h3> Informations concernant le clip</div></div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="artiste" id="artiste" placeholder="Nom de l'artiste ou du groupe*">
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="titre" id="titre" placeholder="Titre de la chanson *">
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-6 featurings">
										<input type="text" name="artistes" id="artistes" placeholder="Artiste(s) featuring">
										<small> Séparé les noms  des artistes par des virgules</small>
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="producteur" id="producteur" placeholder="Producteur de la vidéo ">
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-6">
										<select name="genre" id="genre">
											<option value="">Style/Genre </option>
											<?php
												$genres = a24videos_get_all_terms('genres');
												foreach ($genres as $tag) {
											?>
												<option value="<?php echo $tag->term_id ?>"><?php echo $tag->name ?></option>
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
												echo '<option value="'.$i.'"> '.$i.' </option>' ;
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
													?>
													<option value="<?php echo $tag->term_id ?>"><?php echo $tag->name ?></option>
											<?php 
												$c++ ;
												$c = ($c <= 5)? $c : 1 ;
											 }
											?>
										</select>
										<input type="hidden" name="pays_name" id="pays_name" />
									</div>
									<div class="col-xs-12 col-sm-6">
										<input type="text" name="album_name" id="album_name" placeholder="Titre de l'album de la chanson">
									</div>
									<div class="col-xs-12 col-sm-12">
										<textarea name="clip_description" id="clip_description" placeholder="Décrire le clip en quelques mots"></textarea>
									</div>
								</div> 
								<div class="clearfix" style="height: 10px;clear: both;"></div>
							</fieldset>
							<fieldset>
								<div class="col-xs-12 spacer"></div>
								<div class="col-sm-12" target="step-two"><div class="steps"><h3 class="">2</h3> Informations concernant le téléchargement</div></div>
								<div class="pick-sender">
									<div class="col-xs-12"><h4 style="text-align: left;">Choisissez votre mode d'envoi parmis les trois suivants : </h4></div>
									<div class="col-xs-12 col-sm-4"><button class="btn btn-primary btn-picker" data-upload="1" data-target="pick_upload" type="button">Upload Vidéo</button></div>
									<div class="col-xs-12 col-sm-4"><button class="btn btn-primary btn-picker" data-upload="2" data-target="pick_wetransfert" type="button">WeTransfer</button></div>
									<div class="col-xs-12 col-sm-4"><button class="btn btn-primary btn-picker" data-upload="3" data-target="pick_dropbox" type="button">Dropbox</button></div>
									<input type="hidden" name="upload_type" id="upload_type" />
								</div>
								<div id="step2" class="form-group container-fields">
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-12 pick-div" id="pick_upload">
										<h4 class="field-title">Uploader la vidéo</h4>
										<p>Envoyez une vidéo en haute définition d'au moins 720pixels (1280p par 720p)</p>
										<span style="display: block;">Formats vidéo acceptés : avi, mp4 - taille inférieur à 500Mo</span>
										<button type="button" class="fake-uploader" target="videofile">Choisissez un fichier</button>
										<input type="file" id="videofile" name="videofile" placeholder="Choisissez un fichier">
										<p id="file_name" style="display: none;"></p>
										<div id="a24-progress">
											<progress id="progressBar" value="0" max="100"></progress>
											<h3 id="status"></h3>
											<p id="loaded_n_total"></p>
										</div>
									</div>
									<div class="col-xs-12 spacer"></div>
									<div class="col-xs-12 col-sm-12 pick-div" id="pick_wetransfert">
										<h4 class="field-title">wetransfer
											<div class="helps">
												<span class="help-tag">?</span>
												<span class="help-text"> Veuillez renseigner l'url wetransfer de votre vidéo </span>
											</div>
										</h4>
										<input type="text" name="wetransfer_link" id="wetransfer_link" placeholder="Lien WeTransfer" />
									</div>
									<div class="col-xs-12 col-sm-12 pick-div" id="pick_dropbox">
										<h4 class="field-title">dropbox
											<div class="helps">
												<span class="help-tag">?</span>
												<span class="help-text"> Veuillez renseigner l'url dropbox de votre vidéo</span>
											</div>
										</h4>
										<input type="text" name="dropbox_link" id="dropbox_link" placeholder="Lien Dropbox" />
									</div>
								</div>
								<div id="empty-mode-error"></div>
								<div class="clearfix" style="height: 10px;clear: both;"></div>
								<div class="container-fields">
									<div class="col-xs-12 spacer"></div>
									<hr width="100%" size="1" />
									<div class="col-xs-12 col-sm-12">
										<div class="helps">
											<span class="help-tag">?</span>
											<span class="help-text"> Si votre clip est sur YouTube veuillez renseigner le lien complet sur le champs ci-dessous </span>
										</div>
										<input style="margin-top: 0.2%; " type="text" name="yt_link" id="yt_link" placeholder="Le lien YouTube de votre vidéo"> </div>
								</div>
								<div class="form-group">
									<div class="col-xs-12">
										<input type="checkbox" name="cgu" id="cgu"  />
										<label class="fancycheck" for="cgu">J'ai lu et accepté les <a href="#" target="_blank">Conditions Générales d'Utilisation</a> d'Africa24 Music, sa Politique de confidentialité et son utilisation des cookies.</label>
									</div>
								</div>
								<div class="clearfix" style="height: 10px;clear: both;"></div>
								<div class="form-group">
									<div class="col-xs-12">
										<button class="pull-right btn btn-primary open3" type="submit" disabled="disabled"> Envoyer </button>
										<div id="loader"></div>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<!-- jQuery -->
<!-- <script> </script> -->
<!-- <script type="text/javascript"></script> -->
<?php } else {
	// get_template_part( 'page', 'send-video-login' );
	wp_redirect( wp_login_url( get_permalink() ) );
} ?>
<?php get_footer(); ?>