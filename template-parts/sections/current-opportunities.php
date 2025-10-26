<?php
/**
 * CAREERS / JOBS section with modal per item (based on team-section structure)
 *
 * Fields (top-level):
 *   - subtitle (Text)
 *   - title    (Text)
 *
 * Repeater: jobs_repeater
 *   - job_title   (Text)
 *   - tag_type    (Text)
 *   - tag_mode    (Text)
 *   - tag_location(Text)
 *   - description (WYSIWYG)
 *   - button_text (Text)
 *   - button_url  (URL)
 */
?>

<section class="careers-section <?php if (get_sub_field('padding_top')): ?> careers-section-top <?php endif; ?>" id="current-opportunities">
  <div class="careers-section-wrapper">
    <div class="careers-section-header">
      <div class="careers-section-header-left" data-aos="fade-right" data-aos-offset="200">
        <?php if (get_sub_field('title')): ?>
          <h2 class="careers-section-title"><?php the_sub_field('title'); ?></h2>
        <?php endif; ?>
      </div>
    </div>

    <?php if (have_rows('jobs_repeater')): ?>
      <ul class="careers-list" role="list">
        <?php $i = 0; while (have_rows('jobs_repeater')): the_row(); $i++;
          $job_title   = trim((string) get_sub_field('job_title'));
          $tag_type    = trim((string) get_sub_field('tag_type'));
          $tag_mode    = trim((string) get_sub_field('tag_mode'));
          $tag_location= trim((string) get_sub_field('tag_location'));
          $description = get_sub_field('description');
          $btn_text    = get_sub_field('button_text');
          $btn_url     = get_sub_field('button_url');
          $tpl_id      = 'career-modal-' . $i;
        ?>
          <li class="job-item" data-aos="fade-up" data-aos-offset="150">
            <button type="button" class="job-item__row" data-modal="#<?php echo esc_attr($tpl_id); ?>" aria-expanded="false">
              <span class="job-item__title"><?php echo esc_html($job_title); ?></span>
              <span class="job-item__tags">
                <?php if ($tag_type):    ?><span class="job-item__tag"><?php echo esc_html($tag_type); ?></span><?php endif; ?>
                <?php if ($tag_mode):    ?><span class="job-item__sep" aria-hidden="true">//</span><span class="job-item__tag"><?php echo esc_html($tag_mode); ?></span><?php endif; ?>
                <?php if ($tag_location):?><span class="job-item__sep" aria-hidden="true">//</span><span class="job-item__tag"><?php echo esc_html($tag_location); ?></span><?php endif; ?>
              </span>
              <span class="job-item__cta main-button">
                <span class="job-item__cta-text">Enquire</span>
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14" fill="none" aria-hidden="true">
                  <path d="M1 1H13V13" stroke="#717171" stroke-width="0.5" stroke-linejoin="round"/>
                  <path d="M1 13L13 1" stroke="#717171" stroke-width="0.5" stroke-linejoin="round"/>
                </svg>
              </span>
            </button>

            <!-- Hidden modal template for this job -->
            <div id="<?php echo esc_attr($tpl_id); ?>" class="team-modal-template" hidden>
              <div class="team-modal__inner">
                <div class="team-modal__text">
                  <?php if ($job_title): ?><h3 class="team-modal__title"><?php echo esc_html($job_title); ?></h3><?php endif; ?>
                  <div class="team-modal__subtitle">
                    <?php if ($tag_type):    ?><span><?php echo esc_html($tag_type); ?></span><?php endif; ?>
                    <?php if ($tag_mode):    ?><span>//</span><span><?php echo esc_html($tag_mode); ?></span><?php endif; ?>
                    <?php if ($tag_location):?><span>//</span><span><?php echo esc_html($tag_location); ?></span><?php endif; ?>
                  </div>
                  <?php if ($description): ?><div class="team-modal__content"><?php echo wp_kses_post($description); ?></div><?php endif; ?>
                  <?php if ($btn_text): ?>
                    <a class="main-button careers-team-modal__link" href="<?php echo esc_url($btn_url); ?>" target="_blank" rel="noopener">
                      <?php echo esc_html($btn_text ?: 'Download job spec'); ?>
                      <svg xmlns="http://www.w3.org/2000/svg" width="19" height="18" viewBox="0 0 19 18" fill="none">
                        <path d="M1.43945 1H17.8966V17" stroke="#2b2b2b" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M1.43945 17L17.8966 1" stroke="#2b2b2b" stroke-width="1.10345" stroke-linecap="round" stroke-linejoin="round" />
                      </svg>
                    </a>
                  <?php endif; ?>
                </div>
              </div>
            </div>
          </li>
        <?php endwhile; ?>
      </ul>
    <?php endif; ?>
  </div>

  <!-- Shared modal shell (same as team-section) -->
  <div class="team-modal careers-team-modal" aria-hidden="true">
    <div class="team-modal__overlay" data-close></div>
    <div class="team-modal__dialog" role="dialog" aria-modal="true" aria-labelledby="team-modal-title">
      <button class="team-modal__close" type="button" data-close aria-label="Close">
        <span aria-hidden="true" class="team-modal__close-button">
          <div class="team-modal__close-line"></div>
          <div class="team-modal__close-line"></div>
        </span>
      </button>
      <div class="team-modal__mount"></div>
    </div>
  </div>
