<?php get_header(); ?>

<div id="blog" class="flex-page">

	<div id="content-wrapper">
		<div class="container">
			<section class="blog-header">
				<div class="top">
					<a href="https://twitter.com/HomeHouseLondon" target="_blank"><h3><?php _e('@homehouselondon'); ?></h3></a>
					<?php get_template_part('/inc/socials'); ?>
				</div>
				<div class="bottom">
					<a href="https://instagram.com/explore/tags/homefromhome/" target="_blank"><h4><?php _e('#homefromhome'); ?></h4></a>
				</div>
			</section>

			<section class="inner-content column">

			<div id="blog-categories">
				<span class="filterby">Filter by:</span>
				<ul>
					<?php 
					    $args = array(
						'show_option_all'    => 'All',
						'orderby'            => 'name',
						'order'              => 'ASC',
						'style'              => 'list',
						'hide_empty'         => 0,
						'title_li'           => __( '' ),
						'echo'               => 1,
						'depth'              => 0,
						'taxonomy'           => 'category',
					    );
					    wp_list_categories( $args ); 
					?>
				</ul>
			</div>			
			<div id="post-list">
				<?php $i = 1; ?>
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-med' ); ?>

					<article class="post-item">	

						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
							<img class="image" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>">
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
							<div class="excerpt">
							<?php
								$more = ' ... <a href="'. get_the_permalink().'">Click to coninue</a>';
							?>
								<?php custom_excerpt(20, $more); ?>
							</div>
						</div>
					</article>
					<?php $i++; ?>
				<?php endwhile; ?>
			    <?php else: ?>
				    <h1>Sorry, no posts found.</h1>
			    <?php endif; ?>	
			    <?php wp_reset_query(); ?>
			</div>

			<?php
				$next_link = get_next_posts_link(__('Newer Entries &raquo;'));
				if ($next_link) {
			?>
				<nav id="infinite">
					<div id="navbelow">
						<?php next_posts_link('Next &raquo;'); ?>			
					</div>
					<a id="next"><?php _e('Load More Posts'); ?></a>	
				</nav>
			<?php } ?>

			</section><!-- .inner-content -->
			<div class="sidebar column">
				<?php dynamic_sidebar('blog' ); ?>
			</div><!-- sidenav -->			
		</div><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #blog -->

<?php get_footer(); ?>