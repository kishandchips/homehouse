<?php 
/*
	Template Name: Team
*/
?>
<?php get_header(); ?>

<div id="team">

	<div id="content-wrapper" class="page-pattern">
		<section class="container">
			<div class="row">
				<?php if(get_field('sidebar')): ?>
					<div class="sidebar column col-1-5">
		 				<?php
							$parent = array_reverse(get_post_ancestors($post->ID));
							$first_parent = get_page($parent[0]);
						?>
						<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
						<?php get_sidebar(); ?>
					</div><!-- sidenav -->
				<?php endif; ?>

				<div class="inner-content column col-4-5">
				    <button aria-role="Mobile Sidebar Button" class="mob-button">
	                    <i class="icon-menu"></i>
	                    <span>Sidebar</span>
	                </button>

					<header>
						<h3 class="title large"><?php the_title(); ?></h3>						
					</header>
					<?php if( have_rows('members')): while( have_rows('members')) : the_row(); ?>
						<?php $image = get_sub_field('member_image'); ?> 

						<article class="member row">
							<div class="member-picture column col-1-5">
								<img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
							</div>
							<div class="body column col-4-5">
								<h3 class="member-name">
									<?php the_sub_field('member_name'); ?>
								</h3>
								<p class="member-title">
									<?php the_sub_field('member_title'); ?>
								</p>
									<?php the_sub_field('member_body'); ?>
							</div>
						</article><!-- .history-snippet -->
						<div class="separator">
							<span>&#9830;</span>
						</div>
					<?php endwhile; endif; ?>				
				</div>					
			</div><!-- .inner-content -->
		</section><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #team -->

<?php get_footer(); ?>