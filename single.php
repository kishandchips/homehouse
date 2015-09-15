<?php get_header(); ?>

<div id="single" class="flex-page">
	<div id="content-wrapper">
		<div class="container">				
			<section class="inner-content column">
				<article class="single">
					<?php if(have_posts()): while(have_posts()): the_post(); ?>
						<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' ); ?>

						<article class="post-item">	

							<?php if($image): ?>
								<div class="image" style="background-image: url(<?php echo $image[0]; ?>)"></div>
							<?php endif; ?>
							<div class="share-bar">
								<?php get_template_part('/inc/share'); ?>			
							</div>
							<div class="article-meta">
								<div class="meta">
									<div class="categories">
										<?php the_category(); ?>
									</div>
									<div class="published">
										<?php the_time('l'); ?>, <?php the_time('d'); ?> <?php the_time('F');?> <?php the_time('Y');?>
									</div>
								</div>
								<h2>
									<?php the_title(); ?>	
								</h2>
								<div class="excerpt">
									<?php the_content(); ?>
								</div>
							</div>
							<div class="follow-bar">
								<div class="follow">
									<div class="heading"><?php _e('Follow @homehouselondon'); ?></div>
									<?php get_template_part('/inc/socials'); ?>				
								</div>
								
							</div>							
						</article>

					<?php endwhile;endif; ?>

					
				</article>
				
			</section><!-- .inner-content -->	

			<div id="related-posts">
				<h2 class="heading"><?php _e('More Like This'); ?></h2>
				<?php 
				$query = new WP_Query( array ( 'orderby' => 'rand', 'posts_per_page' => '3', 'post__not_in' => array($post->ID) ) );
				while ( $query->have_posts() ) : $query->the_post(); ?>

					<?php 
						$image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'full' ); 
						$image_size = array('width' => 370, 'height' => 235);
						$image = bfi_thumb($image[0], $image_size);
					?>

					<article class="post-item">	

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img class="image" src="<?php echo $image; ?>" alt="<?php the_title(); ?>">
						</a>
						<div class="article-meta">
							<div class="meta">
								<div class="categories">
									<?php the_category(); ?>
								</div>
								<div class="published">
									<?php the_time('l'); ?>, <?php the_time('d'); ?> <?php the_time('F');?> <?php the_time('Y');?>
								</div>
							</div>
							<a class="title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<h2>
									<?php the_title(); ?>	
								</h2>
							</a>
						</div>
					</article>
				<?php endwhile;

				wp_reset_postdata();
				 ?>				
			</div>	
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #single-cedric -->

<?php get_footer(); ?>