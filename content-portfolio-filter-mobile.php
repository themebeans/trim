<?php
/**
 * The file for displaying the more portfolio loop below the portfolio single.
 * It is called via the single-portfolio.php.
 *
 * @package     Trim
 * @link        https://themebeans.com/themes/trim
 */

$terms = get_terms( 'portfolio_category' );
?>

<div id="portfolio-filter-mobile">

	 <ul id="mobile-filter">
		  <li><a href="#all" class="active" data-filter=".type-portfolio"><span> # <?php echo __( 'All', 'trim' ); ?></span></a></li>

			<?php
			foreach ( $terms as $term ) {
				echo '<li><a href="' . get_term_link( $term ) . '" data-filter=".' . $term->term_id . '"><span> # ' . $term->name . '</span></a></li>';
			}
			?>

	 </ul>

	 <script type="text/javascript">
		  jQuery(document).ready(function($){
			   if($('.portfolio').length){
					var filter = $('#portfolio-filter-mobile');
						themes = $('#masonry-container');
					filter.find('#mobile-filter li a').on('click', function(){
						 filter.find('#mobile-filter li a').removeClass('active');
						 $(this).addClass('active');
						 var selector = $(this).attr('data-filter');
						 themes.find('.type-portfolio').addClass('inactive');
						 themes.find(selector).removeClass('inactive');
						 return false;
					});
			   }
		  });
	 </script>

</div><!-- END #portfolio-filter-mobile -->
