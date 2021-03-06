<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Press_On
 */

get_header(); ?>

<?php if (function_exists ('adinserter')) echo adinserter (get_option('po_index_banner_ad')); ?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) : ?>
				<header>
					<h1 class="page-title screen-reader-text"><?php single_post_title(); ?></h1>
				</header>

			<?php
			endif;

			$filter_category = get_option('po_home_categories_enabled') ? get_option('po_headline_article_category') : false;

			$args = array(
				'numberposts' => 1,
				'offset' => 0,
				'orderby' => 'post_date',
				'order' => 'DESC', 
				'category' => $filter_category 
			);

		   $latestpost = get_posts( $args );
		   $post = $latestpost[0];

			   if ($latestpost) { 
						setup_postdata('$post');	?>
							<div class="article">
							<header>
							
							<?php get_template_part( 'template-parts/content-featured', 'none' );	?>
							</header>
							</div>
					<?php 
				wp_reset_postdata;
			}
			
			get_template_part( 'template-parts/content-index-posts', 'none' ); 

			/* Start the Loop */
			// while ( have_posts() ) : the_post();

			// 	/*
			// 	 * Include the Post-Format-specific template for the content.
			// 	 * If you want to override this in a child theme, then include a file
			// 	 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
			// 	 */
			// 	get_template_part( 'template-parts/content', get_post_format() );

			// endwhile;

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		
		<?php get_template_part( 'template-parts/content-social-media-following', 'none' ); ?>
	

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
