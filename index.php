<?php get_header(); ?>

	<div id="blog" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?> style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >

		<div id="content-wrapper">
			<div class="container">
					<div class="sidebar column">
						<h3 class="sidenav-title">Categories</h3>

						<?php dynamic_sidebar('blog' ); ?>
					</div><!-- sidenav -->
				

					<section class="inner-content column">
						<div class="mob-bar">
							<button aria-role="Mobile Sidebar Button" class="mob-button">
			                    <i class="icon-menu"></i>
			                    <span>Side Menu</span>
			                </button>						
						</div>

							<?php if(have_posts()): while(have_posts()): the_post(); ?>
								<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'grid-rect-med' ); ?>

								<article class="post column col-full">
									<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
										<div class="image" style="background-image:url(<?php echo $image[0]; ?>)">
										</div>
										<div class="article-meta">
											<div class="date">
												<span class="day">
													<?php the_time('d'); ?>
												</span>
												<span class="month">
													<?php the_time('F');?>
												</span>
											</div>
											<div class="categories">
												<?php the_category(); ?>
											</div>
											<h2>
												<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
													<?php the_title(); ?>
												</a>
											</h2>
											<div class="excerpt">
												<?php the_excerpt(); ?>
											</div>
											<p><b><a href="<?php the_permalink();?>">Read More &rsaquo;</a></b></p>
										</div>
									</a>
								</article><!-- post -->

							<?php endwhile; ?>
							    <?php if (  $wp_query->max_num_pages > 1 ) : ?>
								    <div id="posts-navigation" class="navigation">
								        <div class="nav-previous">
								            <?php previous_posts_link( '<span class="meta-nav">&larr;</span>&nbsp;&nbsp;Newer posts' ); ?>
								        </div>
								        <div class="nav-next">
								            <?php next_posts_link( 'Older posts&nbsp;&nbsp;<span class="meta-nav">&rarr;</span>' ); ?>
								        </div>
								    </div><!-- #nav-below -->
							    <?php endif; ?>	

						    <?php else: ?>
						    <h1>Sorry, no posts found.</h1>
						    <?php endif; ?>	
						    <?php wp_reset_query(); ?>
					</section><!-- .inner-content -->

			</div><!-- .container -->
		</div><!-- #content-wrapper -->
	</div><!-- #blog -->

<?php get_footer(); ?>