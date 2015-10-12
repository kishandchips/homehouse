<?php 
/*
	Template Name: Bedroom-single
*/
?>
<?php get_header(); ?>

<?php if(is_page('my-membership') and !is_user_logged_in()): ?>
	<?php wp_redirect( home_url() . '/login/' ); ?>
<?php endif; ?>

<div id="single-bedroom" class="flex-page">

    <div id="call-us">
        <div class="login-overlay"></div><!-- .login overlay -->
        <div class="login-modal valign">
            <button class="button call-us-close" aria-role="toggle login form">
                <i class="icon-cross"></i>
            </button>

			<p>For more detailed information and to book by phone please call our dedicated Reservations Team, who will be more than happy to assist you in your enquiry. </p>
			<p>Please call: <strong>0207 670 2000</strong> <br>or email: <a href="mailto:reservations@homehouse.co.uk">reservations@homehouse.co.uk</a></p>
        </div><!-- .login -->   
    </div><!-- #login -->

	<div id="content-wrapper">	
		<div class="container">

	        	<section class="inner-content">
        
					<header>
						<h2><?php the_title(); ?></h2>
					</header>

					<?php if(have_posts()): while(have_posts()): the_post(); ?>

					<div class="body">
						<?php the_content(); ?>
					</div>

					<div class="buttons">
						<a href="tel:555-555-5555" class="button secondary med white call-btn">Book by Phone</a>
						<a href="mailto:reservations@homehouse.co.uk?subject=Bedroom booking request - <?php the_title(); ?>&body=Hi,I would like to book the bedroom found here: <?php the_permalink(); ?>" title="<?php the_title(); ?>" class="button primary purple med">Book by Email</a>		
					</div>					
					
					<?php endwhile; endif; ?>

				</section><!-- .inner-content -->

				<?php if(get_field('images')): ?>
					
					<?php $images = get_field('images'); ?>
					<?php if($images): ?>
							<section class="images flexslider" data-controlnav="thumbnails">
								
								<ul class="slides">
									<?php foreach ($images as $image): ?>
										<?php 
											$thumb = $image['url'];
											$thumb_size = array('width' => 230, 'height' => 175);
											$thumb = bfi_thumb($thumb, $thumb_size);
										?>										
										<li style="background-image: url(<?php echo $image['url']; ?>)" data-thumb="<?php echo $thumb; ?>">
											&nbsp;
<!-- 											<a class="fancybox-thumb" rel="fancybox-thumb-<?php echo $i; ?>" href="<?php echo $image['url']; ?>" title="">				
										  		<span class="icon icon-fulllscreen"></span>
										  	</a>											
 -->									</li>
									<?php endforeach; ?>
								</ul>								
								<div class="arrow-wrap"></div>
							</section><!-- hero flexslider -->
					<?php endif; ?>

				<?php endif; ?>

		</div><!-- .container -->
		<?php wp_reset_query(); ?>
		<?php wp_reset_postdata(); ?>

	<?php if(get_field('display_grid')): ?>

		<?php get_template_part( 'content', 'grid' ); ?>

	<?php endif; ?>		
	<div class="bottom-back-button">
		<a href="<?php echo get_the_permalink(27); ?>" title="Back to bedrooms" class="button secondary white">Back to bedrooms</a>
	</div>



	</div><!-- #content-wrapper -->
</div><!-- #page -->

<?php get_footer(); ?>