<article class="wsu-news-list-item">
	<div class="wsu-news-list-item__content">
		<div class="wsu-meta-date"><?php echo esc_html( get_the_date() ); ?></div>
		<h3 class="wsu-article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
		<div class="wsu-excerpt"><?php the_excerpt(); ?></div>
	</div>
	<?php if ( has_post_thumbnail() ) : 
		$image_id        = get_post_thumbnail_id();
		$image_src_array = wp_get_attachment_image_src( $image_id, 'medium' );
		$image_src       = ( is_array( $image_src_array ) ) ? $image_src_array[0] : $image_src_array;
		?>
	<div class="wsu-image-frame wsu-ratio--4-3">
		<img src="<?php echo esc_url( $image_src );?>"
			srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id, 'medium' ) ); ?>"
			sizes="<?php echo esc_attr( wp_get_attachment_image_sizes( $image_id, 'medium' ) );?>"
			alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>" />
	</div>
	<?php endif; ?>
</article>