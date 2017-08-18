<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

		<?php while ( have_posts() ) : the_post(); ?>
			
			<div class="block_moji clearfix">
				<div class="thumbnail">
					<?php the_post_thumbnail('medium');?>
				</div>
				<div class="description">
					<h2><a href="<?php the_permalink();?>"><?php the_title();?></h2>
					<p><?php the_excerpt();?></p>
					<p class="price">Prix <?php echo get_field('prix');?>&euro; TTC</p>
					
				</div>
			
					
			</div>
			
		<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->


<?php get_footer(); ?>