<?php
/**
 * The Template for displaying all single posts.
 *
 * @package vantage
 * @since vantage 1.0
 * @license GPL 2.0
 */

get_header(); ?>

<div id="primary" class="content-area">
	<div id="content" class="site-content" role="main">

	<?php while ( have_posts() ) : the_post(); ?>

		<div class="detail_moji">
			<h2><?php the_title();?></h2>
			
			<?php the_post_thumbnail('medium');?>
			<div>
				<?php the_content(); ?>
			</div>
		</div>
		
		<div class="plus_infos">
			<div>
				<?php 
				$tab = get_field('ingredients');
				$html ='';
				
				foreach($tab as $elt){
					$html .= '<span class="ingredient">'.$elt.'</span>';
					
				}
				echo $html;
				?>
			</div>
			<p>
				<?php echo get_field('prix');?> &euro;
			</p>
		</div>	

	<?php endwhile; // end of the loop. ?>

	</div><!-- #content .site-content -->
</div><!-- #primary .content-area -->

    <div id="secondary" class="widget-area" role="complementary">
        <?php //do_action( 'before_sidebar' ); ?>
        <?php// dynamic_sidebar( 'sidebar-1' ); ?>
        <?php //do_action( 'after_sidebar' ); ?>
        <?php if(is_active_sidebar( 'drink_sidebar' )): ?>
            <ul id="drink_sidebar">
                <?php dynamic_sidebar('drink_sidebar');?>
            </ul>

        <?php endif ?>


    </div><!-- #secondary .widget-area -->


<?php get_footer(); ?>