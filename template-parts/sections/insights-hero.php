<?php
$blog_post = get_sub_field('blog_post');
$pid = 0;
if (is_object($blog_post) && isset($blog_post->ID)) {
    $pid = (int) $blog_post->ID;
} elseif (is_array($blog_post) && isset($blog_post['ID'])) {
    $pid = (int) $blog_post['ID'];
} elseif (is_numeric($blog_post)) {
    $pid = (int) $blog_post;
}

$txt = get_sub_field('text');

if ($pid):
    $url    = get_permalink($pid);
    $title  = get_the_title($pid);

    $excerpt = get_the_excerpt($pid);
    if ('' === trim((string) $excerpt)) {
        $raw     = get_post_field('post_content', $pid);
        $excerpt = wp_trim_words(wp_strip_all_tags($raw), 30, '…');
    }

    $img_html = '';
    if (has_post_thumbnail($pid)) {
        $thumb_id = get_post_thumbnail_id($pid);
        $src      = get_the_post_thumbnail_url($pid, 'large');
        $alt      = get_post_meta($thumb_id, '_wp_attachment_image_alt', true) ?: $title;
        $img_html = '<img src="' . esc_url($src) . '" alt="' . esc_attr($alt) . '" loading="lazy" decoding="async">';
    }
    $targets = [
        'Inside the art of living beautifully',
        "Inside the art\u{2028}of living beautifully",
    ];
    $norm = static function ($s) {
        return preg_replace('/\s+/u', ' ', trim((string)$s));
    };

    if (in_array($norm($title), array_map($norm, $targets), true)) {
        $safe = esc_html($title);
        $title_out = preg_replace('/\bart(?:\h|\x{2028})*of/u', 'art <br>of', $safe, 1);
    } else {
        $title_out = esc_html($title);
    }
?>
    <section class="insights-featured" data-theme="dark">
        <div class="insights-featured__inner">
            <h2 class="insights-featured__title" data-aos="fade-right"><?php echo $title_out; ?></h2>
            <div class="insights-featured-grid">
                <div class="insights-featured__image" data-aos="fade-right">
                    <?php echo $img_html ?: '<div class="insights-featured__placeholder" aria-hidden="true"></div>'; ?>
                </div>
                <div class="insights-right" data-aos="fade-left">
                    <?php if ($txt): ?>
                        <div class="insights-featured__text">
                            <?php echo wp_kses_post($txt); ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($excerpt): ?>
                        <p class="insights-featured__excerpt"><?php echo esc_html($excerpt); ?></p>
                    <?php endif; ?>
                    <a class="insights-featured__btn main-button" href="<?php echo esc_url($url); ?>">
                        <span>Read article</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                            <path d="M1 1H13V13" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                            <path d="M1 13L13 1" stroke="#fff" stroke-width="0.5" stroke-linejoin="round" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </section>
<?php else: ?>
    <section class="insights-featured insights-featured--empty">
        <p>Please select a blog post in the section settings.</p>
    </section>
<?php endif; ?>