<section class="services-slider" id="services">
  <div class="services-slider-wrapper">
    <div class="services-slider-grid">
      <?php
      $rows = get_sub_field('services_repeater');
      if ( $rows && is_array($rows) ) :
      ?>

        <div class="services-slider-content-col">
          <?php foreach ($rows as $i => $row) :
            $title = isset($row['title']) ? $row['title'] : '';
            $text  = isset($row['text'])  ? $row['text']  : '';
            $btn   = isset($row['button']) && is_array($row['button']) ? $row['button'] : null;
            $btn_url   = $btn['url']   ?? '';
            $btn_title = $btn['title'] ?? '';
            $btn_tgt   = $btn['target'] ?? '_self';
          ?>
            <article class="services-content-card" data-index="<?php echo esc_attr($i); ?>">
              <?php if ($title): ?>
                <h3 class="ssc-title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>
              <?php if ($text): ?>
                <p class="ssc-text"><?php echo esc_html($text); ?></p>
              <?php endif; ?>
              <?php if ($btn_url && $btn_title): ?>
                <a class="ssc-btn main-button" href="<?php echo esc_url($btn_url); ?>" target="<?php echo esc_attr($btn_tgt); ?>">
                  <span><?php echo esc_html($btn_title); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none">
                        <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                        <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round" />
                    </svg>
                </a>
              <?php endif; ?>
            </article>
          <?php endforeach; ?>
        </div>

        <div class="services-slider-image-col">
          <div class="services-image-stage">
            <div class="services-slider-image-track">
              <?php foreach ($rows as $row) :
                $img = $row['image'] ?? null; ?>
                <figure class="services-image" aria-hidden="true">
                  <?php
                  if (!empty($img['ID'])) {
                    echo wp_get_attachment_image(
                      $img['ID'],
                      '1536x1536',
                      false,
                      ['loading'=>'eager','decoding'=>'async']
                    );
                  }
                  ?>
                </figure>
              <?php endforeach; ?>
            </div>
          </div>
        </div>

      <?php endif; ?>
    </div>
  </div>
</section>

