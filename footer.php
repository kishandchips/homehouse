<footer id="footer" class="white">
	<div class="certificates">
		<ul>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/securedownload.gif" alt=""></li>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-coolbrands.jpg" alt=""></li>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-baker-street-quarter.jpg" alt=""></li>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-the-audit-people.jpg" alt=""></li>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-verisign.jpg" alt=""></li>
			<li><img class="b-lazy" src=data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw== data-src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-ejaf.png" alt=""></li>
		</ul>
	</div><!-- .certificates -->

	<div class="sitemap clearfix">
		<div class="left">
			<div class="logo">
			 <a href="<?php echo bloginfo('url'); ?>" title="Homehouse">
				<img src="<?php bloginfo("stylesheet_directory"); ?>/img/logo-footer.png" alt="">
			</a>
				
			</div>
		</div>

		<div class="right">
			<nav>
	            <?php 
	                $args = array(
	                    'theme_location' => 'footer_nav',
	                    'menu' => '',
	                    'container' => '',
	                );

	                wp_nav_menu( $args ); 
	            ?>
				<ul class="social">
					<li><a href="https://www.facebook.com/HomeHouseLondon" class="icon" target="_blank"><i class="icon-facebook"></i></a></li>
					<li><a href="https://twitter.com/HomeHouseLondon" class="icon" target="_blank"><i class="icon-twitter"></i></a></li>
				</ul>
			</nav>			
		</div>
	</div><!-- .sitemap -->

</footer><!-- #footer -->

</div><!-- #kanye-west -->

<?php wp_footer(); ?>
</body>
</html>