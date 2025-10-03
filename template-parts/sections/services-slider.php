<section class="services-slider" id="services">
  <div class="services-slider-wrapper">
    <div class="services-slider-grid">
      <?php
      $rows = get_sub_field('services_repeater');
      if ($rows && is_array($rows) && count($rows)) :
      ?>
        <div class="services-stack">
          <?php foreach ($rows as $i => $row):
            $title = $row['title'] ?? '';
            $text  = $row['text']  ?? '';
            $btn   = (isset($row['button']) && is_array($row['button'])) ? $row['button'] : null;
            $btn_url   = $btn['url']   ?? '';
            $btn_title = $btn['title'] ?? '';
            $btn_tgt   = $btn['target'] ?? '_self';
            $img       = $row['image'] ?? null;
          ?>
           <article class="service-card" style="--z: <?php echo 1 + (int)$i; ?>">
              <div class="service-card__grid">
                <div class="service-card__content">
                  <?php if ($title): ?>
                    <h3 class="ssc-title"><?php echo esc_html($title); ?></h3>
                  <?php endif; ?>
                  <?php if ($text): ?>
                    <p class="ssc-text"><?php echo esc_html($text); ?></p>
                  <?php endif; ?>
                  <?php if ($btn_url && $btn_title): ?>
                    <a class="ssc-btn main-button" href="<?php echo esc_url($btn_url); ?>" target="<?php echo esc_attr($btn_tgt); ?>">
                      <span><?php echo esc_html($btn_title); ?></span>
                      <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                        <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                        <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                      </svg>
                    </a>
                  <?php endif; ?>
                </div>

                <figure class="service-card__media" aria-hidden="true">
                  <?php
                  if (!empty($img['ID'])) {
                    echo wp_get_attachment_image(
                      (int)$img['ID'],
                      '1536x1536',
                      false,
                      ['loading' => 'eager', 'decoding' => 'async']
                    );
                  }
                  ?>
                </figure>
              </div>
            </article>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
  </div>
</section>
