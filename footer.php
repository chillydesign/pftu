			<!-- footer -->
			<footer class="footer" role="contentinfo">

				<div class="footertop">
					<div class="row">
						<div class="col-sm-7">
							<nav><?php webfactor_footer_nav(); ?></nav>
							<p><strong>Partager</strong> <a href="#" id="facebook"></a><a href="#" id="twitter"></a><a href="#" id="linkedin"></a></p>
						</div>
						<div class="col-sm-5">
						<a href="#" class="interreg"><img alt="Confédération Helvétique" src="<?php echo get_template_directory_uri();?>/img/confederation-logo-grey.png"></a>
						<a href="#" class="interreg"><img alt="Un projet Interreg" src="<?php echo get_template_directory_uri();?>/img/interreg-logo-grey.png"></a>
						</div>
					</div>
				</div>
				<div class="footerbottom">

					<p>
						&copy;  Copyright <?php bloginfo('name'); ?> <?php echo date('Y'); ?>| Website by <a href="//webfactor.ch" title="Webfactor"><strong>Webfactor</strong></a>.
					</p>
				</div>

			</footer>
			<!-- /footer -->



		<?php wp_footer(); ?>

		<script>
		// (function(f,i,r,e,s,h,l){i['GoogleAnalyticsObject']=s;f[s]=f[s]||function(){
		// (f[s].q=f[s].q||[]).push(arguments)},f[s].l=1*new Date();h=i.createElement(r),
		// l=i.getElementsByTagName(r)[0];h.async=1;h.src=e;l.parentNode.insertBefore(h,l)
		// })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
		// ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
		// ga('send', 'pageview');
		</script>

	</body>
</html>
