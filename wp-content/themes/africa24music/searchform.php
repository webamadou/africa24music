<form id="native" role="search" method="get" action="<?php echo home_url( '/' ); ?>">
	<div class="col-xs-12 col-sm-10 col-md-10 no-padding">
		<input type="search" class="form-control" placeholder="Recherche . . ." value="<?php echo get_search_query() ?>" name="s" title="Recherche" style="max-width: 99%" />
	</div>
	<div class="col-xs-12 col-sm-2 col-md-2 no-padding">
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				RECHERCHER
				<!-- <span class="glyphicon glyphicon-search"> <span class="sr-only">Recherche...</span> </span> -->
			</button>
		</span>
	</div>
</form>
<!-- <form class="navbar-form" role="search" action="< ?php echo home_url( '/' ); ?>">
	<div class="col-xs-10" style="padding: 0">
		<input type="search" class="form-control" placeholder="Recherche" value="< ?php //echo get_search_query() ?>" name="s" title="Recherches" autofocus />
		<span class="input-group-btn">
			<button type="submit" class="btn btn-default">
				<span class="glyphicon glyphicon-search">
					<span class="sr-only">Recherche...</span>
				</span>
			</button>
		</span>
	</div>
</form> -->
<script>
</script>