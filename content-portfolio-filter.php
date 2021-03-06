<?php
/**
 * The file for displaying the more portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

// PULL CATEGORIES TO USE ON FILTER
$terms = get_terms( 'portfolio_category' );

// COUNT THE CATEGORIES TO DIVIDE THE FILTER LIST ITEMS BY
$category_count = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->term_taxonomy WHERE taxonomy = 'portfolio_category'" );
$total_count    = ( $category_count + 1 ); // ADD 1 FOR THE "ALL" LIST ITEM
$height         = 100 / $total_count;
?>

<div id="portfolio-filter">

	 <ul id="filter">
		  <li style="height: <?php echo esc_html( $height ); ?>%;"><a href="#all" class="active" data-filter=".type-portfolio"><span><?php echo __( 'All', 'trim' ); ?></span></a></li>

			<?php
			foreach ( $terms as $term ) {
				echo '<li style="height:' . esc_html( $height ) . '%; " ><a href="' . get_term_link( $term ) . '" data-filter=".' . $term->term_id . '"><span>' . $term->name . '</span></a></li>';
			}
			?>

	 </ul>

	 <script type="text/javascript">
		  jQuery(document).ready(function($){
			   if($('.portfolio').length){
					var filter = $('header');
						themes = $('#masonry-container');
					filter.find('#filter li a').on('click', function(){
						 filter.find('#filter li a').removeClass('active');
						 $(this).addClass('active');
						 var selector = $(this).attr('data-filter');
						 themes.find('.type-portfolio').addClass('inactive');
						 themes.find(selector).removeClass('inactive');
						 return false;
					});
			   }
		  });
	 </script>

</div><!-- END #portfolio-filter -->
