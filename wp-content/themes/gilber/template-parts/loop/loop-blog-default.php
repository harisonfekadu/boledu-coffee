<?php

/**
 * @author: VLThemes
 * @version: 1.0.1
 */

?>

<div class="masonry clearfix" data-masonry-col="1">
	<div class="gutter-sizer"></div>
	<div class="grid-sizer"></div>

	<?php
		while ( have_posts() ) : the_post();
			echo '<div class="grid-item">';
			get_template_part( 'template-parts/post/post-style', 'default' );
			echo '</div>';
		endwhile;
	?>

</div>
<!-- /.masonry -->