</section>

<style>
    html {
        scroll-behavior: smooth !important;  
    }
</style>

<script>
(function() {
  const root = document.querySelector('.careers-section');
  if (!root) return;

  const modal = root.querySelector('.team-modal');
  const mount = modal.querySelector('.team-modal__mount');
  const overlay = modal.querySelector('.team-modal__overlay');
  const closeBtns = modal.querySelectorAll('[data-close]');
  const html = document.documentElement;

  function openModalFromTemplate(selector, trigger) {
    const tpl = root.querySelector(selector);
    if (!tpl) return;
    mount.innerHTML = tpl.innerHTML;
    modal.classList.add('is-open');
    modal.setAttribute('aria-hidden', 'false');
    html.classList.add('is-locked');
    if (trigger) trigger.setAttribute('aria-expanded', 'true');
    trapFocus(modal);
  }

  function closeModal() {
    modal.classList.remove('is-open');
    modal.setAttribute('aria-hidden', 'true');
    html.classList.remove('is-locked');
    const expanded = root.querySelector('.job-item__row[aria-expanded="true"]');
    if (expanded) expanded.setAttribute('aria-expanded', 'false');
    mount.innerHTML = '';
    releaseFocus();
  }

  root.addEventListener('click', function(e) {
    const btn = e.target.closest('.job-item__row');
    if (!btn) return;
    const sel = btn.getAttribute('data-modal');
    if (sel) openModalFromTemplate(sel, btn);
  });

  closeBtns.forEach(b => b.addEventListener('click', closeModal));
  overlay.addEventListener('click', closeModal);

  document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && modal.classList.contains('is-open')) closeModal();
  });

  let lastFocused = null;
  function trapFocus(container) {
    lastFocused = document.activeElement;
    const focusables = container.querySelectorAll('a, button, input, textarea, select, [tabindex]:not([tabindex="-1"])');
    if (focusables.length) focusables[0].focus();
    container.addEventListener('keydown', onTab);
    function onTab(e) {
      if (e.key !== 'Tab') return;
      const list = Array.from(focusables).filter(el => !el.hasAttribute('disabled'));
      if (!list.length) return;
      const first = list[0], last = list[list.length - 1];
      if (e.shiftKey && document.activeElement === first) { e.preventDefault(); last.focus(); }
      else if (!e.shiftKey && document.activeElement === last) { e.preventDefault(); first.focus(); }
    }
  }
  function releaseFocus() { if (lastFocused) lastFocused.focus(); }
})();
</script>
