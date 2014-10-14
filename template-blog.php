<?php 
/*
	Template Name: Blog
*/
?>
<?php get_header(); ?>

	<div id="blog">

		<header class="header-fancy">
			<div class="valign">			
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<?php the_content(); ?>
				<?php endwhile; endif; ?>
			</div>
		</header><!-- header -->

		<div id="content-wrapper">
			<div class="container">
				<div class="filters">
					
				</div>
				<section class="articles">

				<?php $args = array(
					'post_type' => 'post'
				); ?>

				<?php $query = new WP_Query($args); ?>

					<?php if($query->have_posts()): while($query->have_posts()): $query->the_post(); ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-med' ); ?>

						<?php if( $query->current_post % 2 == 0 ):?>
							<div class="article-row clearfix">
						<?php endif; ?>

								<article class="post column">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<div class="image" style="background-image:url(<?php echo $image[0]; ?>)">
										</div>
										<div class="article-meta">
											<h2>
												<?php the_title(); ?>
											</h2>
											<p><?php the_time('F j, Y'); ?></p>
										</div>
									</a>
								</article><!-- post -->

						<?php if( $query->current_post%2 == 1 || $query->current_post == $query->post_count-1 ): ?>
							</div><!-- .article-row -->
						<?php endif; ?>

					<?php $counter++; endwhile; endif; ?>

				</section><!-- .articles -->				

			</div><!-- .container -->
		</div><!-- #content-wrapper -->
	</div><!-- #blog -->

<?php get_footer(); ?>