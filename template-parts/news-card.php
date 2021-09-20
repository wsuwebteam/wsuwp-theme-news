<article class="wsu-news-card">
    <?php if ( has_post_thumbnail() ) : $image_id = get_post_thumbnail_id(); ?>
    <div class="wsu-image-frame wsu-ratio--4-3">
        <?php if ( ! empty( $args['link'] ) ) :?><a href="<?php echo esc_url( get_post_permalink() ); ?>"><?php endif; ?>
        <img src="<?php echo esc_attr( wp_get_attachment_image_src( $image_id, 'medium' ) );?>"
            srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id, 'medium' ) ); ?>"
            sizes="<?php echo esc_attr( wp_get_attachment_image_sizes( $image_id, 'medium' ) );?>"
            alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ); ?>" />
        <?php if ( ! empty( $args['link'] ) ) :?></a><?php endif; ?>
    </div>
    <?php endif; ?>
    <div class="wsu-news-card__content">
        <h3 class="wsu-article-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div class="wsu-excerpt"><?php the_excerpt(); ?></div>
        <div class="wsu-meta-date"><?php echo esc_html( get_the_date() ); ?></date>
    </div>
</article>
