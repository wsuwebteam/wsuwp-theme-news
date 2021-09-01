<?php namespace WSUWP\Theme\WDS; ?>

<?php get_header(); ?>
<!-- GLOBAL CONTAINER:START -->
<div class="wsu-wrapper-global">
	<?php Template::render( 'block-templates/header-global', get_post_type() ); ?>
	<?php Template::render( 'block-templates/navigation-site-vertical', get_post_type() ); ?>
	<!-- SITE WRAPPER:START -->
	<div class="wsu-wrapper-site">
		<!-- SITE CONTAINER:START -->
		<?php Template::render( 'block-templates/header-site', get_post_type() ); ?>
		<?php Template::render( 'block-templates/navigation-site-horizontal', get_post_type() ); ?>
		<?php Template::render( 'template-parts/post', get_post_type() ); ?>
		<?php get_template_part( 'template-parts/footer-site', get_post_type() ); ?>
		<!-- SITE CONTAINER:END -->
	</div>
	<!-- SITE WRAPPER:END -->
    <?php Template::render( 'block-templates/footer-global', get_post_type() ); ?>
</div>
<!-- GLOBAL CONTAINER:END -->
<?php get_footer(); ?>
