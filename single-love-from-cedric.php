<?php get_header(); ?>

<div id="single-cedric" class="flex-page page-pattern" <?php if(get_field('page_pattern')): ?>style="background-image: url(<?php the_field('page_pattern') ?>)"<?php endif; ?> >

	<?php if(get_field('header_image')): ?>
		<?php $image = get_field('header_image'); ?>
		<section class="hero image" style="background-image:url(<?php echo $image['sizes']['slider']; ?>)">
			<img src="<?php echo $image['url']; ?>" alt="">
		</section><!-- hero image -->
	<?php else : ?>
		<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'slider' ); ?>
		<section class="hero image" style="background-image:url(<?php echo $image[0]; ?>)">
			<img src="<?php echo $image ?>" alt="">
		</section><!-- hero image -->
	<?php endif; ?>

	<div id="content-wrapper">
		<section class="inner">
			<article class="single">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<h2 class="post-title"><?php the_title(); ?></h2>
					<?php the_content(); ?>
				<?php endwhile;endif; ?>
				<div class="separator"><span>&#9830;</span></div>				
			</article>
		</section><!-- .content -->

	</div><!-- #content-wrapper -->
</div><!-- #single-cedric -->

<?php get_footer(); ?>