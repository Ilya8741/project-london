<div class="insights-media <?php if ( get_sub_field('none_top_spacing') ) : ?> insights-media-padding-top <?php endif; ?> <?php if ( get_sub_field('none_bottom_spacing') ) : ?> insights-media-padding-bottom <?php endif; ?>">
    <div class="insights-media-wrapper"  data-aos="fade-up" data-aos-duration="600" data-aos-delay="100" data-aos-easing="ease-out">
           <?php $image1 = get_sub_field('image'); ?>
            <?php if ($image1): ?>
                <img src="<?php echo esc_url($image1['url']); ?>" class="article-hero-image" alt="<?php echo esc_attr($image1['alt']); ?>">
            <?php endif; ?>
            <?php
            $hero_video = get_sub_field('video');
            if ($hero_video): ?>
                <video autoplay muted loop playsinline>
                    <source src="<?php echo esc_url($hero_video['url']); ?>" class="article-hero-video" type="<?php echo esc_attr($hero_video['mime_type']); ?>">
                </video>
            <?php endif; ?>
    </div>
</div>