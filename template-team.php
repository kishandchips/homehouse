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
		
		<?php get_template_part( 'content', 'slider' ); ?>

	<?php endif; ?>
		
	<div id="content-wrapper">
		<section class="container">

			<?php if ( function_exists('yoast_breadcrumb') ) {
				yoast_breadcrumb('<p id="breadcrumbs">','</p>');
			} ?><!-- .breadcrumbs -->

			<?php if(get_field('sidebar')): ?>
				
				<?php get_template_part( 'content', 'sidebar' ); ?>

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
						</article><!-- .member -->

						<div class="separator">
							<span>&#9830;</span>
						</div>

					<?php endwhile; endif; ?>
									
			</section><!-- .inner-content -->
		</section><!-- .container -->
	</div><!-- #content-wrapper -->
</div><!-- #team -->

<?php get_footer(); ?>