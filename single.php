<?php get_header(); ?>

<div id="single">

	<?php $image = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID),'slider' ); ?>
	<section class="hero image" style="background-image:url(<?php echo $image[0]; ?>)">
		<img src="<?php echo $image ?>" alt="">
	</section><!-- hero image -->

	<div id="content-wrapper">
		<section class="inner">
			<article class="single">
				<?php if(have_posts()): while(have_posts()): the_post(); ?>
					<h2 class="xlarge title"><?php the_title(); ?></h2>
					<?php the_content(); ?>
				<?php endwhile;endif; ?>
				<div class="separator"><span>&#9830;</span></div>				
			</article>
		</section><!-- .content -->

	</div><!-- #content-wrapper -->
</div><!-- #single-cedric -->

<?php get_footer(); ?>