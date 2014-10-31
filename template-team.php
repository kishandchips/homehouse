<?php 
/*
	Template Name: Team
*/
?>
<?php get_header(); ?>

<?php if(get_field('sidebar')): ?>
	<div id="team" class="flex-page has-sidebar page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php else: ?>
	<div id="team" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >
<?php endif; ?>

		<?php if(get_field('hero')): ?>
			
			<?php $images = get_field('slider_images'); ?>
			<?php if($images): ?>
				<?php if(count($images)>1): ?>

					<section class="hero flexslider thumbnails">
						
						<div class="hero-content valign">
							<h2 class="title"><?php the_title(); ?></h2>
						</div>

						<ul class="slides">
							<?php foreach ($images as $image): ?>
								<li style='background-image: url(<?php echo $image['sizes']['slider']; ?>)'>
									<img src="<?php echo $image['sizes']['slider']; ?>">
								</li>
							<?php endforeach; ?>
						</ul>

						<div class="arrow-wrap"></div>
					</section><!-- hero flexslider -->

				<?php else: ?>
					<?php foreach ($images as $image): ?>

						<div class="hero image" style="background-image:url(<?php echo $image['sizes']['slider']; ?>)">
	
							<div class="hero-content valign">
								<h2 class="title"><?php the_title(); ?></h2>
							</div>

							<img src="<?php echo $image['sizes']['slider']; ?>">
						</div><!-- hero image -->

					<?php endforeach; ?>

				<?php endif; ?>
			<?php endif; ?>

		<?php endif; ?>
		
	<div id="content-wrapper">
		<section class="container">
			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->

			<?php if(get_field('sidebar')): ?>
				<div class="sidebar column">

	 				<?php $parent = array_reverse(get_post_ancestors($post->ID)); ?>
					<?php if(count($parent)): ?>	
						<?php $first_parent = get_page($parent[0]); ?>
						<h3 class="sidenav-title"><a href="<?php echo $first_parent->guid; ?>"><?php echo $first_parent->post_title; ?></a></h3>
					<?php else: ?>
						<h3 class="sidenav-title"><a href="<?php get_page_link($post->ID );; ?>"><?php the_title(); ?></a></h3>
					<?php endif; ?>

					<?php get_sidebar(); ?>
				</div><!-- sidenav -->

				<section class="inner-content column">
					<div class="mob-bar">
						<button aria-role="Mobile Sidebar Button" class="mob-button">
		                    <i class="icon-menu"></i>
		                    <span>Side Menu</span>
		                </button>						
					</div>
            <?php else: ?>

            	<section class="inner-content">
            <?php endif; ?>

					<header>
						<h2><?php the_title(); ?></h2>						
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