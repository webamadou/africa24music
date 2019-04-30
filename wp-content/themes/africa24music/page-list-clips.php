<?php
get_header();
if ( is_user_logged_in() ){
	$current_user 	= wp_get_current_user() ;
	$user_id 		= get_current_user_id() ;
	if(function_exists('get_clips')){
		$clips 		= get_clips('*',"user_id = '$user_id' AND (status != -1 AND deletion_request IS NULL )") ;
	}
?>
<style>
	.container .cadre{
		width: 100%;
	}
</style>
	<div id="upper-layer"></div>
	<div class="container costum-send">
		<div class="cadre"> <!-- cadre contenu des pages: mettre le contenu des pages à partir d'ici -->
			<div class="page-content">
				<h1 class="page-title">liste de vos clips</h1>
				<div id="table-list" class="table-list table-responsive">
					<div class="add_clip"><a href="<?php echo home_url().'/envoyez-vos-clips' ?>"><i class="fa fa-plus"></i></a></div>
					<table id="list_videos" class="table table-inverse table-striped" border="0">
						<thead class="thead-inverse">
							<tr>
								<th>&nbsp;</th>
								<th>Titre</th>
								<th>Artiste</th>
								<th>Genre musical</th>
								<th>Envoyer le</th>
								<th>&nbsp;</th>
							</tr>
						</thead>
						<tbody>
							<?php
							if( !empty($clips) ){
								$techValidStatus 	= array('-1' => 'Vidéo rejetée','0'=> 'Validation en attente', '1'=> 'Vidéo validée', );
								$iconUploadType 	= array('1'  => 'fa-upload', '2'=> 'fa-cloud-upload', '3'=> 'fa-dropbox', );
								$uploadType 		= array('1'  => 'Upload', '2'=> 'WeTransfer', '3'=> 'Dropbox', );
								$techValidIcon 		= array('-1' => 'fa-ban','0'=> 'fa-hourglass-half', '1'=> 'fa-check', );
								$techValidStatus 	= array('-1' => 'Vidéo rejetée','0'=> 'Validation en attente', '1'=> 'Vidéo validée', );
								$techValidColor 	= array('-1' => '#ed3227', '0'=> '#002a35', '1'=> 'green', );

								foreach ($clips as $key => $datas) {
									$edito_valid_status 	= $datas->edito_valid_status ;
									$params	= array('em_number' => $datas->em_number);
									$genre 	= get_term_by( 'term_id', $datas->song_style,'genres',OBJECT ) ;
									$pays 	= get_term_by( 'term_id', $datas->artist_country,'pays',OBJECT ) ;
									?>
									<tr id="line_<?php echo $datas->id_uploaded_clip ?>">
										<td valign="center">
											<i class="fa fa-fw fa-2x <?php echo @$iconUploadType[$datas->upload_type] ?>" style="color: #777777;"></i><br/>
											<small><?php echo @$uploadType[$datas->upload_type] ?></small>
										</td>
										<td>
											<h5>
												<a class="load-dialog" data-item="<?php echo $datas->id_uploaded_clip ?>" href="<?php echo esc_url( add_query_arg( 'em_number', $datas->id_uploaded_clip, site_url( '/video-details/' ) ) )?>"><?php echo $datas->song_title ?></a>
											</h5>
										</td>
										<td>
											<h5><?php echo $datas->artist_name ?></h5>
											<?php //echo $datas->artists_featuring !=""?" Ft ".$datas->artists_featuring:'' ; ?>
										</td>
										<td><?php echo @$genre->name ?>
										</td>
										<td><?php echo date('d-m-Y', strtotime($datas->created_at)) ?></td>
										<td class="video_actions">
											<div class="actions_links">
												<?php if($datas->edito_valid_status == 0){ ?>
													<a href="<?php echo esc_url( add_query_arg( 'em_number', $datas->id_uploaded_clip, site_url( '/edit-clip/' ) ) )?>"  class="edit_clip"><small>
														<i class="fa fa-pencil fa-bulle"></i></small>
														<span class="infos-bulle">Editer les infos du clip</span>
													</a>
													<a href="" data-status="<?php echo $datas->edito_valid_status ?>" data-id="<?php echo $datas->id_uploaded_clip ?>" data-title="<?php echo $datas->song_title ?>" class="delete_clip"><small>
														<i class="fa fa-times" style="color:#ed3227"></i></small>
														<span class="infos-bulle">Surppimer le clip</span>
													</a>
												<?php } ?>
											</div>
											<i class="fa fa-2x <?php echo @$techValidIcon[$datas->edito_valid_status] ?> fa-status" style="color: <?php echo $techValidColor[$datas->edito_valid_status] ?>"></i>
											<span class="infos-bulle"><?php echo $techValidStatus[$datas->edito_valid_status] ?></span>

											<div style="display: none" id="<?php echo 'pop_'.$datas->id_uploaded_clip ?>"> <div class="col-xs-12"> <h3 class="title"><?php echo $datas->song_title ?></h3> <h5 class="artist"><?php echo $datas->artist_name ?> <?php echo ($datas->artists_featuring!="")?' <small>feat</small> '.$datas->artists_featuring:'' ?></h5> <hr width="100%" size="1" /> <h5><?php echo ($datas->song_album!="")?'Album :'.$datas->song_album:'' ?></h5> <p> <span class="tags genre"><?php echo @$genre->name ?></span> <span class="tags pays"><?php echo @$pays->name ?></span> </p> <div class="description"> <hr width="100%" size="1" /> <?php echo $datas->clip_description!=""?'<strong>Description : </strong>'.$datas->clip_description:'' ?></div> <div class="statu-vignette"> s<a href="#" style="background: <?php echo $techValidColor[$edito_valid_status] ?>"> <i class="fa fa-fw <?php echo $techValidIcon[$edito_valid_status] ?>"></i> <?php echo $techValidStatus[$edito_valid_status] ?> </a> </div>
											</div> </div>
										</td>
									</tr>
							<?php }
							} else { ?>
							<tr>
								<td colspan="6">
									<h1>Vous n'avez ecore aucun clip en ligne.</h1>
									<h3>Pour envoyer votre premier vidéo veuillez cliquer sur <a href="<?php echo home_url().'/envoyez-vos-clips' ?>">ce lien <i class="fa fa-play-circle"></i></a></h3>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
				<div id="bloc-error"></div>
			</div>
		</div>
	</div>
</div>
<?php } else {
	// get_template_part( 'page', 'send-video-login' );
	wp_redirect( wp_login_url( get_permalink() ) );
} ?>
<script>
	jQuery(document).ready(function($){
		jQuery('body').on('click','.load-dialog',function(a){
			a.preventDefault() ;
			var video = $(this).data('item') ;
			var popUp = $( '#pop_'+video ).html() ;
			// alert( popUp+'#pop_'+video) ;
			BootstrapDialog.show({
				message : '<div class="container-fluid video-details">'+popUp+'</p>' ,
				cssClass: 'details-video-modal',
			});
		});
		/* 	action delete clip  */
		jQuery('body').on('click','a.delete_clip',function(a){
			a.preventDefault() ;
			var that 		= $(this) ;
			var video 		= $(this).data('id') ;
			var title 		= $(this).data('title') ;
			var status 		= $(this).data('status') ;
			var popUp 		= $( '#pop_'+video ).html() ;
			var formdata 	= "video_id="+video+"&action=deletion_request" ;
			// alert( popUp+'#pop_'+video) ;
			BootstrapDialog.show({
				message : '<div class="container-fluid video-details" style="padding-top: 4px"> <div class="col-xs-12"><i class="fa fa-3x fa-exclamation-triangle" style="color: #ed3227"></i> Vous êtes sur le point de supprimer le clip <strong>'+title+'</strong><br/>Voullez-vous confirmer votre action?</div></p><p>Prenez en considération que cette action est irréversible</p>' ,
				cssClass: 'details-video-modal',
				buttons:[{
							label: 'Confirmer',
							cssClass:'btn-danger btn-xs btn',
							beforeSend:function(){
								that.append('<i class="fa fa-spinner fa-spin"></i>Traitement') ;
							},
							action:function(dialog){
					    		jQuery.ajax({
					    		    url: a24vm_config.upload_url,
					    		    data: formdata,
					    		    type: 'POST',
					    		    success: function(resp) {
					    		        jQuery('#line_'+video).fadeOut(300) ;
					    		    },error: function(XMLHttpRequest, textStatus, errorThrown){
					    		    	alert(' il y a erreur'+textStatus+" "+XMLHttpRequest+" "+errorThrown) ;
					    		    }
					    		});
					    		dialog.close() ;
							}
						},{
							label: 'Annuler',
							cssClass:'btn-success btn-xs btn',
							action:function(dialog){
								dialog.close() ;
							}
						}]
			});
		});
	});
</script>
<?php get_footer(); ?>