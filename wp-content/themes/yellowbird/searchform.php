
<form class="searchform" method="get" action="<?php echo home_url(); ?>">
	<div class="search-wrapper">
		<label for="s" class="display-none">search text</label>
		<div class="icon-search search-input-wrapper">
			<input class="text" type="text" value="<?php the_search_query(); ?>" placeholder="Search For ..." name="s" id="s" />
		</div>
		<input class="submit" type="submit" value="" />
	</div>
</form>